<!DOCTYPE html>
<html lang="en" >

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-128891091-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-128891091-1');
    </script>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MRV257M');</script>
    <!-- End Google Tag Manager -->
    
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">

    <title>Uni-Vate Properties | @yield('title')</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    
    <!-- Datepicker -->
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    
    <!-- Main Stylehseet -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    
    <!-- Favicon -->
	<link rel="icon" href="{{ asset('/images/favicon.png') }}">

</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MRV257M"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
    <!-- main menu -->
    @include('partials.menu')    
    @if(Session::has('view-search-error'))
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <div class="alert alert-danger mb-0">
                    <p class="text-danger mb-0 text-center">
                        {{ Session::get('view-search-error') }}
                        <a href="#" class="close">&times;</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- error message -->
    @if(Session::has('view-error'))
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <div class="alert-box alert mb-0">
                    <p class="text-danger mb-0 text-center">
                        {{ Session::get('view-error') }}
                        <a href="#" class="close">&times;</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- success message -->
    @if(Session::has('view-success'))
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <div class="alert alert-success mb-0">
                    <p class="text-success mb-0 text-center">
                        {{ Session::get('view-success') }}
                        <a href="#" class="close">&times;</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- main content -->
    @yield('content')

    <!-- footer -->
    @include('partials.footer')
    
    <!-- login -->
    @if(!Auth::check()) 
    @include('partials.login')
    <!-- register -->
    @include('partials.register')
    @endif
    
</body>
</html>