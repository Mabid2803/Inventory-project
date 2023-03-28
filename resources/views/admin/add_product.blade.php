<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css');
    <style type="text/css">
        .center
        {
            text-align: center;
            padding-top: 40px;
        }
        .text-color
        {
            color: black;
        }
        label
        {
            display: inline-block;
            width: 200px;
        }
        .dev_design
        {
            padding-bottom: 15px;
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
                <h1 style="text-align: center; font-size: 40px; font-weight: bold; padding-top: 10px; padding-bottom: 20px">Add product</h1>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                        {{session()->get('message')}}
                    </div>
                @endif
                <form class="center" method="POST" action="{{url('adding_product')}}">
                    @csrf
                    <div class="dev_design">
                        <label>Product Title:  </label>
                        <input class="text-color" type="text" placeholder="Product Title" name="title">
                    </div>
                    <div class="dev_design">
                        <label>Purchase Price:  </label>
                        <input class="text-color" type="number" placeholder="Purchase Price" name="purchase_price">
                    </div>
                    <div class="dev_design">
                        <label>Sale Price:  </label>
                        <input class="text-color" type="number" placeholder="Sale Price" name="sale_price">
                    </div>
                    <div class="dev_design">
                        <label>Category:  </label>
                        <select class="text-color" name="category">
                            <option value="" selected="">Add a Category</option>
                            @foreach($category as $category)
                                <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="dev_design">
                        <input class="btn btn-success" type="submit" value="Add Product">
                    </div>
                </form>
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
