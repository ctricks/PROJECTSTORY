<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\RECUploadImport;
use App\Imports\RecUploadItemImport;
use App\Models\TransactionDetailsModel;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class UPReceivingController extends Controller
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

        // $data = DB::select("CALL SP_CHECK_SO_ONLOAD(?, ?)", [$ascending, $branchId]); 
        $data = DB::select("CALL SP_GET_RECEIVINGITEMS_BYDATE(?, ?, ?, ?)", [null, null, null, 1]); 

        return view('Receiving.UPRecevingList',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($SONumber)
    {
        $ascending = "1"; // Default to ascending order
        $branchId = "1";//auth()->user()->branchid; // 
        $details = DB::select("CALL SP_GETDETAILS_RECEIVING_BY_SO(?)", [$SONumber]); 
       
        // $SONumber = $SONumber;
        $SOHeader = DB::select("CALL SP_GET_SO_TRANSACTIONHEADER(?)",[$SONumber]);

       
        return view('Receiving.UPAddActualRec',compact('details','SONumber','SOHeader'));
    }

    public function import(Request $request)
    {
    
    $data = $request->all();
    $DR = $data['DrNo'];
    $SONumber = $data['SONumber'];
    $ReceivedByID =1;

    $details = DB::select("CALL SP_GETDETAILS_RECEIVING_BY_SO(?)", [$SONumber]);

    DB::table('transactionheader')
        ->where('SONumber', $SONumber)
        ->update(['DeliverReceiptNo' => $DR]);
    
    $file = $request->file('file');

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        // Pass the transaction header ID to the import class

        Excel::import(new RECUploadImport($SONumber, $DR, $details,$ReceivedByID), $request->file('file')->store('files'));
        return redirect()->back()->with('success', 'Excel file uploaded successfully.');

    } else {
        return redirect()->back()->with('error', 'Please select a file to upload.');
    }

                // dd( Excel::import($import, $request->file('file')->store('files')));

                //  Excel::import(new RECUploadImport($getSO[0]->SO_Number), $request->file('file')->store('files'));
        
                // Excel::import(new SOUploadImport, $request->file('file')->store('files'));
            // } else {
            //     // Handle the case where the file field is not present or invalid
            //     return redirect()->back()->withErrors(['file' => 'Please upload a valid file.']);
            // }            
    }
    
    public function uploadIndex()
    {
        // $results = DB::table('receivingitem')
        //         ->groupBy('SONumber','id')
        //         ->get();
                // dd($results);
    $results = DB::select("CALL SP_GET_UPLOAD_LIST()");

        return view('Receiving.UPRec',compact('results'));
    }   
      
    public function storeUploadItem(Request $request)
    {
        $file = $request->file('file');
        // $import = new RecUploadItemImport($filename);

        if ($request->hasFile('file')) {
            $filename = $file->getClientOriginalName();

            Excel::import(new RecUploadItemImport($filename), $request->file('file')->store('files'));
            return redirect()->back()->with('success', 'Excel file uploaded successfully.');
        } else {
            return redirect()->back()->with('error', 'Please select a file to upload.');
        }
    }
    
    public function uploadList($SONumber)
    {
        $data = DB::select("CALL SP_GET_UPLOAD_SO(?)", [$SONumber]); 

        return view('Receiving.UPRecList',compact('data'));
    }   
      
    
    

    
}
