<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ route('profile.show') }}"
                class="d-block"style="color: white; display:flex; justify-content: center; text-align:center">{{ Auth::user()->name }}
            </a>

        </div>
    </div>
    {{-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> --}}
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            {{-- <li class="nav-item " style="background-color:#A52A2A">
                <a href="{{ route('redirect') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"style="color: white"></i>
                    <p style="color: white">
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li> --}}

            <li class="nav-item dropdown-items" style="background-color:#A52A2A">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-candy-cane nav-icon "style="color: white"></i>
                    <p style="color: white">
                        Items
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="background-color: #A52A2A">
                    <li class="nav-item">
                        <a href="{{ route('items.index') }}" class="nav-link">
                            <i class="fas fa-clipboard nav-icon" style="color: white"></i>
                            <p style="color: white">Item Informations</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview" style="background-color: #A52A2A">
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link">
                            <i class="fas fa-poll-h nav-icon" style="color: white"></i>
                            <p style="color: white">Item Categories</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview" style="background-color: #A52A2A">
                    <li class="nav-item">
                        <a href="{{ route('stocks.index') }}" class="nav-link">
                            <i class="fas fa-clipboard-check nav-icon" style="color: white"></i>
                            <p style="color: white">Item Stocks</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview" style="background-color: #A52A2A">
                    <li class="nav-item">
                        <a href="{{ route('suppliers.index') }}" class="nav-link">
                            <i class="fas fa-shipping-fast nav-icon " style="color: white"></i>
                            <p style="color: white">Item Suppliers</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item" style="background-color:#A52A2A">
                <a href="{{ route('customers.index') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card" style="color: white"></i>
                    <p style="color: white">
                        {{ __('Accounts') }}
                    </p>
                </a>
            </li>
            <li class="nav-item" style="background-color:#A52A2A">
                <a href="{{ route('paymentmethods.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-credit-card " style="color: white"></i>
                    <p style="color: white">
                        {{ __('Payment Methods') }}
                    </p>
                </a>
            </li>
            <li class="nav-item" style="background-color:#A52A2A">
                <a href="{{ route('shippers.index') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card" style="color: white"></i>
                    <p style="color: white">
                        {{ __('Shippers') }}
                    </p>
                </a>
            </li>
            <li class="nav-item" style="background-color:#A52A2A">
                <a href="{{ route('orders.index') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card" style="color: white"></i>
                    <p style="color: white">
                        {{ __('All Orders') }}
                    </p>
                </a>
            </li>
            <li class="nav-item" style="background-color:#A52A2A">
                <a href="{{ route('show') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card" style="color: white"></i>
                    <p style="color: white">
                        {{ __('Order Delivered Sales') }}
                    </p>
                </a>
            </li>
            <li class="nav-item" style="background-color:#A52A2A">
                <a href="{{ route('updatestatus') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card" style="color: white"></i>
                    <p style="color: white">
                        {{ __('Order Status Update') }}
                    </p>
                </a>
            </li>
            <li class="nav-item" style="background-color:#A52A2A">
                <a href="{{ route('shippedorders') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card" style="color: white"></i>
                    <p style="color: white">
                        {{ __('Shipped Orders') }}
                    </p>
                </a>
            </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
