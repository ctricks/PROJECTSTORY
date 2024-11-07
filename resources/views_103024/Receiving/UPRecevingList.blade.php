  
 @extends('index')   
 @section('content') 
    <!-- page title area start -->
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">
                                <h4 class="page-title pull-left">Add Actual Item</h4>
                                <ul class="breadcrumbs pull-left">
                                    <li><a href="">Receiving</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
    <!-- page title area end -->
    <div class="main-content-inner">

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
                                                                    <input type="hidden" id="SONumberU" name="SONumberU" value="">

                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-4 col-form-label">DR NO.</label>
                                                                <div class="col-8">
                                                                    <input class="form-control" type="text" id="DRNo" name ="DRNo" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-4 col-form-label">DR Attachment link.</label>
                                                                <div class="col-8">
                                                                    <input class="form-control" type="text" id="DRLink" name ="DRLink" />
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

                <div class="row">
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">List</h4>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm">Please see the delivery details before receiving the items:</span>
                                <div class="data-tables">
                                    <table id="rec_itemdTable" class="table table-striped table-bordered table-hover">
										@csrf	
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th scope="col">id</th>
                                                <th scope="col">SO Date</th>
                                                <th scope="col">SO NO</th>
                                                <th scope="col">Item</th>
                                                <th scope="col">Actual Received</th>
                                                <th scope="col">Receiving Status</th>
                                                <th scope="col">DR Link</th>
                                                <th scope="col">Action</th>
     
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @forelse ($data as $row)
                                                <tr>
                                                <td>{{ $row->id }}</td>
                                                <td>{{ $row->SODate }}</td>
                                                <td>{{ $row->SONumber }}</td>
                                                <td>{{ $row->InventoryName }} - {{ $row->ItemCode }}</td>
                                                
                                                <td>{{ $row->ActualReceived  }}</td>
                                                <td>{{ $row->Status }}</td>
                                                <td><a href="https://www.example.com">Click for attachement</td>
                                                <td>
                                                     <!-- <a href="/addActualREC-list/{{ $row->SONumber }}" class="btn btn-rounded btn-info mb-3"><i class="fa fa-folder-open"></i></a> -->
                                                     <button class="btn btn-rounded btn-info mb-3 addExpiry-button" data-id="{{ $row->id }}" data-id2="{{ $row->InventoryName }}" data-id3="{{ $row->ItemCode }}" data-id4="{{ $row->SONumber }}" data-toggle="modal" data-target="#addActual" title ="Add Actual Item"><i class="fa fa-plus"></i></button>
                                                     <button class="btn btn-rounded btn-info mb-3 viewRxpiry-button" data-id="{{ $row->id }}" data-id2="{{ $row->InventoryName }}" data-toggle="modal" data-target="#viewExpModal" title ="View Expiration Details"><i class="fa fa-th-list"></i></button> </td>
                                                
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
                    </div>
                    <!-- data table end -->
                </div>
            </div>
        </div>
        <!-- main content area end -->
        @endsection

