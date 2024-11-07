  
 @extends('index')   
 @section('content') 
    <!-- page title area start -->
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">
                                <h4 class="page-title pull-left">Upload</h4>
                                <ul class="breadcrumbs pull-left">
                                    <li><a href="">Receiving</a></li>
                                </ul>
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
            </div>
                    <!-- Large modal start -->
                    <div class="col-lg-6 mt-5">
                        <div class="card">
                            <div class="modal fade bd-example-modal-lg">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Upload Receiving</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <form action="upload-StoreRec" method = "POST" enctype="multipart/form-data">
										    @csrf	
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                   <label class="col-4 col-form-label">File Name</label>
                                                    <div class="dropzone-msg dz-message needsclick">
                                                        <input type="file" class = "form-control-file" name="file" id="file">
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
                                <h4 class="header-title">List</h4>
                                <button type="button" class="btn btn-rounded btn-info mb-3 loadSO-btn" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus">Upload File</i></button>
                                <div class="data-tables">
                                    <table id="so_dTable" class="table table-striped table-bordered table-hover">
										@csrf	
                                        <thead class="bg-light text-capitalize">
                                        </thead>
                                        <tbody>
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

