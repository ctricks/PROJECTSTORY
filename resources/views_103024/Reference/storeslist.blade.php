  
 @extends('index')   
 @section('content') 
    <!-- page title area start -->
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">
                                <h4 class="page-title pull-left">SO</h4>
                                <ul class="breadcrumbs pull-left">
                                    <li><a href="">Store Lists</a></li>
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
                            <div class="modal fade bd-example-modal-lg" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">CREATE STORE</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <form action="/store-branch" method = "POST" class="form" id="newModalForm">
										    @csrf	
                                            <div class="modal-body">                                                
                                                <div class="form-group row">
                                                    <label for="totItem-input" class="col-4 col-form-label">Store Code.</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="text" value="" id="BranchCode" name ="BranchCode" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="totItem-input" class="col-4 col-form-label">Store Name</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="text" value="" id="BranchName" name ="BranchName" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="totItem-input" class="col-4 col-form-label">Email Address</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="email" value="" id="Email" name ="Email" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="totItem-input" class="col-4 col-form-label">Mobile Number</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="number" value="" id="MobileNumber" name ="MobileNumber" />
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
                <div class="col-lg-6 mt-5">
                        <div class="card">
                            <div class="modal fade bd-example-modal-lgE">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">EDIT STORE</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <form action="/store-so" method = "POST" class="form">
										    @csrf	
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label class="col-4 col-form-label">Store Code:</label>
                                                        <div class="col-8">
                                                            <input class="form-control" type="text" value="" id="StoreCode" name ="StoreCode" />
                                                        </div>                                                    
                                                </div>
                                                <div class="form-group row">
                                                    <label for="totItem-input" class="col-4 col-form-label">SO No.</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="text" value="0" id="SONumber" name ="SONumber" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="totItem-input" class="col-4 col-form-label">Total Item</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="number" value="0" id="totItem-input" name ="TotalItem" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="totItem-input" class="col-4 col-form-label">Total Quantity</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="number" value="0" id="totqty-input" name ="TOTALQUANTITY" />
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
                

                <div class="row">
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Store Lists</h4>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm">Here are the lists of available stores:</span>
                                    <button type="button" class="btn btn-rounded btn-info mb-3" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus"></i></button>                                    
                                <div class="data-tables">
                                    <table id="dataTable" class="table table-striped table-bordered table-hover">
										@csrf	
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Branch Code</th>
                                                <th scope="col">Branch Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Mobile Number</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Created By</th>
                                                <th scope="col">Created Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse ($data as $row)
                                                <tr>
                                                <td>{{ $row->id }}</td>
                                                <td>{{ $row->SysBranchCode }}</td>
                                                <td>{{ $row->Name }}</td>
                                                <td>{{ $row->Email }}</td>
                                                <td>{{ $row->MobileNo }}</td>
                                                <td>{{ $row->Status }}</td>
                                                <td>{{ $row->CreatedBy }}</td>
                                                <td>{{ $row->created_at }}</td>
                                                <td>
                                                     <button type="button" class="btn btn-rounded btn-info mb-3" data-toggle="modal" data-target=".bd-example-modal-lgE"><i class="fa fa-pencil"></i></button>
                                                     <a href="{{ $row->id }}" class="btn btn-rounded btn-info mb-3"><i class="fa fa-close"></i></a>
                                                </td>
                                                
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="6">No data found.</td>
                                                </tr>
                                                @endforelse
                                            </tr>
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