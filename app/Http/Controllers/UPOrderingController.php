<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\SOUploadImport;
use App\Models\TransactionDetailsModel;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class UPOrderingController extends Controller
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
       
        $email = auth()->user()->email;
        $SiteByUser = auth()->user()->branchid;

        $branch = DB::select("CALL SP_GET_SITE_PER_EMAIL(?)", [$email]); 

        if(count($branch) == 0)
        {
            $branch = DB::table('branch')
            ->select('*')
            ->where('id',[$SiteByUser])
            ->get();             
        }

        $supplier = DB::table('vendormasterfile')
        ->select('*')
        //->where('Status',1)
        ->get(); 

        $data = DB::select("CALL SP_CHECK_SO_ONLOAD(?, ?)", [$branchId,$ascending]); 
        
        return view('Ordering.UploadSO',compact('data','branch','supplier'));
        // return response()->json($data);
    }

    public function SOApproval()
    {
        $ascending = 0; // Default to ascending order
        $branchId =  0;//auth()->user()->branchid;
       
        $email = auth()->user()->email;
        $SiteByUser = auth()->user()->branchid;

        $branch = DB::select("CALL SP_GET_SITE_PER_EMAIL(?)", [$email]); 

        if(count($branch) == 0)
        {
            $branch = DB::table('branch')
            ->select('*')
            ->where('id',[$SiteByUser])
            ->get();             
        }

        $supplier = DB::table('vendormasterfile')
        ->select('*')
        //->where('Status',1)
        ->get(); 

        $data = DB::select("CALL SP_GET_LIST_SOAPPROVAL(-1)"); 
        $DataType = 'Approval';
        
        return view('Ordering.SOApproval',compact('data','branch','supplier','DataType'));
    }

    public function SOApproved()
    {
        $ascending = 0; // Default to ascending order
        $branchId =  0;//auth()->user()->branchid;
       
        $email = auth()->user()->email;
        $SiteByUser = auth()->user()->branchid;

        $branch = DB::select("CALL SP_GET_SITE_PER_EMAIL(?)", [$email]); 

        if(count($branch) == 0)
        {
            $branch = DB::table('branch')
            ->select('*')
            ->where('id',[$SiteByUser])
            ->get();             
        }

        $supplier = DB::table('vendormasterfile')
        ->select('*')
        //->where('Status',1)
        ->get(); 

        $data = DB::select("CALL SP_GET_LIST_SOAPPROVAL(1)"); 
        $DataType = 'Approved';
        
        return view('Ordering.SOApproval',compact('data','branch','supplier','DataType'));
    }


    public function import(Request $request)
    {
        
        $data = $request->all();

        if($data['BranchId'] == null)
        {
            return redirect()->back()->with('error' , 'An error occurred while saving the data. Please try again.');
        }


        $TransactionType = "SO";
        $orderDate = now();
        $receivingDate = now();
        $totalItem = 0;
        $totalqty = 0;
        $SupplierId = $data['SupplierId'];
        $BranchId = $data['BranchId'];
        $SODate = $data['SODate'];
        $formattedOrderDate = date('Y-m-d H:i:s', strtotime($orderDate));

        $getSO = DB::select("CALL SP_GET_LAST_SO_BYBRANCH(?)", [$BranchId]);
        $newSO = $getSO[0]->SO_Number;

        // Call the stored procedure
        $results = DB::select('CALL SP_INSERT_TRANSACTIONHEADER(?, ?, ?, ?, ?, ?, ?,?,?,?)', [
            $TransactionType,
            $orderDate,
            $receivingDate,
            $totalItem,
            $totalqty,
            1, // auth()->user()->id,
            $SupplierId,
            $BranchId, // auth()->user()->branchid,
            $newSO, // auth()->user()->branchid,
            $formattedOrderDate,
        ]);

        if ($request->hasFile('file')) {
             $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            // $import = new SOUploadImport($filename);
            $import = new SOUploadImport($getSO[0]->SO_Number, $filename);

            if (!empty($filename)) {

                    // Excel::import(new SOUploadImport($getSO[0]->SO_Number),$filename, $request->file('file')->store('files'));
                    Excel::import($import, $request->file('file')->store('files'));
                $data = DB::select("CALL SP_SET_CONSO_SONUMBER (?, ?)", [$newSO,1]); 

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

                // $paramId = $id;
                $SONumber = $newSO;
                // $Status = $Status;
                $SOHeader = DB::select("CALL SP_GET_SO_TRANSACTIONHEADER(?)",[$newSO]);
                
                    // return view('Ordering.SOItemList',compact('productList','details','SONumber','SOHeader'));
              return Redirect::route('createSO-list', ['SONumber' => $SONumber]);

            } else {
                // Handle the case where no file is selected
                return redirect()->back()->with('error', 'Please select a file to upload.');
            }
        }
        else
        {
            $data = DB::select("CALL SP_SET_CONSO_SONUMBER (?, ?)", [$newSO,1]); 

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

            // $paramId = $id;
            $SONumber = $newSO;
            // $Status = $Status;
            $SOHeader = DB::select("CALL SP_GET_SO_TRANSACTIONHEADER(?)",[$newSO]);
            
            // return view('Ordering.SOItemList',compact('productList','details','SONumber','SOHeader'));
        return Redirect::route('createSO-list', ['SONumber' => $SONumber]);

        }
    }

        // Excel::import(new SOUploadImport, $request->file('file')->store('files'));
        // return redirect()->back();              
  

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
        //
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
}
