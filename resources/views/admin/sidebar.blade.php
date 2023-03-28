<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="index.html"><img src="assets/images/logo.svg" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">{{$username}}</h5>
                    </div>
                </div>
        <li class="nav-item menu-items">
            <a class="nav-link" href="redirect">
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Products</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('add_product')}}">Add Product</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('product')}}">Product</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('sale')}}">Sale Product</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('purchase')}}">Purchase Product</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Inventory</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('inventory')}}">Inventory</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('purchased_item')}}">Purchased Item</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('sold_item')}}">Sold Items</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="category">
                <span class="menu-title">Category</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="add_expenses">
                <span class="menu-title">Expenses</span>
            </a>
        </li>
    </ul>
</nav>
