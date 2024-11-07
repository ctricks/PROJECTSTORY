  
 @extends('index')   
 @section('content') 
    <!-- page title area start -->
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">
                                <h4 class="page-title pull-left">SO</h4>
                                <ul class="breadcrumbs pull-left">
                                    <li><a href="">Ordering</a></li>
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
                            <div class="modal fade bd-example-modal-lg">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Create SO Header</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <form action="/store-so-upload" method = "POST" class="form">
										    @csrf	
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label class="col-4 col-form-label">Store</label>
                                                    <div class="col-8">
                                                        <select class="form-control form-control-sm input-rounded" id="BranchId" name="BranchId">
                                                            @forelse ($branch as $branches)
                                                            <option value="{{ $branches->id }}">{{ $branches->Name }}</option>
                                                            @empty
                                                            <option>No data found.</option>
                                                            @endforelse 
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="totItem-input" class="col-4 col-form-label">SO No.</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="text" value="0" id="SONumber" name ="SONumber" readonly/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="totItem-input" class="col-4 col-form-label">SO Date</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" id="SODate" name ="SODate" />
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group row">
                                                    <label for="totItem-input" class="col-4 col-form-label">SO Qty</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="number" value="0" id="totItem-input" name ="TotalItem" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="totItem-input" class="col-4 col-form-label">Total Quantity</label>
                                                    <div class="col-8">
                                                        <input class="form-control" type="number" value="0" id="totqty-input" name ="TOTALQUANTITY" />
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

                    <!-- Large modal modal end -->    
                    <div class="col-lg-6 mt-5">
                        <div class="card">
                            <div class="modal fade bd-example-modal-lgUpload">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Upload SO</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                            <div class="modal-body">                                                
                                                <form  action ="upload-soFile" method ="POST" enctype="multipart/form-data">
                                                @csrf	
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="totItem-input" class="col-4 col-form-label">SO No.</label>
                                                        <div class="col-8">
                                                            <input class="form-control" type="hidden" id="transactNo" name ="transactNo"/>
                                                            <input class="form-control" type="text" id="UpSONumber" name ="UpSONumber" readonly/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-4 col-form-label">File Name</label>
                                                        <div class="dropzone-msg dz-message needsclick">
                                                          <input type="file" class = "form-control-file" name="excel_file" id="file">
                                                        </div>
                                                        <button type="submit" class ="btn btn-success btn-primary"> Upload</button>
                                                    </div> 
                                                 </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
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
                                <h4 class="header-title">Upload List</h4>
                                <button type="button" class="btn btn-rounded btn-info mb-3" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus"> Create</i></button>
                                <div class="data-tables">
                                <table id="dataTable_recUpload" class="table table-striped table-bordered table-hover">
                                        @csrf	
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th scope="col">Transaction ID</th>
                                                <th scope="col">SO Number</th>
                                                <th scope="col">SO Date</th>
                                                <th scope="col">Created By</th>
                                                <th scope="col">Total Quantity</th>
                                                <th scope="col">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(is_null($UploadSO) == false)
                                                @forelse ($UploadSO as $UploadSOItem)
                                                    <tr>
                                                        <td>{{$UploadSOItem->Id}}</td>
                                                        <td>{{$UploadSOItem->SONumber}}</td>
                                                        <td>{{$UploadSOItem->SODate}}</td>                                                    
                                                        <td>{{$UploadSOItem->Username}}</td>
                                                        <td>{{$UploadSOItem->TotalQTY}}</td>
                                                        <td>
                                                            <button type="button" id="createBtn" class="btn btn-rounded btn-info mb-3 SOUpload-button" data-toggle="modal" data-target=".bd-example-modal-lgUpload"  data-id="{{ $UploadSOItem->SONumber }}" data-id2="{{ $UploadSOItem->Id }}">Upload</button>
                                                            <button type="button" id="createBtn" class="btn btn-rounded btn-info mb-3 " data-toggle="modal" data-target=".bd-example-modal-lgView">View</button>
                                                        </td>                                                    
                                                    </tr>       
                                                    @empty
                                                        <tr>
                                                            <td colspan="6">No data found.</td>
                                                        </tr>
                                                    @endforelse 
                                            @else
                                                        <tr>
                                                            <td colspan="6">No data found.</td>
                                                        </tr>
                                            @endif
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


   
</script>
        @endsection

