<!-- Sidebar -->
<div class="sidebar">

    {{-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> --}}
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            {{-- <li class="nav-item ">
                <a href="{{ route('redirect') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p >
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li> --}}
            <li class="nav-item">
                <a href="{{ route('backadmin') }}" class="nav-link" style="text-indent: 2px; padding-bottom: 2px;">
                    <i class="bi bi-speedometer" style="font-size: 20px;"></i>
                    <p style="vertical-align:baseline; margin-left:4px;">
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>
            <li class="nav-item dropdown-items">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-candy-cane nav-icon "></i>
                    <p>
                        Items
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('items.index') }}" class="nav-link">
                            <i class="fas fa-clipboard nav-icon"></i>
                            <p>Item Informations</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link">
                            <i class="fas fa-poll-h nav-icon"></i>
                            <p>Item Categories</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('stocks.index') }}" class="nav-link">
                            <i class="fas fa-clipboard-check nav-icon"></i>
                            <p>Item Stocks</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('suppliers.index') }}" class="nav-link">
                            <i class="fas fa-shipping-fast nav-icon "></i>
                            <p>Item Suppliers</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('customer.list') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>
                        {{ __('Accounts') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('paymentmethods.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-credit-card "></i>
                    <p>
                        {{ __('Payment Methods') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('shippers.index') }}" class="nav-link">
                    <i class="nav-icon far bi bi-truck"></i>
                    <p>
                        {{ __('Shippers') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('orders.index') }}" class="nav-link">
                    <i class="nav-icon far bi bi-boxes"></i>
                    <p>
                        {{ __('All Orders') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('show') }}" class="nav-link">
                    <i class="nav-icon far bi bi-amd"></i>
                    <p>
                        {{ __('Order Delivered') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('updatestatus') }}" class="nav-link">
                    <i class="nav-icon far bi bi-pencil-square"></i>
                    <p>
                        {{ __('Order Status Update') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('shippedorders') }}" class="nav-link">
                    <i class="nav-icon far bi bi-truck-flatbed" style="font-size: 25px"></i>
                    <p>
                        {{ __('Shipped Orders') }}
                    </p>
                </a>
            </li>

        </ul>
    </nav>
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info user-div">
            <a href="{{ route('profile.show') }}" class="d-block user-name">
                <i class="nav-icon far bi bi-person-bounding-box" style="color: #6c757d"></i>
                <span class="account-settings">
                    @php $name = explode(' ', Auth::user()->name)@endphp
                    {{ $name[0] . ' ' . $name[1] }}
                </span>
            </a>

        </div>
    </div>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
