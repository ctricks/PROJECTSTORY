<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productList = DB::table('productmasterfile')
        ->select('*')
        ->get(); 

        $iteminventory = DB::table('iteminventory')
        ->select('*')
        ->where('id',0)
        ->get(); 

        $iteminventory = DB::select("CALL SP_GET_PRODUCT_SOH(?)", [null]); 
        // $iteminventory = DB::select("CALL SP_GET_ITEMINVENTORY_BRANCH(?,?,?,?)", [1,0,0, 1]); 
       
        $itemExpiry = DB::select("CALL SP_GET_RECEIVINGITEMS_EXPIRY(?, ?)", [0, 1]); 


        return view('Inventory.StatusDetails',compact('productList','iteminventory','itemExpiry'));

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
        $data = DB::table('productmasterfile')
        ->select('*') // Select all columns from both tables
        ->where('ID',$id) 
        ->first(); 

        $itemCode = $data->InventoryID;

        // $iteminventory = DB::select("CALL SP_GET_ITEMINVENTORY_BRANCH(?, ?, ?,?)", [0,1,$itemCode, 0]); 
        $iteminventory = DB::select("CALL SP_GET_PRODUCT_SOH(?)", [$itemCode]); 
       
      //  $itemExpiry = DB::select("CALL SP_GET_RECEIVINGITEMS_EXPIRY(?, ?)", [$itemCode, 1]); 
       $itemExpiry = DB::select("CALL SP_GET_EXPIRY_BY_ITEMCODE(?)", [$itemCode]); 

        $combinedResponse = [
            'data' => $data,
            'iteminventory' => $iteminventory,
            'itemExpiry' => $itemExpiry
        ];
    
        return response()->json($combinedResponse);
        
    }

    public function ItemListC()
    {
        $iteminventory = DB::select("CALL SP_GET_ITEM_LIST(1)"); 
        

        return view('Inventory.ItemListCost',compact('iteminventory'));
    }

    public function ItemList()
    {
        $iteminventory = DB::select("CALL SP_GET_ITEM_LIST(1)"); 
        

        return view('Inventory.ItemList',compact('iteminventory'));
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
