  
 @extends('index')   
 @section('content') 
    <!-- page title area start -->
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">
                                <h4 class="page-title pull-left">Item List</h4>
                                <ul class="breadcrumbs pull-left">
                                    <li><a href="">Receiving</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
    <!-- page title area end -->
    <div class="main-content-inner">
        <div class="row">
            <!-- Bootstrap Grid start -->
            <div class="col-12 mt-5">
            <!-- <div class="header-title">Add</div> -->
                <!-- Start 6 column grid system -->
                <div class="row">
                    <div class="col-md-12">
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


                                <h4 class="header-title">List - <span style="font-weight: bold; color: red;">{{$SONumber}}</span></h4>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm">Please see the delivery details before receiving the items:</span>
                                <div class="data-tables table-responsive">
                                    <table id="dataTable_RECdetails" class="table table-striped table-bordered table-hover">
                                        @csrf	
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th scope="col">#</th>
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
                                                    <td>{{ $detail->TransactionDetailID }}</td>
                                                    <td>{{ $detail->InventoryName }}</td>
                                                    <td>{{ $detail->Itemcode }}</td>
                                                    <td>{{ $detail->UOM_Desc }}</td>
                                                    <td>{{ $detail->ActualReceivedItem }}</td>
                                                    <td>  
                                                        <button class="btn btn-rounded btn-info mb-3 addExpiry-button" data-id="{{ $detail->TransactionDetailID }}" data-id2="{{ $detail->InventoryName }}" data-id3="{{ $detail->Itemcode }}" data-toggle="modal" data-target="#addActual" title ="Add Actual Item" ><i class="fa fa-plus"></i></button>
                                                        <button class="btn btn-rounded btn-info mb-3 viewRxpiry-button" data-id="{{ $detail->TransactionDetailID }}" data-id2="{{ $detail->InventoryName }}" data-toggle="modal" data-target="#viewExpModal" title ="View Expiration Details"><i class="fa fa-th-list"></i></button>
                                                    </td>
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