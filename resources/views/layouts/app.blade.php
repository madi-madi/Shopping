<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Sweet alert -->
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">
      
  <style type="text/css">
body{ position: relative;
    min-height: 550px;
}


.not,
.fix-stripe {
    position: ;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
  
   
}

.not div{
    font-weight: bold;
}



.form-stripe {
/*    top: -120px;
    left: 18%;*/
    padding: 2%;
     display:none; 
}


.form-stripe .btn-success {

    margin-top: 11px;
    width: 100%;
}

.notif {
    background-color: #fff;
    padding: 2%;
    left: 50%;
    transform: translate(-50%,-220%);
    box-shadow: 0 0 1px 1px #f31c09;
    display:none; 
}

a.yes, a.no {
    padding: 3px 8px;
    border: 1px solid #ea4335;
    color: #000;
    background-color: ;
    margin: 10px 35px 0;
    min-width: 50px;
    text-decoration: none;
    cursor: pointer;
}

a.yes:hover, a.no:hover
{
    background-color: #ea4335;
    color: #fff;
}

i.fa.fa-exclamation-triangle.fa-2x {
    color: rgba(230, 199, 34, 0.9);
}

/*  cart  */
.row.content-cart {
    min-height: 470px;
}


/****/

* {
  font-family: "Helvetica Neue", Helvetica;
  font-size: 14px;
  font-variant: normal;

}

.group {
  background: white;
  box-shadow: 0 7px 14px 0 rgba(49,49,93,0.10),
              0 3px 6px 0 rgba(0,0,0,0.08);
  border-radius: 4px;
  margin-bottom: 20px;
}

label {
  position: relative;
  color: #8898AA;
  font-weight: 300;
  height: 40px;
  line-height: 40px;
  margin-left: 20px;
  display: block;
}

.group label:not(:last-child) {
  border-bottom: 1px solid #F0F5FA;
}

label > span {
  width: 20%;
  text-align: right;
  float: left;
}

.field {
  background: transparent;
  font-weight: 300;
  border: 0;
  color: ;
  outline: none;
  padding-right: 10px;
  padding-left: 10px;
  cursor: text;
  width: 70%;
  height: 40px;
  float: right;
}

.field::-webkit-input-placeholder { color: #CFD7E0; }
.field::-moz-placeholder { color: #CFD7E0; }
.field:-ms-input-placeholder { color: #CFD7E0; }

.pay  {
  float: left;
  display: block;
  background: #666EE8;
  color: ;
  box-shadow: 0 7px 14px 0 rgba(49,49,93,0.10),
              0 3px 6px 0 rgba(0,0,0,0.08);
  border-radius: 4px;
  border: 0;
  margin-top: 20px;
  font-size: 15px;
  font-weight: 400;
  width: 100%;
  height: 40px;
  line-height: 38px;
  outline: none;
}

.pay:focus {
  background: #555ABF;
}

.pay:active {
  background: #43458B;
}

.outcome {
  float: left;
  width: 100%;
  padding-top: 8px;
  min-height: 24px;
  text-align: center;
}

.success, .error {
  display: none;
  font-size: 13px;
}

.success.visible, .error.visible {
  display: inline;
}

.error {
  color: #E4584C;
}

.success {
  color: #666EE8;
}

.success .token {
  font-weight: 500;
  font-size: 13px;
}

/*footer {
    position: absolute;
    bottom: 0;
    left: 12%;
}*/


  </style>


</head>
<body>

    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                       <img src="{{url('/image/shoping.png')}}">  
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <!-- Authentication Links -->

                        @if (Auth::guest())
                                                    <li class="">
                                <a href="{{url('/shopping-cart-all')}}"  role="button" aria-expanded="false">
                                   <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Shopping Cart 
                                   <span class="badge " id ="total"> 
                                    {{Session::has('product')|| Cookie::has('product')? count(explode(',' ,Session::get('product'))) : ''}}</span>
                                </a>
                                    <li>
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>

                        @else
                            <li class="">
                                <a href="{{url('/shopping-cart-all')}}"  role="button" aria-expanded="false">
                                   <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Shopping Cart 
                                   <span class="badge " id ="total"> 
                                     {{Cookie::has('product')? count(explode(',' ,Session::get('product'))) : ''}}</span>
                                </a>
                                    <li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
   </div>

        @yield('content')


    <!-- Scripts -->
    <footer>
            <div class="container">
          <div class="row social">
                
                     
             <div class="col-xs-3 text-center  facebook"><i class="fa fa-facebook "></i></div>
            <div class="col-xs-3 text-center google"><i class="fa fa-google-plus"></i></div>
            <div class="col-xs-3 text-center twitter"><i class="fa fa-twitter"></i></div>
            <div class="col-xs-3 text-center linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
            

            <div class="col-xs-12 text-center footer"> all rights are save Shopping &copy; 2017 </div>
            </div>
    </footer>




    <script src="{{ asset('js/app.js') }}"></script>
    <script  src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    {!!Html::script('js/sweetalert.min.js') !!}

    @yield('footer')
</body>
</html>
