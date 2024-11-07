<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\StoreModel;
use Datatables;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if(request()->ajax()){
        return datatables()->of(CategoryModel::select('*'))
        ->addColumn('Action','category-action')
        ->rawColumns('Action')
        ->addIndexColumn()
        ->make(true);
       }
    
       return view('Reference.Category');
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
    public function category($reference)
    {
        $reference = 'Category';
        $data = DB::table('settings')
        ->select('*') // Select all columns from both tables
        ->where('Module',$reference) 
        ->get(); 
       // dd($data);

        return view('Reference.Category',compact('data'));
    }

    public function vendors()
    {        
        $data = DB::table('vendormasterfile')
        ->select('*') // Select all columns from both tables        
	->where('id','>',1)
        ->get(); 
       // dd($data);

        return view('Reference.Vendor',compact('data'));
    }

    public function branch($reference)
    {
        $reference = 'Branch';
        $data = DB::table('Branch')
        ->select('*') // Select all columns from both tables
        // ->where('Module',$reference) 
        ->get(); 
       // dd($data);

        return view('Reference.Branch',compact('data'));
    }

    public function branchstore(Request $request)
    {
         // Validate the incoming request data
        $validatedData = $request->validate([
            'BranchCode' => 'required',
            'Name' => 'required',
            'SysBranchCode' => 'required',            
            // ... other validation rules
        ]);
        

        // Create a new model instance and fill it with the validated data
        $model = new StoreModel();

        $data = $request->all();

        $model->BranchCode = Str::upper($data['BranchCode']);
        $model->Name = Str::upper($data['Name']);
        $model->SysBranchCode = Str::upper($data['SysBranchCode']);
        $model->Email = Str::upper($data['Email']);
        $model->MobileNo = Str::upper($data['MobileNo']);

        //$model->Save();

        //Redirect or return a response based on your needs
        if ($model->fill($validatedData)->save()) {
            
            $data = DB::table('branch')
             ->select('*') // Select all columns from both tables            
             ->get(); 

            return view('Reference.Branch',compact('data'));

        } else {

            return redirect()->back()->withErrors(['error' => 'An error occurred while saving the data. Please try again.']);
            // An error occurred while executing th insert
            // Handle the error appro   priately
            
        }

    }

    public function categorystore(Request $request)
    {
         // Validate the incoming request data
        $validatedData = $request->validate([
            'Module' => 'required',
            'SettingName' => 'required',
            'Description' => 'required',
            'Value' => 'required',
            // ... other validation rules
        ]);
        

        // Create a new model instance and fill it with the validated data
        $model = new CategoryModel();

        // Redirect or return a response based on your needs
        if ($model->fill($validatedData)->save()) {
            
            $data = DB::table('settings')
            ->select('*') // Select all columns from both tables
            ->where('Module','Category') 
            ->get(); 

        return view('Reference.Category',compact('data'));

        } else {

        return redirect()->back()->withErrors(['error' => 'An error occurred while saving the data. Please try again.']);
            // An error occurred while executing th insert
            // Handle the error appropriately
            
        }

    }

    public function categoryupdate(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'Module' => 'required',
            'SettingName' => 'required',
            'Description' => 'required',
            'Value' => 'required',
        ]);

        $editItemId = $request->input('editItemId');

        $record = CategoryModel::findOrFail($request->input('editItemId'));

        if ($record->update($request->all())) {
            
            $data = DB::table('settings')
            ->select('*')
            ->where('Module','Category') 
            ->get(); 

        return view('Reference.Category',compact('data'))->with('success', 'Record updated successfully!');

        } else {

        return redirect()->back()->withErrors(['error' => 'An error occurred while saving the data. Please try again.']);
            
            
        }
    }

    public function branchupdate(Request $request)
    {

        // Validate the incoming request data
        $validatedData = $request->validate([
            'BranchCode' => 'required',
            'Name' => 'required',
            'SOCode' => 'required',
        ]);

        
        $record = StoreModel::findOrFail($request->input('editItemId'));


        if ($record->update($request->all())) {
            
            $data = DB::table('branch')
            ->select('*')
            // ->where('Module','Category') 
            ->get(); 

        return view('Reference.Branch',compact('data'))->with('success', 'Record updated successfully!');

        } else {

        return redirect()->back()->withErrors(['error' => 'An error occurred while saving the data. Please try again.']);
            
            
        }
    }

}
