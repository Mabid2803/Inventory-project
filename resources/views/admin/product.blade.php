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
<div class="modal fade" id="salemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" style="color: white" data-dismiss="modal" aria-hidden="true">X</button>
            </div>
            <form method="Post" action="{{url('sale_product')}}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input style="color: black" type="hidden" name="product_id" id="product_id">
                    <input style="color: black" type="hidden" id="product_title">
                    <input style="color: black" type="hidden" id="category">
                    <label>Quantity:</label>
                    <input style="color: black; margin-left: 6px" name="quantity" type="number" placeholder="Quantity"><br>
                    <label>Sale Price:</label>
                    <input style="color: black; margin-top: 5px" type="number" name="sale_price" id="sale_price" placeholder="Sale Price">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Sale</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="purchasemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" style="color: white" data-dismiss="modal" aria-hidden="true">X</button>
            </div>
            <form method="Post" action="{{url('purchase_product')}}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input style="color: black" type="hidden" name="product_id" id="products_id">
                    <input style="color: black" type="hidden" id="product_title">
                    <input style="color: black" type="hidden" id="category">
                    <label>Quantity:</label>
                    <input style="color: black; margin-left: 6px" name="quantity" type="number" placeholder="Quantity"><br>
                    <label>Purchase Price:</label>
                    <input style="color: black; margin-top: 5px" type="number" name="purchase_price" id="purchase_price" placeholder="Purchase Price">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Purchase</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        @include('admin.header')
        <div class="main-panel">
            <div class="content-wrapper">
                <h1 style="text-align: center; font-size: 40px; font-weight: bold; padding-top: 10px; padding-bottom: 20px">Product</h1>
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
                        <th>Purchase product</th>
                        <th>Sale product</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    @foreach($product as $product)
                        <tr>
                            <td>{{$product->product_title}}</td>
                            <td>{{$product->product_category}}</td>
                            <td><button type="button" data-price-type="{{$product->purchase_price}}" class="btn purchasebtn btn-success" value="{{$product->id}}">Purchase</button></td>
                            <td><button type="button" data-price-type="{{$product->sale_price}}" class="btn salebtn btn-warning" value="{{$product->id}}">Sale</button></td>
                            <td><a class="btn btn-primary" href="{{url('edit_product', $product->id)}}">Edit</a></td>
                            <td><a class="btn btn-danger" onclick="return confirm('Are you sure delete product?')" href="{{url('delete_product', $product->id)}}">Delete</a></td>
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
<script>
    $(document).ready(function (){
        $(document).on('click', '.salebtn', function ()
        {
            var product_id = $(this).val();
            $('#salemodal').modal('show');
            var sale_price = (this.getAttribute('data-price-type'))
            $('#sale_price').val(sale_price)
            $('#product_id').val(product_id)
            $.ajax({
                type: "GET",
                url: "/add_sales/"+product_id,
                success: function (response) {
                    $('#product_title').val(response.products.product_title)
                    $('#category').val(response.products.product_category)
                }
            })
        });
    });
    $(document).ready(function (){
        $(document).on('click', '.purchasebtn', function ()
        {
            var product_id = $(this).val();
            $('#purchasemodal').modal('show');
            var purchase_price = (this.getAttribute('data-price-type'))
            $('#purchase_price').val(purchase_price)
            $('#products_id').val(product_id)
            $.ajax({
                type: "GET",
                url: "/add_purchase/"+product_id,
                success: function (response) {
                    $('#product_title').val(response.products.product_title)
                    $('#category').val(response.products.product_category)
                }
            })
        });
    });
</script>
</body>
</html>
