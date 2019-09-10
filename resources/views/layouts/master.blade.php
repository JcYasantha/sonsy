<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sonsy Trading</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="/path/to/material-icons/iconfont/material-icons.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
<div class="wrapper" id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-navwhite border-bottom">
    <button class="navbar-toggler sideMenuToggler" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto navnew">
        <li class="nav-item">
          <a href="#" class="nav-link sideMenuToggler tog" style="margin-left:78px;"><span class="navbar-toggler-icon"></span></a>
        </li>
      </ul>
      <ul class="navbar-nav" style="margin-right:8%;">
        <!-- notification -->
        <notification></notification>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <router-link to="/profile" class="nav-link dropdown-item" href="#" style="background-color: white;">Profile</router-link>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#"href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <span class="text">{{ __('Logout') }}</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form> 
        </div>
      </li>
      </ul>
    </div>
    <!-- <div class="float-right"><i class="material-icons md-30">notifications</i><span class="badge badge-danger">{{count(auth()->user()->notifications)}}</span></div> -->
  </nav>

  <div class="wrapper d-flex">
    <div class="sidemenu shadow-lg">
      <div class="sidebar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="#" class="nav-link sideLink px-2 pt-2" style="border-bottom:0.5px solid #62666d;"><img src="/img/profile/{{ Auth::user()->photo}}" alt="Avatar" class="avatar shadow"><span class="text"><span class="text pl-2">{{ Auth::user()->name }}</span></a>
          </li>
          <!-- <div class="dropdown-divider bg-mattGray"></div> -->
          <li class="nav-item">
            <router-link to="/dashboard" class="nav-link sideLink px-2"><i class="material-icons icon">dashboard</i><span class="text">Dashboard</span></router-link>
          </li>
          @can('isAdmin')
          <li class="nav-item">
            <router-link to="/users" class="nav-link sideLink px-2"><i class="material-icons icon">people</i><span class="text">Users</span></router-link>
          </li>
          @endcan
          <li class="nav-item">
            <router-link to="/test1" class="nav-link sideLink px-2"><i class="material-icons icon">insert_chart</i><span class="text">chart</span></router-link>
          </li>    
          @can('isadminorStockKeeper')   
          <li class="nav-item">
            <router-link to="/Stock" class="nav-link sideLink px-2"><i class="material-icons icon">stock</i><span class="text">Stock</span></router-link>
          </li>
          @endcan
          @can('isAdmin')
          <li class="nav-item">
            <router-link to="/addOrder" class="nav-link sideLink px-2"><i class="material-icons icon">add_circle</i><span class="text">Add Order</span></router-link>
          </li>
          <li class="nav-item">
            <router-link to="/addPeople" class="nav-link sideLink px-2"><i class="material-icons icon">add_circle</i><span class="text">Add People</span></router-link>
          </li>
          <li class="nav-item">
            <router-link to="/viewCustomer" class="nav-link sideLink px-2"><i class="material-icons icon">pageview</i><span class="text">Customer History</span></router-link>
          </li>
          @endcan
          @can('isadminorCashier')
          <li class="nav-item">
            <router-link to="/cashier" class="nav-link sideLink px-2"><i class="material-icons icon">payment</i><span class="text">Cashier</span></router-link>
          </li>
          @endcan
          <li class="nav-item">
            <router-link to="/profile" class="nav-link sideLink px-2"><i class="material-icons icon">settings</i><span class="text">Profile</span></router-link>
          </li>
          <li class="nav-item">
            <router-link to="#" class="nav-link sideLink sideMenuToggler px-2"><i class="material-icons icon">view_list</i><span class="text">Resize</span></router-link>
          </li>
          <li class="nav-item">

            <a class="nav-link sideLink sideMenuToggler px-2" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="material-icons icon">power_settings_new</i><span class="text">
                                                     <span class="text">{{ __('Logout') }}</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>  
        </li>
        </ul>
      </div>
    </div>
    <div class="content">
        <div class="container-fluid mt-3">
            <router-view></router-view>
        </div>
    </div>
  </div>
</div>

@auth
<script>
    window.user = @json(auth()->user()->load('notifications'))
</script>
@endauth
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
</body>
</html>

<style>
    .material-icons.md-30 { font-size: 25px; }
    .dropdown-menu{
            max-height:200px;/* you can change as you need it */
            overflow:auto;/* to get scroll */
    }
    .testhover{
      background-color:white;
       border:none;
       color:#878d8d;
    }
    .testhover:hover {
       background-color:white;
       border:none;
       color:#878d8d;
      }
      .rou{
        
      }
</style>