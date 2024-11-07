<?php

namespace App\Http\Controllers;

use App\Models\Ordering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TransactionDetailsModel;
use Illuminate\Support\Facades\Redirect;


class OrderingControllerWODS extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ascending = 0; // Default to ascending order
        $branchId =  0;//auth()->user()->branchid;
       
        // $module = DB::table('settings')
        // ->select('Module') // Select all columns from both tables
        // ->groupby('Module') // Filter based on provided or request ID
        // ->get(); 

        // $Moduledata = DB::table('settings')
        // ->select('*') // Select all columns from both tables
        // ->get(); 

        // $ItemCodelist = DB::table('product')
        // ->select('ItemCode') // Select all columns from both tables
        // ->groupby('ItemCode') // Filter based on provided or request ID
        // ->get(); 

        
        $branch = DB::table('branch')
        ->select('*')
        ->where('Status',1)
        ->get(); 

        $data = DB::select("CALL SP_CHECK_SO_ONLOAD_DROP(?, ?)", [$branchId,$ascending]); 
        $WOSO = 2;

        return view('Ordering.createSO',compact('data','branch','WOSO'));
        // return response()->json($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($SONumber)
    {
        $ascending = "1"; // Default to ascending order
        $branchId = "1";//auth()->user()->branchid; // 
        $details = DB::select("CALL SP_GET_RECEIVINGITEMS_HEADERID(?,?)", [$SONumber,$ascending]); 

        $all = "0"; 
        $ItemCode = ""; 
        $ByDesc ="";
        // $dataInv = DB::select("CALL SP_GET_ITEMINVENTORY_BRANCH(?,?,?,?)", [$branchId,$all,$ItemCode,$ByDesc]); 

        $productList = DB::table('productmasterfile')
        ->select('*')
        ->where('Status',1)
        ->get(); 

        // $paramId = $id;
        $SONumber = $SONumber;
        // $Status = $Status;
        $SOHeader = DB::select("CALL SP_GET_SO_TRANSACTIONHEADER(?)",[$SONumber]);
        

        return view('Ordering.SOItemList',compact('productList','details','SONumber','SOHeader'));

    }
    public function createDuplicate($SONumber)
    {
        
        $SOHeader = DB::select("CALL SP_SO_DUPLICATE(?, ?)",[$SONumber,1]);

        $latestSourceSODuplicate = DB::table('transactionheader')
        ->orderBy('created_at','desc')
        ->first();

        $latestSONumber = $latestSourceSODuplicate->SONumber;
        $latestId = $latestSourceSODuplicate->Id;

        $ascending = "1"; // Default to ascending order
        $branchId = "1";//auth()->user()->branchid; // 
        $details = DB::select("CALL SP_GET_RECEIVINGITEMS_HEADERID(?,?)", [$SONumber,$ascending]); 

        $all = "0"; 
        $ItemCode = ""; 
        $ByDesc ="";
        // $dataInv = DB::select("CALL SP_GET_ITEMINVENTORY_BRANCH(?,?,?,?)", [$branchId,$all,$ItemCode,$ByDesc]); 

        $productList = DB::table('productmasterfile')
        ->select('*')
        ->get(); 

        $SONumber = $latestSONumber;
        $SOHeader = DB::select("CALL SP_GET_SO_TRANSACTIONHEADER(?)",[$SONumber]);
        $Status = "RECEIVED";
        
        return Redirect::route('createSO-list', ['SONumber' => $SONumber]);
        // return Redirect::route('createSO-list/' . $SONumber);
// Route::get('/createSO-list/{SONumber}/', [OrderingController::class, 'create']);

        // return view('Ordering.SOItemList',compact('productList','details','SONumber','SOHeader'));

    }

    public function storeUpload(Request $request)
    {

    //dd($request);

      // Validate the incoming data
      $validatedData = $request->validate([
        'SONumber' => 'required|string',
        'BranchId' => 'required|integer',
        'SODate' => 'required|date',        
        // Add more validation rules as needed
    ]);

    //dd($validatedData);

    // Extract data from the validated request
    $data = $request->all();
    $TransactionType = "SO";
    $orderDate = now();
    $receivingDate = now();
    $totalItem = 0;
    $totalqty = 0;
    $BranchId = $data['BranchId'];
    $SONumber = $data['SONumber'];
    $SODate = $data['SODate'];

    //dd($data);

    // Call the stored procedure
    $results = DB::select('CALL SP_INSERT_TRANSACTIONHEADER_SOUPLOAD(?, ?, ?, ?, ?, ?, ?,?,?,?)', [
        $TransactionType,
        $orderDate,
        $receivingDate,
        $totalItem,
        $totalqty,            
        1,// auth()->user()->id,
        1,
        $BranchId,// auth()->user()->branchid,
        $SONumber,// auth()->user()->branchid,
        $SODate,
    ]);


    if ($results) {
        $ascending = 1; // Default to ascending order
        $SOForUpload = DB::table('transactionheader')
        ->select('*') // Select all columns from both tables
        ->where('FromUpload',1) 
        ->get();         
        $SOdata = DB::select("CALL SP_GET_UPLOAD_HEADER(?)", [$SONumber]); 

        return view('Receiving.UploadSO',compact('SOdata'));
    } else {

    return redirect()->back()->withErrors(['error' => 'An error occurred while saving the data. Please try again.']);
        // An error occurred while executing the stored procedure
        // Handle the error appropriately
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
        {
          // Validate the incoming data
          $validatedData = $request->validate([
            'SONumber' => 'required|string',
            'BranchId' => 'required|integer',
            'SODate' => 'required|date',  
            // Add more validation rules as needed
        ]);



        // Extract data from the validated request
        $data = $request->all();
        $TransactionType = "SO";
        $orderDate = now();
        $receivingDate = now();
        $totalItem = 0;
        $totalqty = 0;
        $BranchId = $data['BranchId'];
        $SONumber = $data['SONumber'];
        $SODate = $data['SODate'];

        $getSO = DB::select("CALL SP_GET_LAST_SO_BYBRANCH(?)", [$BranchId]); 
        $newSO = $getSO[0]->SO_Number;

        // Call the stored procedure
        $results = DB::select('CALL SP_INSERT_TRANSACTIONHEADER(?, ?, ?, ?, ?, ?, ?,?,?,?)', [
            $TransactionType,
            $orderDate,
            $receivingDate,
            $totalItem,
            $totalqty,            
            1,// auth()->user()->id,
            1,
            $BranchId,// auth()->user()->branchid,
            $newSO,// auth()->user()->branchid,
            $SODate,
        ]);


        if ($results) {
            $ascending = 1; // Default to ascending order
            $branchId = 1;//auth()->user()->branchid; // Default to ascending order
            // Call the stored procedure
            $data = DB::select("CALL SP_CHECK_RECEIVING_ONLOAD(?, ?)", [$ascending, $branchId]); 

            return view('Receiving.createSO',compact('data'));
        } else {

        return redirect()->back()->withErrors(['error' => 'An error occurred while saving the data. Please try again.']);
            // An error occurred while executing the stored procedure
            // Handle the error appropriately
        }
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ordering  $ordering
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $data = DB::select("CALL SP_GET_LAST_SO_BYBRANCH(?)", [$id]); 
        return response()->json($data);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ordering  $ordering
     * @return \Illuminate\Http\Response
     */
    public function edit(Ordering $ordering)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ordering  $ordering
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    public function updateHeader(Request $request)
    {
        $so = $request->input('HSONumber');
        $date = $request->input('HSODate');

        DB::table('transactionheader')
        ->where('SONumber', $so)
        ->update(['SODate' => $date]);

        return redirect()->back()->with('success', 'Header updated successfully');

    }
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ordering  $ordering
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $SONumber)
    {

        $salesOrderDetail = TransactionDetailsModel::findOrFail($id);
        $deletedRows = $salesOrderDetail->delete();

        if ($deletedRows > 0) {
            // $SOHeader = DB::select("CALL SP_GET_STATUS_SO(?)",[$SONumber]);
            $SOHeaderU = DB::select("CALL SP_UPDATE_HEADER_SO(?)",[$SONumber]);

        return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true]);

        }
        

    }
    public function showItem($id)
    {
        $data = DB::table('productmasterfile')
        ->select('*') 
        ->where('ID',$id) 
        ->first(); 
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Product not found or missing InventoryID'], 404);
        }
    }
    public function storeDetails(Request $request)
    {
        // $validatedData = $request->validate([
        //     'ItemCodeH' => 'required|string',
        //     'UOM' => 'required|string',
        //     'PO_QTY' => 'required|integer',
        //     'paramId' => 'required|integer',
        // ]);

        // Check if any of the validated values are null

        $data = $request->all();
       // Extract data from the validated request
       $itemCodeH = $data['ItemCodeH'];
       $InventoryItem = $data['InventoryItem'];
        $PO_QTY = $data['PO_QTY'];
        $SONumber = $data['SONumber'];
        
        if (is_null($data['ItemCodeH']) || is_null($data['PO_QTY'])) {
            return redirect()->back()->with('error', 'Please fill in all required fields.');
        }

         // Call the stored procedure
         $results = DB::select('CALL SP_INSERT_SO_ITEMSDETAILS(?, ?, ?, ?)', [
            $SONumber,
            $itemCodeH,
            $PO_QTY,
           1,
        ]);
        //dd($results);

        if ($results) {
            
            $ascending = 1; // Default to ascending order
            $branchId = 1;//auth()->user()->branchid; // Default to ascending order
            // Call the stored procedure
            $data = DB::select("CALL SP_CHECK_RECEIVING_ONLOAD(?, ?)", [$ascending, $branchId]); 

            return view('Receiving/itemList', compact('data'));
        } else {

        // dd("error");
        return redirect()->back()->withErrors(['error' => 'An error occurred while saving the data. Please try again.']);
           
        }
    }

    public function updatedetails(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            // 'Module' => 'required',
            // 'SettingName' => 'required',
            // 'Description' => 'required',
            // 'Value' => 'required',
        ]);

        $rowId = $request->input('SOHId');
        $qty = $request->input('SOHPO_QTY');
        $itemCode = $request->input('SOHItemCode');
        $SONumber = $request->input('HSONumber');

        
    //   $results =  DB::table('transactiondetails')
    //     ->where('id', $rowId)
    //     ->update(['ItemCode' => $itemCode,
    //             'PO_QTY' => $qty]);

    //     if ($results > 0) {
    //         // $SOHeader = DB::select("CALL SP_GET_STATUS_SO(?)",[$SONumber]);
    //         $SOHeaderU = DB::select("CALL SP_UPDATE_HEADER_SO(?)",[$SONumber]);

    //         return redirect()->back()->with('success', 'Details updated successfully');

    //     } else {
    //         return redirect()->back()->with('error', 'Update Failed');
    //     }

    $existingItem = DB::table('transactiondetails')
    ->where('id', $rowId)
    ->first();

if ($existingItem) {
    $originalQty = $existingItem->PO_QTY;
    $originalItemCode = $existingItem->ItemCode;

    if ($qty === $originalQty && $itemCode === $originalItemCode) {
        return redirect()->back()->with('info', 'No changes were made.');
    }

    $results = DB::table('transactiondetails')
        ->where('id', $rowId)
        ->update(['ItemCode' => $itemCode, 'PO_QTY' => $qty]);

    if ($results > 0) {
        // $SOHeader = DB::select("CALL SP_GET_STATUS_SO(?)",[$SONumber]);
        $SOHeaderU = DB::select("CALL SP_UPDATE_HEADER_SO(?)",[$SONumber]);

        return redirect()->back()->with('success', 'Details updated successfully');
    } else {
        return redirect()->back()->with('error', 'Update Failed');
    }
} else {
    return redirect()->back()->with('error', 'Item not found.');
}
    }
}
