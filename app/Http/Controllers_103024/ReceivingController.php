<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use PDO;
use DataTables;

use Illuminate\Http\Request;

class ReceivingController extends Controller
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
        ->where('STATUS',1)
        ->get(); 

        $data = DB::select("CALL SP_CHECK_SO_ONLOAD(?, ?)", [$ascending, $branchId]); 

        return view('Receiving.createREC',compact('data','branch'));
        // return response()->json($data);

    }

    public function indexNOSO()
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
        ->where('STATUS',1)
        ->get(); 

        $data = DB::select("CALL SP_CHECK_SO_ONLOAD_NOSO(?, ?)", [$ascending, $branchId]); 

        return view('Receiving.createREC',compact('data','branch'));
        // return response()->json($data);

    }

    public function indexDS()
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
        ->where('STATUS',1)
        ->get(); 

        $data = DB::select("CALL SP_CHECK_SO_ONLOAD_DROP(?, ?)", [$ascending, $branchId]); 

        return view('Receiving.createREC',compact('data','branch'));
        // return response()->json($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,$SONumber)
    {
       
        $ascending = "1"; // Default to ascending order
        $branchId = "1";//auth()->user()->branchid; // 
        $details = DB::select("CALL SP_GET_RECEIVINGITEMS_HEADERID(?,?)", [$id,$ascending]); 

        $all = "0"; 
        $ItemCode = ""; 
        $ByDesc ="";
        // $dataInv = DB::select("CALL SP_GET_ITEMINVENTORY_BRANCH(?,?,?,?)", [$branchId,$all,$ItemCode,$ByDesc]); 

        $productList = DB::table('productmasterfile')
        ->select('*')
        ->get(); 

        $paramId = $id;
        $SONumber = $SONumber;
       
        return view('Receiving.RECitemList',compact('productList','details','paramId','SONumber'));
    }

    public function createREC($id,$SONumber)
    {
       
        $ascending = "1"; // Default to ascending order
        $branchId = "1";//auth()->user()->branchid; // 
        $details = DB::select("CALL SP_GETDETAILS_RECEIVING_BY_SO(?)", [$SONumber]); 
        // $details = DB::select("CALL SP_GET_RECEIVINGITEMS_HEADERID(?,?)", [$id,$ascending]); 

        $all = "0"; 
        $ItemCode = ""; 
        $ByDesc ="";
        // $dataInv = DB::select("CALL SP_GET_ITEMINVENTORY_BRANCH(?,?,?,?)", [$branchId,$all,$ItemCode,$ByDesc]); 

        $productList = DB::table('productmasterfile')
        ->select('*')
        ->get(); 

        $paramId = $id;
        $SONumber = $SONumber;
        $SOHeader = DB::select("CALL SP_GET_SO_TRANSACTIONHEADER(?)",[$SONumber]);
        // return view('Receiving.RECitemList',compact('productList','details','paramId','SONumber'));
         return view('Receiving.UPAddActualRec',compact('productList','details','paramId','SONumber','SOHeader'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Extract data from the validated request
        $data = $request->all();
        $ReceivingDate = $data['ReceivingDate'];
        $ExpirationDate = $data['ExpirationDate'];
        $itemCodeH = $data['ItemCodeH'];
        $PO_QTY = "2";//$data['PO_QTY'];
        $REC_QTY = $data['REC_QTY'];
        $Remarks = $data['Remarks'];
        $paramId = $data['paramId'];
        $Barcode = $data['Barcode'];

       // dd($data);

         // Call the stored procedure
         $results = DB::select('CALL SP_INSERT_RECEIVINGITEMS(?, ?, ?, ?, ?, ?, ?, ?, ? ,?)', [
            $paramId,
            $itemCodeH,
            $PO_QTY,
            $REC_QTY,
            1,
            1,
            $Remarks,
            $ExpirationDate,
            $ReceivingDate,
            $Barcode
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $transactionId)
    {
        // Retrieve the updated data from the request
        $updatedData = $request->all();
        // Prepare the data for the stored procedure
        $spData = [
            'DetailsID' => $transactionId,
            'RECQTY' => $updatedData['REC_QTY'],
            'RecUSERID' => "1",
            'Rem' => $updatedData['Remarks'],
            'ExpDate' => now(),
            'Rem' => $updatedData['Remarks'],
            'RecDate' => $updatedData['ReceivingDate'],
        ];

        // Call the stored procedure
        DB::statement('CALL SP_EDIT_TRANSACTIONDETAILS(?, ?, ?, ?, ?, ?, ?)', $spData);
        // Return a success response or redirect to the desired page
        return response()->json(['message' => 'Transaction updated successfully']);
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getExpiry($id)
    {
        // dd($id);
        $data = DB::table('transactiondetails_expiry')
        ->select('REC_Qty','Expiration_date') // Select all columns from both tables
        ->where('transactionid',$id) 
        ->get(); 
//dd($data);
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Product not found or missing InventoryID'], 404);
        }
    }

    public function updateActualQty(Request $request)
    {// Validate the incoming data
        $validatedData = $request->validate([
            'IdE' => 'required|integer',
            'ReceivingDateE' => 'required|date',
            'ActualQTY' => 'required|integer',
        ]);

        // Extract data from the validated request
        $data = $request->all();
       
        $IdE = $data['IdE'];
        $ReceivingDateE = $data['ReceivingDateE'];
        $ActualQTY = $data['ActualQTY'];

      
            $results = DB::select('CALL SP_UPDATE_SO_ITEMSDETAILS(?, ?, ?)', [
                $IdE,
                $ActualQTY,
                1
            ]);

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

    public function storeExpiry(Request $request)
    {
        // Extract data from the validated request
        $data = $request->all();
        //  dd($data);
        $TransDetailID = $data['TransDetailID'];
        $Qty = $data['Qty'];
        $Expiration_date = $data['Expiration_date'];
        $ReceivingDate = $data['ReceivingDate'];
        $DRNo = $data['DRNo'];
        $SONumber = $data['SONumberU'];
        $itemcode = $data['itemcode'];
        // dd($itemcode);


            $results = DB::select('CALL SP_INSERT_RECEIVING_QTY(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $TransDetailID, 
            $Qty, 
            $Expiration_date,
            $ReceivingDate,
            1,
            $DRNo,
            $data['SONumberU'],
            $itemcode,
            null
        ]);
            // SP_INSERT_RECEIVINGITEMS
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
    public function fetchExpiry(Request $request)
    {
        // Extract data from the validated request
        $id = $request->input('transactionDetailID');
         // Call the stored procedure
         $data = DB::select('CALL SP_GET_ACTUALRECEIVED_EXPIRY(?)', [
            $id,
        ]);

        if ($data) {
            
           return response()->json($data);

        } else {

        return redirect()->back()->withErrors(['error' => 'An error occurred while saving the data. Please try again.']);
           
        }
    }

    public function updateHeaderREC(Request $request)
    {
        $so = $request->input('HSONumber');
        $DRNo = $request->input('DRNo');
        $DRLink = $request->input('DRLink');

        DB::table('transactionheader')
        ->where('SONumber', $so)
        ->update(['DeliverReceiptNo' => $DRNo,
                  'DRAttachment' => $DRLink]);

        return redirect()->back()->with('success', 'Header updated successfully');

    }
}
