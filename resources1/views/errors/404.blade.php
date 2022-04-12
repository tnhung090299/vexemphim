<!doctype html>
<html>
<head>
	<!-- Basic Page Needs -->
        <meta charset="utf-8">
        <title>AMovie - 404</title> 
        <meta name="description" content="A Template by Gozha.net">
    
    <!-- Mobile Specific Metas-->
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="telephone=no" name="format-detection">
    
    <!-- Fonts -->
        <!-- Font awesome - icon font -->
        <link href="{{ asset('bower_components/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    
    <!-- Stylesheets -->
    
        <!-- Custom -->
        <link href="{{ asset('bower_components/xp_css/css/style.css?v=1') }}" rel="stylesheet" />
        
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries --> 
    <!--[if lt IE 9]> 
    	<script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script> 
		<script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.js"></script>		
    <![endif]-->
</head>

<body>
    <div class="wrapper">
        <div class="error-wrapper">
            <a href='index.html' class="logo logo--dark">
                <img alt='logo' src="{{ asset(config('app.image_url') . 'logo-dark.png') }}">
                <p class="slogan--dark">fun to search, fun to watch</p>
            </a>

            <div class="error">
                <img alt='' src='{{ asset(config('app.image_url') . 'error.png') }}' class="error__image">
                <h1 class="error__text">sorry, but page can’t be found</h1>
                <a href="{{ route('home') }}" class="btn btn-md btn--warning">return to homepage</a>
            </div>
        </div>

        <div class="copy-bottom">
            <p class="copy">&copy;{{ __('label.copy-rights') }}</p>
        </div>

    </div>

</body>
</html>
