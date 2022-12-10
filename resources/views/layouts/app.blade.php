<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="" />
    <title>IleZaAuto</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/all.css" rel="stylesheet">
    <!-- icons -->
    <script src="https://kit.fontawesome.com/87cc08ad60.js" crossorigin="anonymous"></script>
    <!--favicon-->
    <link rel="icon" href="favicon.ico" type="image/vnd.microsoft.icon">
           

  
    
</head>
<nav class="navbar navbar-dark bg-navbar navbar-expand-lg">


        <div class="container-fluid float-right ps-5">
                                <a class="navbar-brand" style:"margin-left:35%" href="/"><img src="{{ URL::to('/img/icon/logo.png') }}" width="250" alt=""></a>
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                     <span class="navbar-toggler-icon"></span>
                                   </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="menu navbar-nav ms-auto mb-2 mb-lg-0 mr_right">
                          <a class="nav-link" href="{{ url('/car_base') }}"> <li> Baza aut</li></a>    
                          <a class="nav-link" href="{{ url('/oblicz') }}"> <li> Kalkulator spalania</li></a>        
                    @if (Route::has('login'))
                    @auth           
                        @can('isAdmin')
                            <a class="nav-link" href="{{ url('/admin_panel') }}"> <li>Panel Administratora</li></a>    
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Wyloguj') }} <li>Wyloguj</li></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="GET" class="d-none"> @csrf </form>
                        @endcan
                        @canany(['isUser', 'isPremiumUser', 'isTestUser'])             
                          <a class="nav-link" href="{{ route('user_raports.reports') }}"> <li>Moje Raporty</li></a>
                          <a class="nav-link" href="{{ route('user_auto') }}"> <li>Moje Auta</li></a>
                          <a class="nav-link" href="{{ route('user_account') }}"> <li>Moje Konto</li></a>

                          {{--<a class="nav-link" href="{{ url('/user_account') }}"> <li>Witaj {{ Auth::user()->name }}</li></a>--}} 
                          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('') }}<li>Wyloguj</li> </a> 
                          <form id="logout-form" action="{{ route('logout') }}" method="GET" class="d-none"> @csrf </form>        

                          
                        @endcanany 



                                    @else
                                        <a class="nav-link" href="{{ route('login') }}"><li>Zaloguj</li></a>
                                    @if (Route::has('register'))
                                         <a class="nav-link" href="{{ route('register') }}"><li>Zarejestruj</li></a>
                                    
                                    @endif
                                     @endauth
                                    @endif

                                @guest
                                    @if (Route::has('login'))

                                    @endif

                                     @if (Route::has('register'))

                                     @endif
                                  @else
                                
                            @endguest   
                            

                  </ul>
       
         
  
</nav>


                          
             
                    
   
  <body style="background-color:#252525">

        <main class="main mt-5">

            @yield('content')
    
        <div id="simplecookienotification_v01" style="display: block; z-index: 99999; min-height: 35px; width: 100%; position: fixed; background: rgb(31, 31, 31); border: 0px rgb(198, 198, 198); text-align: center; right: 0px; color: rgb(119, 119, 119); bottom: 0px; left: 0px; box-shadow: black 0px 8px 6px -6px;">
            <div style="padding:10px; margin-left:15px; margin-right:15px; font-size:14px; font-weight:normal;">
                <span id="simplecookienotification_v01_powiadomienie">Ta strona używa plików cookie w celu usprawnienia i ułatwienia dostępu do serwisu oraz prowadzenia danych statystycznych. Dalsze korzystanie z tej witryny oznacza akceptację tego stanu rzeczy.</span><span id="br_pc_title_html"><br></span>
                <a id="simplecookienotification_v01_polityka" href="http://jakwylaczyccookie.pl/polityka-cookie/" style="color: rgb(198, 198, 198);">Polityka Prywatności</a><span id="br_pc2_title_html"> &nbsp;&nbsp; </span>
                <a id="simplecookienotification_v01_info" href="http://jakwylaczyccookie.pl/jak-wylaczyc-pliki-cookies/" style="color: rgb(198, 198, 198);">Jak wyłączyć cookies?</a><span id="br_pc3_title_html"> &nbsp;&nbsp; </span>
                <a id="simplecookienotification_v01_info2" href="https://nety.pl/cyberbezpieczenstwo" style="color: rgb(198, 198, 198);">Cyberbezpieczeństwo</a><div id="jwc_hr1" style="height: 10px; display: none;"></div> <span id="br_pc_title_html"><br></span></br>
                <a id="okbutton" href="javascript:simplecookienotification_v01_create_cookie('simplecookienotification_v01',1,7);" style="background: #ffc107; padding: 5px 15px; text-decoration: none; font-size: 12px; font-weight: normal; border: 0px solid rgb(31, 31, 31); border-radius: 5px; top: 5px; right: 5px;">AKCEPTUJĘ</a><div id="jwc_hr2" style="height: 10px; display: none;"></div>
             </div>
        </div>
        <script type="text/javascript">var galTable= new Array(); var galx = 0;</script><script type="text/javascript">function simplecookienotification_v01_create_cookie(name,value,days) { if (days) { var date = new Date(); date.setTime(date.getTime()+(days*24*60*60*1000)); var expires = "; expires="+date.toGMTString(); } else var expires = ""; document.cookie = name+"="+value+expires+"; path=/"; document.getElementById("simplecookienotification_v01").style.display = "none"; } function simplecookienotification_v01_read_cookie(name) { var nameEQ = name + "="; var ca = document.cookie.split(";"); for(var i=0;i < ca.length;i++) { var c = ca[i]; while (c.charAt(0)==" ") c = c.substring(1,c.length); if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length); }return null;}var simplecookienotification_v01_jest = simplecookienotification_v01_read_cookie("simplecookienotification_v01");if(simplecookienotification_v01_jest==1){ document.getElementById("simplecookienotification_v01").style.display = "none"; }</script>

      </main>
   
</body>
</html>
