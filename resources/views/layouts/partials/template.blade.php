<!DOCTYPE html>
<html lang="en">
<head>
    {!! SEO::generate() !!}

    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{ elixir("css/app.css") }}">

    @yield('styles')

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>

    @include('layouts.partials.nav')

    @yield('content-wrapper')

    <div class="container footer-ad">
        <!-- Sirce Footer Ad -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-6675624626714363"
             data-ad-slot="8897431420"
             data-ad-format="auto"></ins>
    </div>

    <main>
        @if(isset($comments_section))
            <div class="container wrap--comments">
                @include('layouts.partials.comments')
            </div>
        @endif
    </main>


    <footer class="footer">
        <div class="container">
            <p class="pull-left">
                &copy; Sirce.info &nbsp;
                <span class="small">
                    <a href="{{ route('pages.about') }}">About</a> |
                    <a href="{{ route('pages.privacy_policy') }}">Privacy Policy</a> |
                    <a href="mailto:contato@tivsoftware.com">Contact</a>
                </span>
                <br/>
                <span class="text-muted small">Helping you build the IoT or whatever you want to call it.</span>
            </p>

            <div class="pull-right">
                <img src="https://secure.php.net/images/logos/php-power-micro2.png" alt="Powered by PHP"> |
                <small>Built with <a href="http://laravel.com" target="_blank">Laravel</a></small> |
                Developed by <a href="http://tivsoftware.com" target="_blank">Tiv Software</a>
            </div>
        </div>
    </footer>

	<!-- Scripts -->
	<script src="{{ elixir("js/app.min.js") }}"></script>

    @yield('scripts')

    <!-- Adsense -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <script>
        [].forEach.call(document.querySelectorAll('.adsbygoogle'), function(){
            (adsbygoogle = window.adsbygoogle || []).push({});
        });

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-72064635-1', 'auto');
        ga('send', 'pageview');
    </script>

</body>
</html>
