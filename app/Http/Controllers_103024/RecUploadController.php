<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SOUploadModel;
use App\Imports\SOImport;
use Illuminate\Support\Facades\DB;

class RecUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $uploadedFileList = DB::table('so_upload_table')
        // ->select('*') // Select all columns from both tables
        // ->groupby('EXCELFILENAME') // Filter based on provided or request ID
        // ->get(); 

        $branch = DB::table('branch')
        ->select('*') // Select all columns from both tables
        ->where('Status',1) 
        ->get(); 

        $SOdata = null;
        $UploadSODetails = null;

        // $UploadSO = DB::table('transactionheader')
        // ->select('Id','SONumber') // Select all columns from both tables
        // ->where('FromUpload',1)
        // ->where('isApproved',-1)
        // ->get(); 
        
        $UploadSO = DB::select("CALL SP_GET_FORUPLOAD_SO");

       //dd($SOForUpload);

        return view('Receiving.UploadSO',compact('branch','SOdata','UploadSO','UploadSODetails'));
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
    public function show($id)
    {
        $so_upload_table = DB::table('so_upload_table')
        ->select('*')
        ->get(); 

        return view('Receiving.UploadSOList',compact('so_upload_table'));
        
    }
    //For Retrieving Details Upon selecting SO in Upload Page
    public function showDetails(Request $request)
    {                
        //dd($request);
        
        $UploadSODetails = DB::select("CALL SP_GETDETAILS_RECEIVING_BY_SO(?)", [$request->SORec]); 
        
        $branch = DB::table('branch')
        ->select('*') // Select all columns from both tables
        ->where('Status',1) 
        ->get(); 

        $SOdata = DB::select("CALL SP_GET_UPLOAD_HEADER(?)", [$request->SORec]);


        $UploadSO = DB::table('transactionheader')
        ->select('Id','SONumber') // Select all columns from both tables
        ->where('FromUpload',1)
        ->where('isApproved',-1)
        ->get(); 

        dd($SOdata);

        return view('Receiving.UploadSO',compact('branch','SOdata','UploadSO','UploadSODetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadFile(Request $request)
    {
       $file = $request->file('excel_file');
       $transactNo = $request->input('transactNo');
       $filename = $file->getClientOriginalName();
       $import = new SOImport($filename);

            try {
                Excel::import($import, $file);
                return redirect()->back()->with([
                    'data' => $response->collect(),
                    'alert' => 'Data sent successfully',201
                ]);
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();
                $errors = [];
    
                foreach ($failures as $failure) {
                    $errors[] = [
                        'row' => $failure->row(),  
    
                        'attribute' => $failure->attribute(),
                        'errors' => $failure->errors(),
                        // 'alert', 'Error sending data'
                    ];
                }
    
                return response()->json(['errors' => $errors], 422);
            } catch (\Exception $e) {
                return response()->json(['alert' => 'An error occurred,duplicate entry'], 500);
            }
    }

}
