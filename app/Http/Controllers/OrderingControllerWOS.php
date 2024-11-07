<?php

namespace App\Http\Controllers;

use App\Models\Ordering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TransactionDetailsModel;
use Illuminate\Support\Facades\Redirect;


class OrderingControllerWOS extends Controller
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
        
        $branch = DB::table('branch')
        ->select('*')
        ->where('Status',1)
        ->get(); 

        $supplier = DB::table('vendormasterfile')
        ->select('*')
        ->where('Status',1)
        ->get(); 

        $data = DB::select("CALL SP_CHECK_SO_ONLOAD_NOSO(?, ?)", [$branchId,$ascending]); 
        $WOSO = 1;

        return view('Ordering.createSOWOS',compact('data','branch','WOSO','supplier'));

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
            // 'SONumber' => 'required|string',
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
        $SuppId = $data['SupplierId'];
        // $SONumber = $data['SONumber'];
        $SODate = $data['SODate'];

        $getSO = DB::select("CALL SP_GET_LAST_SO_BYBRANCH_NOSO(?)", [$BranchId]); 
        $newSO = $getSO[0]->SO_Number;

        // Call the stored procedure
        $results = DB::select('CALL SP_INSERT_TRANSACTIONHEADER_NOSO(?, ?, ?, ?, ?, ?, ?,?,?,?)', [
            $TransactionType,
            $orderDate,
            $receivingDate,
            $totalItem,
            $totalqty,            
            auth()->user()->id,
            $SuppId,
            $BranchId,// auth()->user()->branchid,
            $newSO,// auth()->user()->branchid,
            $SODate,
        ]);


        // if ($results) {
        //     $ascending = 1; // Default to ascending order
        //     $branchId = 1;//auth()->user()->branchid; // Default to ascending order
        //     // Call the stored procedure
        //     $data = DB::select("CALL SP_CHECK_RECEIVING_ONLOAD_NOSO(?, ?)", [$ascending, $branchId]); 
           
        //     return Redirect::route('createSO-list', ['SONumber' => $SONumber]);
        //     // return view('Receiving.createSO',compact('data'));
        // } else {

        // return redirect()->back()->withErrors(['error' => 'An error occurred while saving the data. Please try again.']);
    // }

        ////load directly to SODetails
        $ascending = "1"; // Default to ascending order
        $branchId = "1";//auth()->user()->branchid; // 
        $details = DB::select("CALL SP_GET_RECEIVINGITEMS_HEADERID(?,?)", [$newSO,$ascending]); 

        $all = "0"; 
        $ItemCode = ""; 
        $ByDesc ="";
        // $dataInv = DB::select("CALL SP_GET_ITEMINVENTORY_BRANCH(?,?,?,?)", [$branchId,$all,$ItemCode,$ByDesc]); 

        $productList = DB::table('productmasterfile')
        ->select('*')
        ->get(); 

        $SONumber = $newSO;
        $SOHeader = DB::select("CALL SP_GET_SO_TRANSACTIONHEADER(?)",[$newSO]);

        return Redirect::route('createSO-list', ['SONumber' => $SONumber]);

            // An error occurred while executing the stored procedure
            // Handle the error appropriately
        
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ordering  $ordering
     * @return \Illuminate\Http\Response
     */
   
    public function showWOS($id,$isType)
    {        
        if($isType == 1) //NO SO
        {
            $data = DB::select("CALL SP_GET_LAST_SO_BYBRANCH_NOSO(?)", [$id]); 
        }else //DROPSHIPPING SO
        {
            $data = DB::select("CALL SP_GET_LAST_SO_BYBRANCH_DROP(?)", [$id]); 
        }
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

}
