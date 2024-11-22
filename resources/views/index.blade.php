<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PROJECT STORY - FoodCosting</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="{{asset('image/png')}}" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slicknav.min.css')}}">
     <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- <link rel="stylesheet" href="{{asset('assets/css/export.css')}}" type="text/css" media="all" /> -->
    <!-- others css -->
    <link rel="stylesheet" href="{{asset('assets/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/customize.css')}}">

    <!-- modernizr css -->
    <script src="{{asset('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>

    <!-- Start datatable css -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css"> -->
   
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->

</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <h1 style="color: white;">PROJECT STORY</h1>
                    <!-- <a href=""><img src="{{asset('assets/images/icon/logo.png')}}" alt="logo"></a> -->
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                        <li><a href="/dashboard" aria-expanded="true"><i class="ti-dashboard"></i> <span>dashboard</span></a></li>
                                @if(auth()->user()->role == 'soEncoder' || auth()->user()->role == 'Admin') 
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Ordering
                                    </span></a>
                                <ul class="collapse">
                                    <!-- <li><a href="/createSO">Store Order</a></li> -->
                                    <li><a href="/uploadingSO">Store Order</a></li>
                                    {{-- <li><a href="/createSOWOS">Store Order (W/O SO)</a></li> --}}
                                    <li><a href="/SOApproval">Approval</a></li>
                                    <li><a href="/SOConsolidated">Consolidated SO</a></li>
                                    {{-- <li><a href="/SOApproved">Approved List</a></li> --}}
                                   <!-- <li><a href="/createSODS">DROPSHIPPING</a></li>  -->
                                </ul>
                            </li>
                                @endif
                                @if(auth()->user()->role == 'recEncoder' || auth()->user()->role == 'Admin') 
                             <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Receiving
                                    </span></a>
                                <ul class="collapse">
                                @if(auth()->user()->role == 'recEncoder') 
                                    <li><a href="/createREC">Receive</a></li>
                                    {{-- <li><a href="/createRECNOSO">Receive (WO SO)</a></li> --}}
                                    <!-- <li><a href="/uploadSO">SO Upload</a></li> -->
                                    <li><a href="/uploadREC">Upload</a></li>
                                @endif
                                    {{-- <li><a href="/createRECDS">Receive (Dropshipping)</a></li> --}}
                                @if(auth()->user()->role == 'Approver') 
                                    <li><a href="/approvalSO">Approval</a></li>
                                @endif
                                @if(auth()->user()->role == 'Admin') 
                                <li><a href="/createREC">Receive</a></li>
                                <!-- <li><a href="/addActualREC">New UI</a></li> -->
                                {{-- <li><a href="/createRECNOSO">Receive (WO SO)</a></li> --}}
                                    <li><a href="/uploadSO">Upload</a></li>
                                    <li><a href="/approvalSO">Approval</a></li>
                                    <li><a href="/approvedSO">Approved List</a></li>
                                 @endif

                                </ul>
                            </li>
                                 @endif
                              
                                 @if(auth()->user()->role == 'Admin') 
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-pie-chart"></i><span>Sales</span></a>
                                <ul class="collapse">
                                    <li><a href="">Upload</a></li>
                                    <li><a href="">Approval</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-palette"></i><span>Inventory</span></a>
                                <ul class="collapse">
                                    <li><a href="/status-details">Status/Details</a></li>
                                    <li><a href="/ItemListC">Item List (w/ Cost)</a></li>
                                    <li><a href="/ItemList">Item List (w/o Cost)</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-slice"></i><span>Reports</span></a>
                                <ul class="collapse">
                                    <li><a href="/"></a></li>
                                    <li><a href="/"></a></li>
                                    <li><a href="/"></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-table"></i>
                                    <span>Reference</span></a>
                                <ul class="collapse">
                                    <li><a href="">Brand Lists</a></li>
                                    <li><a href="/category/Category">Category Lists</a></li>
                                    <li><a href="">Sub-Category Lists</a></li>
                                    <li><a href="">UOM Lists</a></li>
                                    <li><a href="">Store Lists</a></li>
                                    <li><a href="">Product Bundle</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers-alt"></i> <span>User</span></a>
                                <ul class="collapse">
                                    <li><a href=""></a></li>
                                    <li><a href=""></a></li>
                                    <li><a href=""></a></li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <form action="#">
                                <!-- <input type="text" name="search" placeholder="Search..." required> -->
                                <!-- <i class="ti-search"></i> -->
                            </form>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            <!-- <li class="user-profile pull-right">
                                <h4 class="user-name dropdown-toggle" data-toggle="dropdown">Admin<i class="fa fa-angle-down"></i></h4>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/logout">Log Out</a>
                                </div>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            @yield('content')
            
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->

    <!-- jquery latest version -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    
    <!-- bootstrap 4 js -->
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slicknav.min.js')}}"></script>

    <!-- all line chart activation -->
    <script src="{{asset('assets/js/line-chart.js')}}"></script>
    <!-- all bar chart activation -->
    <script src="{{asset('assets/js/bar-chart.js')}}"></script>
    <!-- all pie chart -->
    <script src="{{asset('assets/js/pie-chart.js')}}"></script>
    <!-- others plugins -->

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>

    <script src="{{asset('assets/js/plugins.js')}}"></script>
    <script src="{{asset('assets/js/scripts.js')}}"></script>

    <!-- Start datatable js -->4
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>
<script>
  let table = new DataTable('#category_dTable', 
    {
    columns: [
        { mDataProp: 'id' },
        { mDataProp: 'Module' },
        { mDataProp: 'SettingName' },
        { mDataProp: 'Value' },
        { mDataProp: 'Description' },
        { mDataProp: null, render: function(data, type, row) {
            return '<button type="button" class="btn btn-rounded btn-info mb-3 edit-button" data-toggle="modal" data-target="#EditModal" data-id="' + row.id + '" data-id2="' + row.Module + '" data-id3="' + row.SettingName + '" data-id4="' + row.Value + '" data-id5="' + row.Description + '"><i class="fa fa-edit"></i></button>';
        } }
    ],columnDefs: [ { "defaultContent": "-", "targets": "_all" } ]
});

let so_dTable = new DataTable('#so_dTable', 
    {
    columns: [
        { mDataProp: 'Id' },
        { mDataProp: 'Vendor' },
        { mDataProp: 'StoreName' },
        { mDataProp: 'OrderDate' },
        { mDataProp: 'SONumber' },
        { mDataProp: 'SODate' },
        { mDataProp: 'Total_Item' },
        { mDataProp: 'TOTALQUANTITY' },
        { mDataProp: 'Status' },
        { mDataProp: null, render: function(data, type, row) {
            return '<a href="/createSO-list/' + row.SONumber + '" class="btn btn-rounded btn-info mb-3"><i class="fa fa-folder-open"></i></a>';
        
        } }
    ],columnDefs: [ { "defaultContent": "-", "targets": "_all" } ]          
});

let soCon_dTable = new DataTable('#soCon_dTable', 
    {
    columns: [
        { mDataProp: 'SODate' },
        { mDataProp: 'CATEGORY' },
        { mDataProp: 'CLASSIFICATION' },
        { mDataProp: 'ItemCode' },
        { mDataProp: 'ItemName' },
        { mDataProp: 'Packaging' },
        { mDataProp: 'UNIT' },        
        { mDataProp: '1' },
        { mDataProp: '2' },
        { mDataProp: '3' },          
        { mDataProp: 'TOTAL' },          
    ],columnDefs: [ { "defaultContent": "-", "targets": "_all" } ]          
});

let itemCost_dTable = new DataTable('#itemCost_dTable', 
    {
    columns: [
        { mDataProp: 'ItemCode' },
        { mDataProp: 'ItemName' },
        { mDataProp: 'UNIT' },
        { mDataProp: 'COST' },            
    ],columnDefs: [ { "defaultContent": "-", "targets": "_all" } ]          
});

let itemCostOnly_dTable = new DataTable('#itemCostOnly_dTable', 
    {
    columns: [
        { mDataProp: 'ItemCode' },
        { mDataProp: 'ItemName' },
        { mDataProp: 'UNIT' },        
    ],columnDefs: [ { "defaultContent": "-", "targets": "_all" } ]          
});

let soApp_dTable = new DataTable('#soApp_dTable', 
    {
    columns: [
        { mDataProp: 'OrderDate' },
        { mDataProp: 'SODate' },
        { mDataProp: 'SONumber' },
        { mDataProp: 'TOTAL_ITEM' },
        { mDataProp: 'TotalQuantity' },
        { mDataProp: 'CreatedBy' },
        { mDataProp: 'Vendor' },
        { mDataProp: 'Branch' },
        { mDataProp: 'STATUS' },
        { mDataProp: null, render: function(data, type, row) {
            return '<a href="/createSOApp-list/' + row.SONumber + '" class="btn btn-rounded btn-info mb-3"><i class="fa fa-folder-open"></i></a>';
        
        } }
    ],columnDefs: [ { "defaultContent": "-", "targets": "_all" } ],
    order: [[0, 'desc']]
});

let dataTable_SOdetails = new DataTable('#dataTable_SOdetails', 
    {
    columns: [
        { mDataProp : 'InventoryName' },
        { mDataProp : 'ItemCode' },
        { mDataProp : 'UOM_Desc' },
        { mDataProp : 'Cost' },
        { mDataProp : 'PO_QTY' },
        { mDataProp : 'TotalCost' },
        { mDataProp : 'Action' }
        //{ data: null, render: function(data, type, row) {
        //    return '<button type="button" class="btn btn-rounded btn-info mb-3 edit-button"  data-id="' + detail.id + '" data-id2="' + detail.InventoryName + '" data-id3="' + detail.ItemCode + '" data-id4="' + detail.UOM_Desc  + '" data-id5="' + detail.PO_QTY  + '"><i class="fa fa-edit"></i></button>';
           
        // } }
    ]
    ,columnDefs: [ { "defaultContent": "-", "targets": "_all" } ]
});


let rec_dTable = new DataTable('#rec_dTable', 
    {
    columns: [
        { mDataProp: 'StoreName' },
        { mDataProp: 'SONumber' },
        { mDataProp: 'OrderDate' },
        { mDataProp: 'ActualReceivedItem' },
        { mDataProp: 'Status' },
        { mDataProp: null, render: function(data, type, row) {
            return '<a href="/updateREC-list/' + row.id + '/' + row.SONumber + '" class="btn btn-rounded btn-info mb-3"><i class="fa fa-folder-open"></i></a>';
        } }
    ],columnDefs: [ { "defaultContent": "-", "targets": "_all" } ]
});

let dataTable_RECdetails = new DataTable('#dataTable_RECdetails', 
    {
    columns: [
        { mDataProp: 'ReceivingDate' },
        { mDataProp: 'InventoryName' },
        { mDataProp: 'ItemCode' },
        { mDataProp: 'UOM_Desc' },
        { mDataProp: 'PO_QTY' },
        { mDataProp: null, render: function(data, type, row) {
            return '<button type="button" class="btn btn-rounded btn-info mb-3 edit-button"  data-id="' + row.TransactionID + '" data-id2="' + detail.InventoryName + '" data-id3="' + detail.Itemcode + '" data-id4="' + detail.SONumber + '"><i class="fa fa-edit"></i></button>';
           
        } }
    ],columnDefs: [ { "defaultContent": "-", "targets": "_all" } ]
});

let dataTable_Rec_Approval = new DataTable('#dataTable_Rec_Approval', 
    {
    columns: [
        { mDataProp: 'TransactionNumber' },
        { mDataProp: 'SONumber' },
        { mDataProp: 'ApprovalStatus' },
        { mDataProp: null, render: function(data, type, row) {
            return '<a href="/approval-list/' + row.TransactionNumber + '/' + row.SONumber + '" class="btn btn-rounded btn-info mb-3"><i class="fa fa-folder-open"></i></a>';
           
        } }
    ],columnDefs: [ { "defaultContent": "-", "targets": "_all" } ]
});

let dataTable_Rec_Approved = new DataTable('#dataTable_Rec_Approved', 
    {
    columns: [
        { mDataProp: 'TransactionNumber' },
        { mDataProp: 'SONumber' },
        { mDataProp: 'ApprovalStatus' },
        { mDataProp: null, render: function(data, type, row) {
            return '<a href="/approved-list/' + row.SONumber + '" class="btn btn-rounded btn-info mb-3"><i class="fa fa-folder-open"></i></a>';
           
        } }
    ],columnDefs: [ { "defaultContent": "-", "targets": "_all" } ]
});

</script>
<script>
    $(document).ready(function() {
        $('.edit-button').click(function() {
            var rowId = $(this).data('id');
                var rowModule = $(this).data('id2');
                var rowValue = $(this).data('id3');
                var rowSettingName = $(this).data('id4');
                var rowDescription = $(this).data('id5');
                $('#editItemIdE').val(rowId);
                $('#ModuleE').val(rowModule);
                $('#ValueE').val(rowValue);
                $('#SettingNameE').val(rowSettingName);
                $('#DescriptionE').val(rowDescription);
            });
        });
    
</script>
<script>
        $('.SOUpload-button').click(function() {
            var rowSONumber = $(this).data('id');
            var rowtransactNo = $(this).data('id2');
            $('#UpSONumber').val(rowSONumber);
            $('#transactNo').val(rowtransactNo);
            
        });
</script>
<script>
    $(document).ready(function() {
        $('.ediHeaderD-btn').click(function() {
                var rowId = $(this).data('id');
                var rowInventoryName = $(this).data('id2');
                var rowItemCode = $(this).data('id3');
                var rowUOM_Desc = $(this).data('id4');
                var rowPO_QTY = $(this).data('id5');
                var rowCost = $(this).data('id6');
                $('#SOHId').val(rowId);
                $('#SOHInventoryName').val(rowInventoryName);
                $('#SOHItemCode').val(rowItemCode);
                $('#SOHUOM_Desc').val(rowUOM_Desc);
                $('#SOHPO_QTY').val(rowPO_QTY);
                $('#SOHCost').val(rowCost);
            });
        });
    
</script>


<script>
            $('.dropdown-item').click(function() {
                var status = $(this).data('status');
                var id = $(this).data('value');

                $.ajax({
                    url: '/update-status-rec',
                    type: 'PUT',
                    data: {
                        status: status,
                        id: id,
                       _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
					    alert('Successfully Approved!');
                        console.log(response);
                        location.reload();
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
</script>
<script type="text/javascript">
    $('.add-button').click(function() {
        var transactionId = $(this).data('transaction-id');
        var itemCodeid = $(this).data('itemcode-id');
        var inventoryname = $(this).data('inventoryname-id');

        // $('#addExpModal').modal('show');
        $('#transactionIdInput').val(transactionId);
        $('#itemcodeIdInput').val(itemCodeid);
        $('#inventoryNameInput').val(inventoryname);
    });
</script>
<script>
    $('.accordion-toggle').click(function() {
        var transactionId = $(this).data('id');
        $(this).siblings('.accordion-collapse').find('tr').hide();
        $('#collapse' + transactionId).find('tr').show();
        loadTable(transactionId);
    });
    

    function loadTable(transactionId) {
        $.ajax({
            url: '/get-table-expiry/' + transactionId,
            type: 'GET',
            success: function(data) {
                // alert(data.REC_Qty);
                // $('#table' + transactionId).html(data);
                if (Array.isArray(data) && data.length > 0) {
            var table = $('#table');
            table.empty();

            data.forEach(function(item) {
                var row = $('<tr></tr>');
                row.append('<td>' + item.REC_Qty + '</td>');
                row.append('<td>' + item.Expiration_date + '</td>');
                table.append(row);
            });
        } else {
            console.error('Data is not in the expected format:', data);
        }
    },
            error: function(error) {
                console.error('Error fetching table data:', error);
            }
        });
    }
</script>
<script type="text/javascript">
    // Get the active tab on page load
    var activeTabId = $('.nav-link.active').attr('id');

    // Handle tab clicks
    $('.nav-link').on('click', function() {
        var tabId = $(this).attr('id');
    alert(tabId);
    $('#activeTab').val(tabId);
        
  });

</script>
<script type="text/javascript">
    const productSelectInv = document.getElementById('product-selectInv');
    const inventoryIdInputInv = document.getElementById('ItemCode');
    const ItemCodeHInputInv = document.getElementById('ItemCodeH');
    const UOMInputInv = document.getElementById('UOM');
    const dataTableOnhandBody = $('#dataTable_onhand tbody'); // Target element for on-hand data
    const dataTableExpiryBody = $('#dataTable_expiry tbody'); // Target element for expiry data

    productSelectInv.addEventListener('change', () => {
     const selectedProductId = productSelectInv.value;

    fetch(`/get-itemcodeInv/${selectedProductId}`)
        .then(response => response.json())
        .then(combinedResponse => {
            if (!combinedResponse) {
                console.error('Error fetching item data.');
                return; // Exit if no data found
            }

            const selectData = combinedResponse.data;
            const selectItemInventory = combinedResponse.iteminventory;
            const selectItemExpiry = combinedResponse.itemExpiry;

            inventoryIdInputInv.value = selectData.InventoryID;
            ItemCodeHInputInv.value = selectData.InventoryID;
            UOMInputInv.value = selectData.Packaging;

            // Clear existing rows for both tables
            dataTableOnhandBody.empty();
            dataTableExpiryBody.empty();

            populateInventoryTable(selectItemInventory, dataTableOnhandBody);
            populateExpiryTable(selectItemExpiry, dataTableExpiryBody);
            })
            .catch(error => {
            console.error('Error fetching inventory name:', error);
            });
     });                         

        function populateInventoryTable(data, targetBody) {
        $.each(data, function (index, item) {
            const row = $('<tr></tr>');
            row.append('<td>' + item.SOH + '</td>');
            targetBody.append(row);
        });
        }

        function populateExpiryTable(data, targetBody) {
        $.each(data, function (index, item) {
            const row = $('<tr></tr>');
            row.append('<td>' + item.ActualReceived + '</td>');
            row.append('<td>' + item.ExpirationDate + '</td>');
            row.append('<td><a href="./approved-list/' + item.SONumber + '">' + item.SONumber + '</a></td>');
            targetBody.append(row);
        });
        }

        
        
</script>
<script>
    const soQuantityInput = document.getElementById('ActualQTY');
    const recordQuantityInput = document.getElementById('PO_QTYE');
    const discrepancyInput = document.getElementById('Discrepancy');

    soQuantityInput.addEventListener('input', calculateDiscrepancy);
    recordQuantityInput.addEventListener('input', calculateDiscrepancy);

    function calculateDiscrepancy() {
        const soQuantity = parseInt(soQuantityInput.value);
        const recordQuantity = parseInt(recordQuantityInput.value);
        const discrepancy = soQuantity - recordQuantity;
        discrepancyInput.value = discrepancy;
    }
</script>
<script>
    $(document).ready(function() {
        $('#btn-editSODetails').click(function() {
                alert("ok");
                var rowId = $(this).data('id');
                $("#divStoreDetails").hide();
                $("#divEditDetails").show();
                var rowDescription = $(this).data('id2');
                var rowItemCode = $(this).data('id3');
                var rowUOM = $(this).data('id4');
                var rowTotalItem = $(this).data('id5');
                $('#IdE').val(rowId);
                $('#product-selectE').val(rowDescription);
                $('#ItemCodeE').val(rowItemCode);
                $('#ItemCodeHE').val(rowItemCode);
                $('#UOME').val(rowUOM);
                $('#PO_QTYE').val(rowTotalItem);
            event.preventDefault();

            });

            // $('#btn-editSODetailsModal').click(function() {
            $('#dataTable_SOdetails').on('click', '#btn-editSODetailsModal', function() {

            var rowId = $(this).data('id');
            var rowDescription = $(this).data('id2');
            var rowItemCode = $(this).data('id3');
            var rowUOM = $(this).data('id4');
            var rowTotalItem = $(this).data('id5');
            var rowCost = $(this).data('id6');
            $('#IdE').val(rowId);
            $('#product-selectE').val(rowDescription);
            $('#ItemCodeE').val(rowItemCode);
            $('#ItemCodeHE').val(rowItemCode);
            $('#UOME').val(rowUOM);
            $('#COST').val(rowCost);
            $('#PO_QTYE').val(rowTotalItem);
        });

$('#dataTable_SOdetails').on('click', '#btn-delSODetails', function() {
    var transactionId = $(this).data('id');
    var InventoryName = $(this).data('id2');
    var SONumber = $(this).data('id3');

    if (confirm('Are you sure you want to delete this sales order detail for ' + InventoryName + '?')) {
        $.ajax({
                        url: "/delSOdetail/" + transactionId + "/" + SONumber,
            type: 'DELETE',
            data: {
                transactionId: transactionId,
                            SONumber: SONumber,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    // Remove the deleted row's parent TR element
                    $(this).closest('tr').remove();
                                $('#alert-container').append('<div class="alert alert-success fade show" role="alert">' +
                                        'Sales order detail deleted successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                                // Refresh the DataTable
                                location.reload();
                    // dataTable_SOdetails.draw();
                    // $('#dataTable_SOdetails').DataTable().destroy();
                    // $('#dataTable_SOdetails').DataTable({
                    //     columns: [
                    //         { data: 'TransactionID' },
                    //         { data: 'InventoryName' },
                    //         { data: 'ItemCode' },
                    //         { data: 'UOM_Desc' },
                    //         { data: 'PO_QTY' },
                    //         { data: null, render: function(data, type, row) {
                    //             return '<button type="button" class="btn btn-rounded btn-info mb-3 ediHeaderD-btn" id="btn-editSODetailsModal" data-id="{{ ' + row.TransactionID + ' }}" data-id2="{{ ' + row.InventoryName + ' }}" data-id3="{{ ' + row.ItemCode + ' }}" data-id4="{{ ' + row.UOM_Desc + ' }}" data-id5="{{ ' + row.PO_QTY + '}}" data-toggle="modal" data-target="#editSODModal" title="Edit Details"><i class="fa fa-edit"></i></button>' +
                    //                 '<button type="button" class="btn btn-rounded btn-info mb-3" id="btn-delSODetails" data-id="{{ ' + row.TransactionID + ' }}" data-id2="{{ ' + row.InventoryName + ' }}" data-id3="{{ ' + row.SONumber + ' }}" title ="Delete"><i class="fa fa-ban" ></i></button>';
                    //         } }

                    //              ]
                    // })
                } else {
                                    // Append an error alert to the container
                                    $('#alert-container').append('<div class="alert alert-danger fade show" role="alert">' +
                                        'Error deleting sales order detail.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }

            },
            error: function(error) {
                alert('An error occurred.');
            }
        });
    }            });
        });
  </script>

<script>
    $(document).ready(function() {

            $('.js-example-basic-single').select2();
            $('.js-example-basic-singleA').select2();
            $('.js-example-basic-singleE').select2();
            $('.js-example-basic-singleInv').select2();
            
            $('.js-example-basic-branch').select2();
            $('.js-example-basic-supplier').select2();
        
        
            $("#product-select").change(function() {
                var selectedItem = $(this).val();  // Get the selected item ID
                // Make an AJAX request to fetch item details based on selected ID
                $.ajax({
                    url: "/get-itemcode/" + selectedItem,  // Replace with your actual URL endpoint
                    method: "GET",
                    dataType: "json",
                    success: function(data) {
                        $("#ItemCode").val(data[0].InventoryID);
                        $("#ItemCodeH").val(data[0].InventoryID);
                        $("#UOM").val(data[0].Packaging);
                        $("#Cost").val(data[0].Cost);
                        // Update other input fields as needed based on the data object
                    },
                    error: function(error) {
                        console.error("Error fetching item details:", error);
                    }
                });
            }); 
            
            $("#product-selectA").change(function() {
                var selectedItem = $(this).val();  // Get the selected item ID                
                // Make an AJAX request to fetch item details based on selected ID
                $.ajax({
                    url: "/get-itemcode/" + selectedItem,  // Replace with your actual URL endpoint
                    method: "GET",
                    dataType: "json",                    
                    success: function(data) {
                        console.log(data);
                        $("#ItemCode").val(data[0].InventoryID);
                        $("#ItemCodeH").val(data[0].InventoryID);
                        $("#UOM").val(data[0].Packaging);
                        $("#CostH").val(data[0].Cost);
                        $("#COST").val(data[0].Cost);
                        // Update other input fields as needed based on the data object
                    },
                    error: function(error) {
                        console.error("Error fetching item details:", error);
                    }
                });
            }); 

            $("#product-selectE").change(function() {
                var selectedItem = $(this).val();  // Get the selected item ID
                // Make an AJAX request to fetch item details based on selected ID
                $.ajax({
                    url: "/get-itemcode/" + selectedItem,  // Replace with your actual URL endpoint
                    method: "GET",
                    dataType: "json",
                    success: function(data) {
                        $("#SOHItemCode").val(data[0].InventoryID);
                        $("#SOHInventoryName").val(data[0].InventoryName);
                        $("#SOHUOM_Desc").val(data[0].Packaging);                        
                        // Update other input fields as needed based on the data object
                    },
                    error: function(error) {
                        console.error("Error fetching item details:", error);
                    }
                });
            }); 

            $("#product-selectInv").change(function() {
                var selectedItem = $(this).val();  // Get the selected item ID
                // Make an AJAX request to fetch item details based on selected ID
                $.ajax({
                    url: "/get-itemcodeInv/" + selectedItem,  // Replace with your actual URL endpoint
                    method: "GET",
                    dataType: "json",
                    success: function(combinedResponse) {
                        if (!combinedResponse) {
                console.error('Error fetching item data.');
                return; // Exit if no data found
            }

                    const selectData = combinedResponse.data;
                    const selectItemInventory = combinedResponse.iteminventory;
                    const selectItemExpiry = combinedResponse.itemExpiry;

                    inventoryIdInputInv.value = selectData.InventoryID;
                    ItemCodeHInputInv.value = selectData.InventoryID;
                    UOMInputInv.value = selectData.Packaging;

                    // Clear existing rows for both tables
                    dataTableOnhandBody.empty();
                    dataTableExpiryBody.empty();

                    populateInventoryTable(selectItemInventory, dataTableOnhandBody);
                    populateExpiryTable(selectItemExpiry, dataTableExpiryBody);
            
                    },
                    error: function(error) {
                        console.error("Error fetching item details:", error);
                    }
                });
            });

            // Hide both divs initially
            $("#divEditDetails").hide();

            $('#btn-Add').click(function() {
                $("#divEditDetails").hide();
                $("#divStoreDetails").show();
            });
        

           
            
            $('#btn-editRECDetails').click(function() {
                var rowId = $(this).data('id');
                var rowReceivingDate = $(this).data('id2');
                var rowDescription = $(this).data('id3');
                var rowItemCode = $(this).data('id4');
                var rowUOM = $(this).data('id5');
                var rowTotalItem = $(this).data('id6');
                $('#IdE').val(rowId);
                $('#InventoryNameE').val(rowDescription);
                $('#ReceivingDateE').val(rowReceivingDate);
                $('#ItemCodeE').val(rowItemCode);
                $('#ItemCodeHE').val(rowItemCode);
                $('#UOME').val(rowUOM);
                $('#PO_QTYE').val(rowTotalItem);

            });
            
            $('.addExpiry-button').click(function() {
                var rowTransactionID = $(this).data('id');
                var rowInventoryName = $(this).data('id2');
                var rowitemcodeId = $(this).data('id3');
                var rowSONumber = $(this).data('id4');
                $('#TransDetailID').val(rowTransactionID);
                $('#inventoryName').val(rowInventoryName);
                $('#itemcodeId').val(rowitemcodeId);
                $('#SONumberU').val(rowSONumber);

                
            });

      
});
   
</script>

<script>
    $(document).ready(function() {
      
        $('#ExpiryCheck').on('change', function() {
        if ($(this).is(':checked')) {
            $('#Expiration_date').prop('disabled', true);
        } else {
            $('#Expiration_date').prop('disabled', false);
        }

        });

        $('.addview-button').on('click', function() {
            // Get the data attributes from the button
        
                var rowTransactionID = $(this).data('id');
                var rowInventoryName = $(this).data('id2');
                var rowitemcodeId = $(this).data('id3');
                $('#viewTransactionDetailID').val(rowTransactionID);
                $('#inventoryName').val(rowInventoryName);
                $('#itemcodeId').val(rowitemcodeId);
        });
       
        $('.Approval-button').on('click', function() {
            var confirmed = confirm("Are you sure you want to Approve?");
            if (confirmed) {
                var SONumber = $(this).data('id');

                $.ajax({
                    url: '/approved-SO',
                    type: 'POST',
                    data: {
                        SONumber: SONumber,
                       _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
					    alert('Successfully Approved!');
                        console.log(response);
                        location.reload();
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            
            } else {
            // Cancel the action
            alert("Action canceled.");
            }
        });

        $('#modalexpiryDataTable').DataTable();
        
        $('.viewRxpiry-button').on('click', function() {
            var transactionDetailId = $(this).data('id');
            var ItemDesriptionId = $(this).data('id2');

            // Make an AJAX request to fetch the data
            $.ajax({
                url: '/fetch-expiration', // Replace with your endpoint
                type: 'POST',
                data: {
                    transactionDetailID: transactionDetailId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data);
                    
                    $('#viewTransactionDetailID').val(transactionDetailId);
                    $('#ItemDesriptionId').val(ItemDesriptionId);
                    if (data && data.length > 0) {
                        // Clear the table before appending new data
                        $('#modalexpiryDataTable tbody').empty();
                        
                            $.each(data, function(index, item) {
                                var row = $('<tr></tr>');
                                row.append('<td>' + item.InventoryName + '</td>');
                                row.append('<td>' + item.ItemCode + '</td>');
                                row.append('<td>' + item.ActualReceived + '</td>');
                                row.append('<td>' + item.ExpirationDate + '</td>');
                                $('#modalexpiryDataTable tbody').append(row);
                        // Append the item's name to the input field
                            });
                 
                        $('#viewExpModal').modal('show');

                    } else {
                        // Handle case where no data is received
                        console.error('No data received from the server.');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error cases
                    console.error('Error fetching data:', xhr.responseText);
                }
            });
        });

        
    });
</script>
<script>
  $(document).ready(function() {
    $("#SupplierId").change(function() {
      var selectedSupplierId = $(this).val();
      $.ajax({
        url: "/get-days/" + selectedSupplierId,
        method: "GET",
        dataType: "json",
        success: function(response) {
            if(response.length > 0)
            {                
                document.getElementById("SODate").setAttribute("min", response[0]['MINDATE'].substring(0,10));
                document.getElementById("SODate").setAttribute("max", response[0]['MAXDATE'].substring(0,10));             
            }else
            {
                document.getElementById("SODate").setAttribute("min", '1901-01-01');
                document.getElementById("SODate").setAttribute("max", '2099-12-31');             
            }
        },
        error: function(error) {
          console.error("Error fetching Dates:", error);
        }
      });
    });
  });
</script>
<script>
$(document).ready(function() {
    $('.alert').delay(4000).fadeOut('slow');

    $('#alert-container .alert').delay(4000).fadeOut('slow');
    
    });
</script>
   

    

</html>
