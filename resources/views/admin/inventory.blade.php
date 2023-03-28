<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css');
    <style type="text/css">
        .center
        {
            text-align: center;
        }
        .tbl_center
        {
            margin: auto;
            width: 80%;
            text-align: center;
            margin-top: 10px;
        }
        table,th,td
        {
            padding-top: 5px;
            padding-bottom: 5px ;
            border: 1px solid white;
        }
    </style>
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        @include('admin.header')
        <div class="main-panel">
            <div class="content-wrapper">
                <h1 style="text-align: center; font-size: 40px; font-weight: bold; padding-top: 10px; padding-bottom: 20px">Inventory</h1>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                        {{session()->get('message')}}
                    </div>
                @endif
                <table class="tbl_center">
                    <tr>
                        <th>Product Title</th>
                        <th>Category</th>
                        <th>Purchase Price</th>
                        <th>Sale Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                    @foreach($inventory as $inventory)
                        <tr>
                            <td>{{$inventory->product_title}}</td>
                            <td>{{$inventory->product_category}}</td>
                            <td>{{$inventory->purchase_price}}</td>
                            <td>{{$inventory->sale_price}}</td>
                            @if($inventory->quantity == "0")
                                <td style="font-weight: bold; color: red" >Out of Stock</td>
                            @else
                                <td>{{$inventory->quantity}}</td>
                            @endif
                            <td>{{$inventory->total_price}}</td>
                            <td><a class="btn btn-danger" onclick="return confirm('Are you sure delete inventory?')" href="{{url('delete_inventory', $inventory->id)}}">Delete</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<!-- plugins:js -->
<script src={{asset('admin/assets/vendors/js/vendor.bundle.base.js')}}></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src={{asset('admin/assets/vendors/chart.js/Chart.min.js')}}></script>
<script src={{asset('admin/assets/vendors/progressbar.js/progressbar.min.js')}}></script>
<script src={{asset('admin/assets/vendors/jvectormap/jquery-jvectormap.min.js')}}></script>
<script src={{asset('admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}></script>
<script src={{asset('admin/assets/vendors/owl-carousel-2/owl.carousel.min.js')}}></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src={{asset('admin/assets/js/off-canvas.js')}}></script>
<script src={{asset('admin/assets/js/hoverable-collapse.js')}}></script>
<script src={{asset('admin/assets/js/misc.js')}}></script>
<script src={{asset('admin/assets/js/settings.js')}}></script>
<script src={{asset('admin/assets/js/todolist.js')}}></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src={{asset('admin/assets/js/dashboard.js')}}></script>
<!-- End custom js for this page -->

</body>
</html>
