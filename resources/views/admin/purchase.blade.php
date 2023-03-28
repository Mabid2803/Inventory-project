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
                <h1 style="text-align: center; font-size: 40px; font-weight: bold; padding-top: 10px; padding-bottom: 20px">Purchased Product</h1>
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
                        <th>Quantity</th>
                        <th>Purchase price</th>
                        <th>Purchased</th>
                        <th>Delete</th>
                    </tr>
                    @foreach($purchase as $purchase)
                        <form action="{{url('purchased', [$purchase->id,$purchase->item_id])}}" method="POST">
                            @csrf
                        <tr>
                            <td>{{$purchase->product_title}}</td>
                            <td>{{$purchase->product_category}}</td>
                            <td><input style="color: black" type="number" value="{{$purchase->quantity}}" name="quantity" placeholder="Quantity"></td>
                            <td><input style="color: black" type="number" value="{{$purchase->purchase_price}}" name="purchase_price"></td>
                            <td><button type="submit" class="btn btn-success">Purchased</button></td>
                            <td><a class="btn btn-danger" href="{{url('delete_purchase', $purchase->id)}}">Delete</a></td>
                        </tr>
                        </form>
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
