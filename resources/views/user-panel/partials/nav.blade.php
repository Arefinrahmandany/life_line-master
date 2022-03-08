<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row ms-b-s bg-gradient-info"style=";height: 60px;background-image:linear-gradient(rgb(65 241 193), rgb(28 167 130))!important;">
    <style>
        #navAppName{
            margin: auto!important;
            text-align: center;
            float: right;
            left: 600px;
            top: 15px;
            color: #e1241a;
            font-family: serif;
        }
        @media (max-width: 620px){
            #navAppName{
                display: none;
            }
        }
    </style>
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center"style="background:none!important;height: 45px;">
    <!-- <a class="navbar-brand brand-logo" href="/admin_dashboard">Xpress Delivery</a> -->
    <a class="navbar-brand brand-logo" href="{{url('dashboard')}}">
{{--      <img src="{{asset('logo.png')}}" alt="Admin Panel" style="width:60%!important;height:50px!important;margin-top:-5px;">--}}
    </a>
    <a class="navbar-brand brand-logo-mini" href="/dashboard" >
{{--        <img src="{{asset('logo.png')}}" alt="logo" style="width:100%!important;height:55px!important;margin-top:-5px;" />--}}
    </a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-stretch"style="color:#ffffff!important;margin-top: -5px;">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize"style="margin-left: -70px;">
      <span class="mdi mdi-menu"></span>
    </button>
{{--      <h2 id="navAppName">{{ env('APP_NAME') }}</h2>--}}
    <ul class="navbar-nav navbar-nav-right">
        <center>
            <img src="{{asset('logo.png')}}" alt="Admin Panel" style="width: 195px;height: 40px;alignment: center;display: block;margin: 0 auto;position: absolute;left: calc((100% - 195px) / 2);z-index: 100000;margin-top: -20px;">
        </center>
          <style media="screen">
          .n_i_counter{
          margin-top: -20px;
          border-radius: 50%;
          width: 22px;
          height: 22px;
          background: #f1457a;
          border: 1px solid white;
          font-weight: bold;
          margin-left: -8px;
          transition: all 0.4s;
          }
          .mstppp{
            border-top: 2px solid #11f1cf;height:60px;border-radius: 15px;cursor:pointer;
          }
          .mstppp:active{
            background: #21252c29;
            transition: all 0.4s;
          }
          .mstpppgg{
            transition: all 0.4s;
            padding: 5px!important;
            padding-bottom: 0px!important;
            margin-bottom: -8px!important;
          }
          .mstpppgg:hover{
            background: #b5b4b43b!important;
            transition: all 0.4s;
            padding: 5px!important;
            padding-bottom: 0px!important;
            margin-bottom: -8px!important;
          }
          </style>

      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <div class="nav-profile-img">
            <img src="{{asset('images/users/defaultMaleAvatar.png')}}" alt="..." style="width: 28px;height: 28px;border-radius: 50px;border:2px solid #fff;">
          </div>
          <div class="nav-profile-text">
          </div>
        </a>
        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" id="logOutSx" href="{{ route('logout') }}"onclick="return logout(event);">
            <i class="mdi mdi-logout mr-2 text-primary"></i> LogOut </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
    <style media="screen">
      .swal2-modal{min-height: 105px;}.swal2-popup{width: 25em;}
    </style>
    <script type="text/javascript">
      function logout(event){
        event.preventDefault();
        Swal.fire({
          title: 'Are you sure?',
          text: "Do you really want to logout!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, LogOut!'
        }).then((result) => {
          if (result.value) {
            event.preventDefault();document.getElementById('logout-form').submit();
            Swal.fire(
              'LogOut!',
              'Your are Successfully logout.',
              'success'
            )
          }
        })
      }
    </script>
  </div>
</nav>
