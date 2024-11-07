<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use DataTables;


class StoreListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $branch = DB::table('branch')
        ->select('*')
        ->get();

        $data = DB::select("Select * from branch"); 

        return view('Reference.storeslist',compact('data','branch'));
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
        $data = $request->all();
        
        $BranchCode = trim(strtoupper($data['BranchCode']));
        $BranchName = trim(strtoupper($data['BranchName']));
        $Email = $data['Email'];
        $MobilieNumber = $data['MobileNumber'];
        $CreatedBy = 1; 
        
        
        //dd($data);

        // Call the stored procedure
        $results = DB::select('CALL SP_INSERT_BRANCH(?, ?, ?, ?, ?, ?, ?)', [
           $BranchCode,
           $BranchName,
           -1,                      
           $BranchCode,
           $Email,
           $MobilieNumber,
           $CreatedBy
       ]);
       //dd($results);

       if ($results) {
           
            $data = DB::select("Select * from branch"); 

           return view('Reference/storeslist', compact('data'));
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
