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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ordering  $ordering
     * @return \Illuminate\Http\Response
     */
  
    
    
}
