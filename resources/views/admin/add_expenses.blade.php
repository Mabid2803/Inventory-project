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
        .tbl_center
        {
            margin: auto;
            width: 50%;
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
                <h1 style="text-align: center; font-size: 40px; font-weight: bold; padding-top: 10px; padding-bottom: 20px">Add Expenses</h1>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                        {{session()->get('message')}}
                    </div>
                @endif
                <form class="center" method="POST" action="{{url('adding_expenses')}}">
                    @csrf
                    <div class="dev_design">
                        <label>Description:</label>
                        <input class="text-color" type="text" placeholder="Description" name="description">
                    </div>
                    <div class="dev_design">
                        <label>Amount:</label>
                        <input class="text-color" type="number" placeholder="Amount" name="amount">
                    </div>
                    <div class="dev_design">
                        <input class="btn btn-success" type="submit" value="Add Expenses">
                    </div>
                </form>
                <table class="tbl_center">
                    <tr>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Delete</th>
                    </tr>
                    @foreach($expenses as $expenses)
                        <tr>
                            <td>{{$expenses->description}}</td>
                            <td>{{$expenses->amount}}</td>
                            <td><a class="btn btn-danger" onclick="return confirm('Are you sure delete?')" href="{{url('delete_expenses', $expenses->id)}}">Delete</a></td>
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
