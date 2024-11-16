  
 @extends('index')   
 @section('content') 
    <!-- page title area start -->
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">
                                <h4 class="page-title pull-left">SO Approval Item List</h4>
                                <ul class="breadcrumbs pull-left">
                                    <li><a href="/uploadingSO">Ordering</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6 clearfix">
                            <div class="user-profile pull-right">
                                <img class="avatar user-thumb" src="{{asset('assets/images/author/avatar.png')}}" alt="avatar">
                                <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ session('user_name') }} <i class="fa fa-angle-down"></i></h4>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/logout">Log Out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <!-- page title area end -->
    <div class="main-content-inner">
        <div class="col-md-4 d-flex flex-column justify-content-end">
        @if (session('error'))
            <div class="alert alert-danger fade show" role="alert">
            {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">  
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row">
            @if (session('success'))
                <div class="alert alert-success fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>  
                  </button>
                </div>
            @endif 
            </div>
            <div id="alert-container"></div>
        </div>
        <div class="row">

        <!-- Large modal modal end -->    
        <div class="col-lg-6 mt-5">
                        <div class="card">
                            <div class="modal fade bd-example-modal-headerEdit">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update Header</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <form  action ="/update-header" method ="POST" class="form">
                                        @csrf	
                                            <div class="modal-body">                                                
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="totItem-input" class="col-4 col-form-label">SO No.</label>
                                                        <div class="col-8">
                                                            <input class="form-control" type="hidden" value="{{ $SOHeader[0]->SONumber }}" id="HSONumber" name ="HSONumber"/>
                                                            <input class="form-control" type="text" value="{{ $SOHeader[0]->SONumber }}" id="HeadSONumber" name ="HeadSONumber" readonly/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-4 col-form-label">SO Date:</label>
                                                        <div class="col-8">
                                                        <input type="date" class="form-control form-control-sm input-rounded" value="{{ $SOHeader[0]->SODate }}"  id="HSODate" name="HSODate" >                                            
                                                        </div> 
                                                    </div> 
                                                 </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- Large modal modal end -->

                     

            <!-- Bootstrap Grid start -->
            <div class="col-12 mt-5">
            <!-- <div class="header-title">Add</div> -->
                <!-- Start 6 column grid system -->
                <div class="row">
                    <div id = "divStoreDetails" class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="header-title">Add Item</h5>
                                <label class="col-form-label">SO Number: </label>
                                
                                <span style="font-weight: bold; color: red;"> {{$SONumber}} 
                                <div>
                                    @if( $SOHeader[0]->STATUS == "PENDING")
                                    <button type="button" id="headerEditBtn" class="btn btn-rounded btn-info mb-3 HeaderEdit-button"  data-toggle="modal" data-target=".bd-example-modal-headerEdit"  data-id="{{ $SOHeader[0]->SODate }}" data-id2="{{ $SOHeader[0]->PO_QTY }}" title="Edit Header"><i class="fa fa-edit"></i></button>
                                    @endif
                                    @if( $SOHeader[0]->STATUS == "RECEIVED" || $SOHeader[0]->STATUS == "PENDING")
                                    <a href="/duplicateSO-list/{{ $SONumber}}" class="btn btn-rounded btn-info mb-3" title="Duplicate Header & Details"><i class="fa fa-copy"></i></a>                                
                                    @endif
                                    @if( $SOHeader[0]->SOApproved = -1)
                                    <a href="/ForApproveSO/{{ $SONumber}}" class="btn btn-rounded btn-info mb-3" title="Approve SO Creation"><i class="fa fa-check"></i></a>
                                    <a href="/ForDisapproveSO/{{ $SONumber}}" class="btn btn-rounded btn-info mb-3" title="Disapprove SO Creation"><i class="fa fa-close"></i></a>
                                    @endif
                                </div>

                            </span>
                            <div class="form-group">
                                <label class="col-form-label">Status: </label>
                                <span style="font-weight: bold; color: black;">  {{ $SOHeader[0]->STATUS }}</span>
                            </div>

                                <!-- <div class="form-group">
                                        <label class="col-form-label">SO Number:</label>
                                        <input type="text" class="form-control form-control-sm input-rounded" value="{{ $SONumber }}" id="SONumber" name="SONumber" disabled>
                                </div> -->
                                <div class="form-group">
                                        <label class="col-form-label">SO Date:</label>
                                        <input type="text" class="form-control form-control-sm input-rounded" value="{{ $SOHeader[0]->SODate }}"  id="SODate" name="SODate" disabled>                                            
                                </div>
                                <div class="form-group">
                                        <label class="col-form-label">Total Quantity:</label>
                                        <input type="text" class="form-control form-control-sm input-rounded" value="{{ $SOHeader[0]->PO_QTY }}" id="TotalQty" name="TotalQty" disabled>                                            
                                </div>

                                <form action="/store-details" method = "POST" class="form">
                                    @csrf
                                    <input type="hidden" value="{{ $SONumber }}" name="SONumber">
                                    <input type="hidden"  id="ItemCodeH" name="ItemCodeH">
                                    <div class="form-group">
                                        <label class="col-form-label">Item</label>
                                            <!-- <select class="js-example-basic-singleA form-control-sm input-rounded responsive col-md-12"  id="product-selectA" name="InventoryItem" > -->
                                            <select class="js-example-basic-singleA form-control-sm input-rounded responsive col-md-12" id="product-selectA" name="InventoryItem" {{ $SOHeader[0]->STATUS == "RECEIVED" ? 'disabled' : '' }}>
                                                <option value="">Select Item</option>
                                                @forelse ($productList as $productLists)
                                                <option value="{{ $productLists->ID }}" >{{ $productLists->InventoryName }} - {{ $productLists->InventoryID }}</option>
                                                @empty
                                                <option>No data found.</option>
                                                @endforelse
                                            </select>
                                    </div>

                                    <!-- <div class="form-group">
                                        <label for="ItemCode">Item Code</label>
                                        <input type="text" class="form-control form-control-sm input-rounded" id="ItemCode" name="ItemCode" disabled>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="UOM">UOM</label>
                                        <input type="text" class="form-control form-control-sm input-rounded" id="UOM" name="UOM" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="COST">COST</label>
                                        <input type="text" class="form-control form-control-sm input-rounded" id="COST" name="COST" disabled>
                                        <input type="hidden" class="form-control form-control-sm input-rounded" id="CostH" name="CostH" hidden>
                                    </div>

                                   
                                    <div class="form-group">
                                        <label for="REC_QTY">Item Quantity</label>
                                        <input type="number" class="form-control form-control-sm input-rounded" id="PO_QTY" name="PO_QTY" {{ $SOHeader[0]->STATUS == "RECEIVED" ? 'disabled' : '' }}>
                                    </div>
                                    @if( $SOHeader[0]->STATUS == "PENDING")
                                    <button type="submit" class="btn btn-rounded btn-info mb-3" >Submit</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <!-- data table start -->
                        <div class="card">
                            <div class="card-body">
                                <!-- Large modal start -->
                                <div class="col-lg-6 mt-5">
                                    <div class="card">
                                        <div class="modal fade" id="editSODModal" tabindex="-1" role="dialog" aria-labelledby="addExpModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="header-title">Edit Item - <span style="font-weight: bold; color: red;">{{$SONumber}}</span></h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>

                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/update-details" method = "POST" class="form">
                                                            @csrf
                                                            <input type="hidden"  id="SOHItemCode" name="SOHItemCode">
                                                            <input type="hidden"  id="SOHId" name="SOHId">
                                                            
                                                            <div class="form-group row">
                                                                <label class="col-4 col-form-label">Choose to change Item</label>
                                                                <div class="col-8"> 
                                                                    <select class="js-example-basic-singleE form-control input-rounded responsive wider-select"  id="product-selectE" >
                                                                        <option value="">Select Item</option>
                                                                        @forelse ($productList as $productLists)
                                                                        <option value="{{ $productLists->ID }}">{{ $productLists->InventoryName }} - {{ $productLists->InventoryID }}</option>
                                                                        @empty
                                                                        <option>No data found.</option>
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="ItemCode" class="col-4 col-form-label">Item Description</label>
                                                                <div class="col-8">
                                                                    <input type="text" class="form-control form-control-sm input-rounded" id="SOHInventoryName" name="SOHInventoryName" disabled>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="form-group">
                                                                <label for="ItemCode">Item Code</label>
                                                                <input type="text" class="form-control form-control-sm input-rounded" id="ItemCodeE" name="ItemCodeE" disabled>
                                                            </div> -->
                                                            <div class="form-group row">
                                                                <label for="UOM" class="col-4 col-form-label">UOM</label>
                                                                <div class="col-8">
                                                                    <input type="text" class="form-control form-control-sm input-rounded" id="SOHUOM_Desc" name="SOHUOM_Desc" disabled>
                                                                </div>  
                                                            </div>  
                                                            <div class="form-group row">
                                                                <label for="UOM" class="col-4 col-form-label">COST</label>
                                                                <div class="col-8">
                                                                    <input type="text" class="form-control form-control-sm input-rounded" id="SOHCost" name="SOHCost" disabled>
                                                                </div>  
                                                            </div>  
                                                            <div class="form-group row">
                                                                <label for="REC_QTY" class="col-4 col-form-label">Total Quantity</label>
                                                                <div class="col-8">
                                                                 <input type="number" class="form-control form-control-sm input-rounded" id="SOHPO_QTY" name="SOHPO_QTY">
                                                                </div>
                                                            </div>
                                                             <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Large modal modal end -->

                                

                            <!-- table -->

                                <h4 class="header-title">List</h4>
                                <!-- <button type="button" class="btn btn-rounded btn-info mb-3" id="btn-Add" ><i class="fa fa-plus"></i></button> -->
                                <div class="data-tables table-responsive">
                                <!-- <table id="dataTable_SOdetails" class="table table-striped table-bordered table-hover"> -->
                                        <table id="dataTable_SOdetails" class="table table-striped table-bordered table-hover">
                                        @csrf	
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th scope="col">Description</th>
                                                <th scope="col">Item Code</th>
                                                <th scope="col">UOM</th>
                                                <th scope="col">QTY</th>
                                                <th scope="col">COST</th>
                                                <th scope="col">TOTAL COST</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @forelse ($details as $detail)
                                                <tr>
                                                <td>{{ $detail->InventoryName }}</td>
                                                <td>{{ $detail->ItemCode }}</td>
                                                <td>{{ $detail->UOM_Desc }}</td>
                                                <td>{{ $detail->PO_QTY }}</td>
                                                <td>{{ $detail->Cost }}</td>
                                                <td>{{ number_format(((float)($detail->PO_QTY * $detail->Cost)), 2, '.', '')  }}</td>
                                                <td>  
                                                    @if($SOHeader[0]->STATUS == "PENDING")
                                                    <button type="button" class="btn btn-rounded btn-info mb-3 ediHeaderD-btn" id="btn-editSODetailsModal" data-id="{{ $detail->TransactionID }}" data-id2="{{ $detail->InventoryName }}" data-id3="{{ $detail->ItemCode }}" data-id4="{{ $detail->UOM_Desc }}" data-id5="{{ $detail->PO_QTY}}" data-id6="{{ $detail->Cost}}" data-toggle="modal" data-target="#editSODModal" title="Edit Details"><i class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-rounded btn-info mb-3" id="btn-delSODetails" data-id="{{ $detail->TransactionID }}" data-id2="{{ $detail->InventoryName }}" data-id3 ="{{ $SOHeader[0]->SONumber }}" title ="Delete"><i class="fa fa-ban" ></i></button>
                                                    @endif

                                                </td>

                                                <!-- <td> -->
                                                    <!-- <button id="fetchDataButton" class="btn btn-rounded btn-info mb-3 edit-button" data-transaction-id="{{ $detail->TransactionID }}"><i class="fa fa-edit"></i></button> -->
                                                    <!-- <button id="addExpiry" class="btn btn-rounded btn-info mb-3 add-button" data-transaction-id="{{ $detail->TransactionID }}" ><i class="fa fa-plus"></i></button> -->
                                                    <!-- <button id="addExpiry" class="btn btn-rounded btn-info mb-3 add-button" data-transaction-id="{{ $detail->TransactionID }}" data-itemcode-id="{{ $detail->ItemCode }}" data-inventoryname-id="{{ $detail->InventoryName }}" data-toggle="modal" data-target="#addExpModal"><i class="fa fa-plus"></i></button> -->
                                                    <!-- <a href="/receiving-list/{{ $detail->TransactionID }}/edit" class="btn btn-rounded btn-info mb-3"><i class="fa fa-edit"></i></a> </td> -->
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="6">No data found.</td>
                                                </tr>
                                                @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- data table end --> 

                        <!-- data table start -->
                        <!-- <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">SO Reference List</h4>
                                <div class="data-tables table-responsive">
                                    <table id="dataTable_SOdetails" class="table table-striped table-bordered table-hover">
                                        @csrf	
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th scope="col">SO Number</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Item Code</th>
                                                <th scope="col">UOM</th>
                                                <th scope="col">Total Item</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @forelse ($details as $detail)
                                                <tr>
                                                <td>{{ $detail->TransactionID }}</td>
                                                <td>{{ $detail->InventoryName }}</td>
                                                <td>{{ $detail->ItemCode }}</td>
                                                <td>{{ $detail->UOM_Desc }}</td>
                                                <td>{{ $detail->PO_QTY }}</td>
                                                <td>{{ $detail->Cost }}</td>
                                                <td>{{ ($detail->PO_QTY * $detail->Cost) }}</td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="6">No data found.</td>
                                                </tr>
                                                @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> -->
                        <!-- data table end --> 
                    </div>
                </div>
            <!-- </div> -->
            <!-- Bootstrap Grid end -->
            </div>
        </div>
    </div>
            
    <!-- main content area end -->
<script type="text/javascript">
   
    </script>


@endsection