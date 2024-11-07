  
 @extends('index')   
 @section('content') 
    <!-- page title area start -->
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">
                                <h4 class="page-title pull-left">Add Actual Data</h4>
                                <ul class="breadcrumbs pull-left">
                                    <li><a href="/createREC">Receiving</a></li>
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
                                        <form  action ="/update-headerREC" method ="POST" class="form">
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
                                                    <!-- <div class="form-group row">
                                                        <label class="col-4 col-form-label">DR NO.</label>
                                                        <div class="col-8">
                                                            <input class="form-control" type="text" id="DRNo" name ="DRNo" />
                                                        </div>
                                                    </div> -->
                                                    <div class="form-group row">
                                                        <label class="col-4 col-form-label">DR Attachment link.</label>
                                                        <div class="col-8">
                                                            <input class="form-control" type="text" id="DRLink" name ="DRLink" />
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
                    </div>
                    <!-- Large modal modal end -->

                    <!-- Large modal modal end -->    
                    
                        </div>
                    <!-- Large modal modal end -->

            <!-- Bootstrap Grid start -->
            <div class="col-12 mt-5">
            <!-- <div class="header-title">Add</div> -->
                <!-- Start 6 column grid system -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="header-title">SO Details</h5>
                                <label class="col-form-label">SO Number: </label>
                                <span style="font-weight: bold; color: red;">  {{ $SOHeader[0]->SONumber }}
                                <button type="button" id="headerEditBtn" class="btn btn-rounded btn-info mb-3 HeaderEdit-button"  data-toggle="modal" data-target=".bd-example-modal-headerEdit"  data-id="{{ $SOHeader[0]->SODate }}" data-id2="{{ $SOHeader[0]->PO_QTY }}" title="Edit Header"><i class="fa fa-edit"></i></button>
                            </span>
                            <div class="form-group">
                                <label class="col-form-label">Status: </label>
                                <span style="font-weight: bold; color: black;">  {{ $SOHeader[0]->STATUS }}</span>
                            </div>
                            <div class="for m-group">
                                <label class="col-form-label">SO Date: </label>
                                <span style="font-weight: bold; color: black;">  {{ $SOHeader[0]->SODate }}</span>
                            </div>
                            <div class="for m-group">
                                <label class="col-form-label">DR Attachmentlink: </label>
                                <span style="font-weight: bold; color: black;"> <a href="{{ $SOHeader[0]->DRAttachment }}">{{ $SOHeader[0]->DRAttachment}}</a> </span>
                            </div>

                                <!-- <form action="/store-actualDetails" method = "POST" class="form" enctype="multipart/form-data">
                                    @csrf
                                    
                                    @if(isset($SOHeader[0]->STATUS) && $SOHeader[0]->STATUS != "RECEIVED" || $SOHeader[0]->STATUS != "INCOMPLETE")
                                    <input type="hidden" class="form-control form-control-sm input-rounded" value="{{ $SOHeader[0]->SONumber }}" id="SONumber" name="SONumber"> -->
                                   
                                    
                                     <!-- <div class="form-group">
                                        <label for="DrNo">DR #</label>
                                        <input type="text" class="form-control form-control-sm input-rounded" id="DrNo" name="DrNo">
                                    </div> -->
                                    <!-- <div class="form-group">
                                        <label class="col-4 col-form-label">File Name</label>
                                        <div class="dropzone-msg dz-message needsclick">
                                            <input type="file" class = "form-control-file" name="file" id="file">
                                        </div>
                                    </div> -->
                                   
                                    <!-- <button type="submit" class="btn btn-rounded btn-info mb-3" >Submit</button>
                                    @endif
                                </form> -->
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
                                        <div class="modal fade" id="addActual" tabindex="-1" role="dialog" aria-labelledby="addActualLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Add Actual Details</h5>
                                                        
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <form action="/store-expiry" method = "POST" class="form">
                                                        @CSRF
                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <label class="col-4 col-form-label">Item</label>
                                                                <div class="col-8">
                                                                    <input class="form-control" type="text" id="inventoryName" name="inventoryname" disabled />
                                                                    <input type="hidden" id="TransDetailID" name="TransDetailID">
                                                                    <input type="hidden" id="itemcodeId" name="itemcode">
                                                                    <input type="hidden" id="SONumberU" name="SONumberU" value="{{ $SOHeader[0]->SONumber }}">

                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-4 col-form-label">DR NO.</label>
                                                                <div class="col-8">
                                                                    <input class="form-control" type="text" id="DRNo" name ="DRNo" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="totItem-input" class="col-4 col-form-label">Receiving Date</label>
                                                                <div class="col-8">
                                                                    <input class="form-control" type="date" id="ReceivingDate" name ="ReceivingDate"  value="{{ date('Y-m-d') }}" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="totItem-input" class="col-4 col-form-label">Received Qty</label>
                                                                <div class="col-8">
                                                                    <input class="form-control" type="number" value="0" id="Qty" name ="Qty" />
                                                                </div>
                                                            </div>
                                                            <!-- <div class="form-group row">
                                                                 <label for="totItem-input" class="col-4 col-form-label"></label>

                                                                <div class="custom-control custom-checkbox">
                                                                  <input type="checkbox" checked="" class="custom-control-input" id="ExpiryCheck">
                                                                  <label class="custom-control-label" for="customCheck1">wo Expiration Date</label>
                                                                </div>
                                                            </div> -->
                                                            <div class="form-group row">
                                                                <label for="totItem-input" class="col-4 col-form-label">Expiration Date</label>
                                                                <div class="col-8">
                                                                    <input class="form-control" type="date" value="0" id="Expiration_date" name ="Expiration_date" />
                                                                </div>
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
                                <!-- Large modal modal end -->
                               
                                 <!-- Large modal start -->
                                 <div class="col-lg-12 mt-5">
                                    <div class="card">
                                        <div class="modal fade" id="viewExpModal" tabindex="-1" role="dialog" aria-labelledby="viewExpModalModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title">Expiration Details - <input type="text" id="ItemDesriptionId" name="ItemDesriptionId" disabled></h5>
                                                        
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <form action="" method = "" class="form">
                                                        @CSRF
                                                        <div class="modal-body">
                                                        <table id="modalexpiryDataTable" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                            <th>Item Description</th>
                                                            <th>Item Code</th>
                                                            <th>Actual Received</th>
                                                            <th>Expiration Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                        </tbody>
                                                        </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
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
                                <table id="dataTable_RECdetails" class="table table-striped table-bordered table-hover">
                                        @csrf	
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th scope="col">Description</th>
                                                <th scope="col">Item Code</th>
                                                <th scope="col">UOM</th>
                                                <th scope="col">Total Received Item</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @forelse ($details as $detail)
                                                <tr>
                                                    <td>{{ $detail->InventoryName }}</td>
                                                    <td>{{ $detail->Itemcode }}</td>
                                                    <td>{{ $detail->UOM_Desc }}</td>
                                                    <td>{{ $detail->ActualReceivedItem }}</td>
                                                    <td>  
                                                    <!-- <button class="btn btn-rounded btn-info mb-3 addExpiry-button" data-id="{{ $detail->TransactionDetailID }}" data-id2="{{ $detail->InventoryName }}" data-id3="{{ $detail->Itemcode }}" data-toggle="modal" data-target="#addActual" title ="Add Actual Item" disabled><i class="fa fa-plus"></i></button> -->
                                                    @if($SOHeader[0]->STATUS == "PENDING" || $SOHeader[0]->STATUS == "INCOMPLETE" )
                                                    <button class="btn btn-rounded btn-info mb-3 addExpiry-button" data-id="{{ $detail->TransactionDetailID }}" data-id2="{{ $detail->InventoryName }}" data-id3="{{ $detail->Itemcode }}" data-id4="{{ $SOHeader[0]->SONumber }}" data-toggle="modal" data-target="#addActual" title ="Add Actual Item"><i class="fa fa-plus"></i></button>
                                                    <button class="btn btn-rounded btn-info mb-3 viewRxpiry-button" data-id="{{ $detail->TransactionDetailID }}" data-id2="{{ $detail->InventoryName }}" data-toggle="modal" data-target="#viewExpModal" title ="View Expiration Details"><i class="fa fa-th-list"></i></button>
                                                    </td>
                                                    @endif
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