<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('all.products.users') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block ml-3 mb-2">
        <div class="">
          <a href="{{ route('show.cart.page') }}" class="nav-link">
            <i class="fas fa-cart-plus" style="color: #000"></i>
            <span style="color: #000">
              {{ session()->has('cart') ? session()->get('cart')->totalQty : '0' }}
            </span>
          </a>
        </div>
      </li>
      
    </ul>

    <!-- SEARCH FORM -->
  

    <!-- Right navbar links -->
   
   @if (!auth()->user())

    <a href="{{ route('login') }}" class="mr-5">Login</a>
    <a href="{{ route('register') }}">Register</a>
    
       <div class="ml-5">
            <a href="{{ route('show.cart.page') }}">
              <i class="fas fa-cart-plus" style="color: #000"></i>
              <span style="color: #000">
                {{ session()->has('cart') ? session()->get('cart')->totalQty : '0' }}
              </span>
            </a>
       </div>
     

   @else
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
      
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="dropdown-item">
                    Logout
                </button>
              </form>
              <div class="dropdown-item">
                <a href="{{ route('index.orders') }}" class="btn btn-warnning">
                  Orders History
                </a>
              </div>
            
          </div>
        </li>
        
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul> 
   @endif
      
  </nav>