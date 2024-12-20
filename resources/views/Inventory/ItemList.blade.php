  
 @extends('index')   
 @section('content') 
    <!-- page title area start -->
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">
                                <h4 class="page-title pull-left">ITEM LIST</h4>
                                <ul class="breadcrumbs pull-left">
                                    <li><a href="">Items</a></li>
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
                    <!-- Large modal start -->
                    <div class="col-lg-6 mt-5">
                        <div class="card">
                            <div class="modal fade bd-example-modal-lg">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Create SO Header</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <form action="upload-so" method = "POST" enctype="multipart/form-data">
										    @csrf	
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label class="col-4 col-form-label">Store</label>
                                                    <div class="col-8">
                                                        {{-- <select class="js-example-basic-branch form-control-sm input-rounded responsive col-md-12 wider-select" id="BranchId" name="BranchId">
                                                            <option value="">Select Store</option>
                                                            @forelse ($branch as $branches)
                                                            <option value="{{ $branches->id }}">{{ $branches->Name }}</option>
                                                            @empty
                                                            <option>No data found.</option>
                                                            @endforelse
                                                         </select> --}}
                                                    </div>
                                                </div>
                                                {{-- <div class="form-group row">
                                                    <label for="totItem-input" class="col-4 col-form-label">SO No.</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="text" id="SONumber" name ="SONumber" readonly/>
                                                    </div>
                                                </div> --}}
                                                <div class="form-group row">
                                                    <label class="col-4 col-form-label">Vendor</label>
                                                    <div class="col-8">
                                                        {{-- <select class="js-example-basic-supplier form-control-sm input-rounded responsive col-md-12 wider-select" id="SupplierId" name="SupplierId">
                                                            @forelse ($supplier as $suppliers)
                                                            <option value="{{ $suppliers->id }}">{{ $suppliers->Name }}</option>
                                                            @empty
                                                            <option>No data found.</option>
                                                            @endforelse 
                                                        </select> --}}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="totItem-input" class="col-4 col-form-label">SO Date</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" id="SODate" name ="SODate" min="1900-01-01" max="2099-09-13" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                   <label class="col-4 col-form-label">File Name</label>
                                                    <div class="dropzone-msg dz-message needsclick">
                                                        <input type="file" class = "form-control-file" name="file" id="file">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-12 col-form-label">Excel Template (GSI BAKERY: <a href="../ExcelTemplate/GSI_OT_BAKERY_SAMPLE_SO_UPLOAD.xlsx" download>Click to download</a> ,GSI PR: <a href="../ExcelTemplate/GSI_OT_PR_SAMPLE_SO_UPLOAD.xlsx" download>Click to download</a> , PUL: <a href="../ExcelTemplate/PUL_SAMPLE_SO_UPLOAD.xlsx" download>Click to download</a>)</label>                                                     
                                                </div>
                                                    <!--  <div class="form-group mb-4">
                                                        <div class="custom-file text-left">
                                                            <input type="file" name="file" class="custom-file-input" id="customFile">
                                                            <label class="custom-file-label" for="customFile"></label>
                                                        </div>
                                                    </div> -->
                                                    <!-- </div> -->

                                                    <!-- <div class="form-group row">
                                                        <div class="col-8">
                                                            <div class="custom-file ">
                                                                <input type="file" name="file" class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                                </div>  
                                                            </div>  
                                                        <div class="col-8">
                                                             <label id="filenameLabel" class="mt-2">Filename: </label>
                                                        </div>
                                                    </div> -->
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
                                <h4 class="header-title">Sales Order</h4>
                                
                                <div class="data-tables">
                                    <table id="itemCostOnly_dTable" class="table table-striped table-bordered table-hover">
										@csrf	
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th scope="col">Item Code</th>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">UNIT</th>                                                                                               
                                            </tr>
                                        </thead>
                                        <tbody>                                                                                        
                                                @forelse ($iteminventory as $detail)                                                
                                                <tr>
                                                    <td>{{ $detail->InventoryID }}</td>
                                                    <td>{{ $detail->InventoryName }}</td>
                                                    <td>{{ $detail->UNIT }}</td>                                                    
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
<script type="text/javascript">
    const branchSelect = document.getElementById('BranchId');
    const supplierSelect = document.getElementById('SupplierId');
    let SONumberInput = document.getElementById('SONumber');

    branchSelect.addEventListener('change', () => {
    const selectedbranchId = branchSelect.value;
    
    fetch(`/get-sonumber/${selectedbranchId}`)
    .then(response => response.json())
    .then(data => {
        if (data && data.length > 0) {
            const soNumber = data[0].SO_Number;
            $("#SONumber").val(soNumber);
        } else {
            console.error('Error: No data received or invalid data format');
        }
    })
    .catch(error => {
        console.error('Error fetching So number:', error);
    });
    });

    supplierSelect.addEventListener('change', () => {
    const selectedsupplier = branchSelect.value;
    
alert('test');

    fetch(`/get-days/${selectedsupplier}`)
    .then(response => response.json())
    .then(data => {
        if (data && data.length > 0) {
            console.log(data);
        } else {
            console.error('Error: No data received or invalid data format');
        }
    })
    .catch(error => {
        console.error('Error fetching So number:', error);
    });
    });
   
       
</script>
        @endsection

