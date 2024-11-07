  
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
                                        <form action="/store-so" method = "POST" class="form">
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
                                                        <input class="form-control" type="text" id="SONumber" name ="SONumber" readonly/>
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


                <div class="row">
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Sales Order</h4>
                                <button type="button" class="btn btn-rounded btn-info mb-3 loadSO-btn" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus"> Add Header</i></button>
                                <div class="data-tables">
                                    <table id="so_dTable" class="table table-striped table-bordered table-hover">
										@csrf	
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th scope="col">id</th>
                                                <th scope="col">Store</th>
                                                <th scope="col">SO NO</th>
                                                <th scope="col">SO Date</th>
                                                <th scope="col">SO Total Item</th>                                                
                                                <th scope="col">SO Qty</th>                                                
                                                <th scope="col">Receiving Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @forelse ($data as $detail)
                                                <tr>
                                                <td>{{ $detail->Id }}</td>
                                                <td>{{ $detail->StoreName }}</td>
                                                <td>{{ $detail->SONumber }}</td>
                                                <td>{{ $detail->SalesOrderDate }}</td>                                                
                                                <td>{{ $detail->Total_Item }}</td>
                                                <td>{{ $detail->TOTALQUANTITY }}</td>
                                                <td>{{ $detail->Status }}</td>
                                                <td>
                                                    <a href="/createSO-list/{{ $detail->SONumber }}" class="btn btn-rounded btn-info mb-3" ><i class="fa fa-folder-open"></i></a>
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

