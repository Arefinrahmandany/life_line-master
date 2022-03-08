<nav class="sidebar ms-b-s sidebar-offcanvas" id="sidebar"style="margin-top: -10px;background-image:linear-gradient(#445876, #2a394f)!important;">
  <ul class="nav" style="overflow: hidden !important;"><style media="screen">.nav-profile:hover{background: none!important;}</style>
    <li class="nav-item nav-profile" style="background-image:linear-gradient(#445876, #2a394f);">
      <a href="#" class="nav-link" title="{{Auth::user()->name}} is Online Now:)">
        <div class="nav-profile-image">
          <img src="{{ asset('images/users/defaultMaleAvatar.png') }}" alt="..." style="width: 50px;height: 50px;border-radius: 50px;border:3px solid #1bcfb4;">
          <span class="login-status online"></span>
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">{{\Illuminate\Support\Str::limit(Auth::user()->full_name,12)}}</span>
          <span class="text-secondary text-small">
              <hr style="margin-top: 0.2rem!important;margin-bottom: 0.1rem!important;border: 0;border-top: 1px solid rgb(73 235 191);">
           {{ @Auth::user()->type->name }}
          </span>
        </div>
        <i class="mdi mdi-checkbox-multiple-marked-circle text-success nav-profile-badge"></i>
      </a>
    </li>

    <li class="nav-item waves-effect">
      <a class="nav-link" href="{{url('dashboard')}}">
        <span class="menu-title ">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>

      <li class="nav-item waves-effect">
          <a class="nav-link" href="">
              <span class="menu-title ">News & Offer</span>
              <i class="mdi mdi-newspaper menu-icon"></i>
          </a>
      </li>

      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#employee" aria-expanded="false" aria-controls="employee">
              <span class="menu-title">Employee</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-account-multiple-check menu-icon"></i>
          </a>
          <div class="collapse" id="employee">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item waves-effect"><a class="nav-link" href=""><i class="mdi mdi-account-multiple"></i>&nbsp;&nbsp Create Employee</a></li>
              </ul>
          </div>
      </li>


      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#expenses" aria-expanded="false" aria-controls="expenses">
              <span class="menu-title">Transport Expenses</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-cash-usd menu-icon"></i>
          </a>
          <div class="collapse" id="expenses">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item waves-effect"><a class="nav-link" href=""><i class="mdi mdi-cash-usd"></i>&nbsp;&nbsp Daily Expenses</a></li>
              </ul>
          </div>
      </li>

      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#customer" aria-expanded="false" aria-controls="customer">
              <span class="menu-title">Customer</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-account-multiple menu-icon"></i>
          </a>
          <div class="collapse" id="customer">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item waves-effect"><a class="nav-link" href=""><i class="mdi mdi-account-multiple"></i>&nbsp;&nbsp Create Customer</a></li>
              </ul>
          </div>
      </li>

      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#product_order" aria-expanded="false" aria-controls="product_order">
              <span class="menu-title">Product Order</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-shopping menu-icon"></i>
          </a>
          <div class="collapse" id="product_order">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item waves-effect"><a class="nav-link" href=""><i class="mdi mdi-cart"></i>&nbsp;&nbsp Order</a></li>
              </ul>
          </div>
      </li>



      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#payment_receive" aria-expanded="false" aria-controls="payment_receive">
              <span class="menu-title">Payment Receive</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-paypal menu-icon"></i>
          </a>
          <div class="collapse" id="payment_receive">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item waves-effect"><a class="nav-link" href=""><i class="mdi mdi-paypal"></i>&nbsp;&nbsp Entry</a></li>
              </ul>
          </div>
      </li>

      {{--      all reports--}}

      <li class="nav-item waves-effect">
          <a class="nav-link" href="">
              <span class="menu-title ">Details Sales Statements</span>
              <i class="mdi mdi-stack-exchange menu-icon"></i>
          </a>
      </li>
      {{--end all reports--}}

      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#user_manage" aria-expanded="false" aria-controls="user_manage">
              <span class="menu-title">User Manage</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-account-multiple menu-icon"></i>
          </a>
          <div class="collapse" id="user_manage">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item waves-effect"><a class="nav-link" href=""><i class="mdi mdi-account-multiple"></i>&nbsp;&nbsp;Create User</a></li>
              </ul>
          </div>
      </li>


      <li class="nav-item waves-effect">
          <a class="nav-link" href="">
              <span class="menu-title ">Sending SMS</span>
              <i class="mdi mdi-email-variant menu-icon"></i>
          </a>
      </li>



      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#machine" aria-expanded="false" aria-controls="machine">
              <span class="menu-title">Machine</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-coffee-to-go menu-icon"></i>
          </a>
          <div class="collapse" id="machine">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item waves-effect"><a class="nav-link" href=""><i class="mdi mdi-coffee-to-go"></i>&nbsp;&nbsp;Machine Reg Info</a></li>
              </ul>
          </div>
      </li>



      <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="settings">
              <span class="menu-title">Settings</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-settings menu-icon"></i>
          </a>
          <div class="collapse" id="settings">
              <ul class="nav flex-column sub-menu">
                  @if(Auth::user()->type_id == 1)
                    <li class="nav-item waves-effect"><a class="nav-link" href=""><i class="mdi mdi-account-multiple"></i>&nbsp;&nbsp;Employee Types</a></li>
                  @endif
              </ul>
          </div>
      </li>



      <br><br><br><br><br><br> <br><br><br><br><br><br><br>
      <p class="border-top" style="color:#868e96;margin-left:5px;border-top:0px solid #1bcfb4!important;background-image:linear-gradient(#445876, #2a394f);">
        <b>V1.0.0</b>
      </p>
  </ul>
</nav>
