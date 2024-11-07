  
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

                <div class="row">
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">List</h4>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm">Please see the delivery details before receiving the items:</span>
                                <div class="data-tables">
                                    <table id="rec_dTable" class="table table-striped table-bordered table-hover">
										@csrf	
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th scope="col">SO Date</th>
                                                <th scope="col">SO NO</th>
                                                <th scope="col">Item</th>
                                                <th scope="col">Actual Received</th>
                                                <th scope="col">Receiving Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @forelse ($data as $row)
                                                <tr>
                                                <td>{{ $row->SODate }}</td>
                                                <td>{{ $row->SONumber }}</td>
                                                <td>{{ $row->InventoryName }} - {{ $row->ItemCode }}</td>
                                                <td>{{ $row->ActualReceived  }}</td>
                                                <td>{{ $row->Status }}</td>
                                                <td>
                                                     <a href="/updateREC-list/{{ $row->id }}/{{ $row->SONumber }}" class="btn btn-rounded btn-info mb-3"><i class="fa fa-folder-open"></i></a>
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
        @endsection

