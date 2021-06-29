
<!DOCTYPE html>
<html class="no-js" lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> @yield('title') </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="manifest" href="site.html">
    <!-- favicon -->
{{--    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('frontend/assets/img/apple-touch-icon.png')}}">--}}
{{--    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('frontend/assets/img/favicon-32x32.png')}}">--}}
{{--    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('frontend/assets/img/favicon-16x16.png')}}">--}}
    <link rel="icon" href="{{asset('frontend/assets/img/color-logo.ico')}}" >
    <!-- google fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Monoton&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Titillium+Web:400,600,700&amp;display=swap">
    <!-- *** stylesheet *** -->
    <!-- normalize -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/normalize.css')}}">
    <!-- custom -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/custom.css')}}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <!-- fancybox -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/jquery.fancybox.min.css')}}">
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/owl.carousel.min.css')}}">
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/fontawesome-all.min.css')}}">
    <!-- animated -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/animated.min.css')}}">
    <!-- main style -->

    <link rel="stylesheet" href="{{asset('frontend/style.css')}}">
    @if(App()->getLocale() =='ar')
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('frontend/style_ar.css')}}">
    @endif

    <!-- responsive style -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/responsive.css')}}">
    <script src="{{asset('frontend/assets/js/vendor/jquery-3.3.1.min.js')}}"></script>
    <!-- bootstrap -->
    <script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
    @yield('css')



</head>

<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->


<!-- body start -->
<!-- preloader -->
<div class="spinner">
    <div class="bouncer"></div>
</div>
<!-- // end preloader -->
<!-- site wrap -->
<div class="site-wrap">
    <header class="main-header">
        <!-- top header -->
        <div class="top-header">
            <div class="container-fluid">
                <div class="row">
                    <!-- top infobar -->
                    <div class="top-infobar">
                        <div class="top-info-list">
                            <!-- info list -->
                            <ul class="top-info white-color col-md-8">
                                @foreach($settings as $setting)

                                    @if($setting->setting_name ==='phone')
                                        <li>

                                            <i class="fas fa-phone"></i>



                                            <a href="https://api.whatsapp.com/send?phone={{($setting->setting_value) }}">{{($setting->setting_value) }}</a>
                                        </li>
                                    @elseif($setting->setting_name=='email')
                                        <li><i class="fas fa-envelope-open"></i>
                                            <a href="mailto:{{\App\Setting::where('setting_name','email')->first()->setting_value}}" class="__cf_email__">{{($setting->setting_value)}}</a>
                                        </li>
                                    @elseif($setting->setting_name=='address')

{{--                                        <li><i class="fas fa-calendar"></i>{{json_decode($setting->setting_value)->{'en'} }}</li>--}}
                                    @endif
                                @endforeach

                            </ul>
                            <!-- info social -->
                            <ul class="top-social white-color col-md-4 text-right">
                                @if(App()->getLocale() === 'ar')
                                    <li><a href="{{url('/en'.$url)}}">
                                            <img style="
    height: 24px;
" src="{{asset('images/en.png')}}">
                                        </a></li>
                                @else
                                    <li><a href="{{url('/ar'.$url)}}">
                                            <img style="height: 24px;
" src="{{asset('images/ar.png')}}">
                                        </a></li>
                                    @endif


                            @if(\App\Setting::where('setting_name' ,'facebook')->first())
                                <li><a href="{{\App\Setting::where('setting_name' ,'facebook')->first()->setting_value}}"><i class="fab fa-facebook-f"></i></a></li>
                                @endif
                                    @if(\App\Setting::where('setting_name' ,'twitter')->first())
                                <li><a href="{{\App\Setting::where('setting_name' ,'twitter')->first()->setting_value}}"><i class="fab fa-twitter"></i></a></li>
                                    @endif
                                    @if(\App\Setting::where('setting_name' ,'linkedin')->first())
                                <li><a href="{{\App\Setting::where('setting_name' ,'linkedin')->first()->setting_value}}"><i class="fab fa-linkedin-in"></i></a></li>
                                    @endif
                                    @if(\App\Setting::where('setting_name' ,'instagram')->first())
                                <li><a href="{{\App\Setting::where('setting_name' ,'instagram')->first()->setting_value}}"><i class="fab fa-instagram"></i></a></li>
                                    @endif
                                    @if(\App\Setting::where('setting_name' ,'youtube')->first())
                                <li><a href="{{\App\Setting::where('setting_name' ,'youtube')->first()->setting_value}}"><i class="fab fa-youtube"></i></a></li>
                                        @endif

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header bottom -->
        <div class="header-bottom">
            <div class="container-fluid">
                <div class="row">
                    <!-- main navbar -->
                    <div class="main-navbar w-100">
                        <nav class="navbar navbar-expand-lg w-100">
                            <!-- brand / logo -->
                            <a class="navbar-brand" href="{{Route('home.index',App()->getLocale())}}">
                                <img class="affix-logo" src="{{asset('frontend/assets/img/color-logo.png')}}" alt="logo" style="height: 120px;">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation_menu" aria-controls="navigation_menu" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon">
                                        <i class="fas fa-bars"></i>
                                    </span>
                            </button>
                            <!-- navigation -->
                            <div class="navbar-collapse collapse justify-content-end mainmenu" id="navigation_menu">

                                <ul class="navbar-nav">
                                    @foreach($pages as $page)
                                        @if(!$page->dropdown)
                                            @if($page->slug == 'home')
                                                <li class="nav-item">
                                                    <a class="nav-link {{(Request()->segment(2) == null ? "active" : '')}}" href="{{route('home.index',App()->getLocale())}}">{{__(ucfirst($page->name[App()->getLocale()])) }}  <span class="sr-only">(current)</span></a>
                                                </li>
                                            @elseif($page->slug == 'contact-us')
                                                <li class="nav-item">
                                                    <a class="nav-link {{(Request()->segment(2) == $page->slug ? "active" : '')}}" href="{{route('contact.index',App()->getLocale())}}">{{__(ucfirst($page->name[App()->getLocale()]))}} <span class="sr-only">(current) </span></a>
                                                </li>

                                                @else
                                                <li class="nav-item">
                                                    <a class="nav-link {{(Request()->segment(2) == $page->slug ? "active" : '')}}" href="{{(url(app()->getLocale().'/'.$page->slug))}}">{{__(ucfirst($page->name[App()->getLocale()]))}} <span class="sr-only">(current) </span></a>
                                                </li>

                                                @endif

                                        @else
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{__($page->name[App()->getLocale()])}}</a>
                                                <ul class="dropdown-menu">
                                                    @foreach(\App\Page::where('page_id',$page->id)->get() as $sub_page)
                                                        <li class="nav-item  "><a class="dropdown-item " href="{{(url(app()->getLocale().'/'.$sub_page->slug))}}">{{$sub_page->name[App()->getLocale()]}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                    {{--        <li class="nav-item">--}}
                                    {{--            <a class="nav-link " href="{{Route('news.index',App()->getLocale())}}">{{__('news')}}</a>--}}
                                    {{--        </li>--}}
                                    {{--        <li class="nav-item">--}}
                                    {{--            <a class="nav-link " href="{{Route('markets.show',[App()->getLocale()])}}">{{__('market')}}</a>--}}
                                    {{--        </li>--}}

                                    {{--        <li class="nav-item">--}}
                                    {{--            <a class="nav-link " href="{{route('contact.index',App()->getLocale())}}">{{__('contact')}}</a>--}}
                                    {{--        </li>--}}
                                </ul>


{{--                               @yield('navbar')--}}
                            </div>
                            <!-- search menu -->
                            <div class="header-search">
                                <i class="fas fa-search"></i>
                            </div>
                            <!-- search trigger -->
                            <div class="header-search-area d-flex justify-content-center align-items-center">
                                <form role="search" method="get" class="header-search-form" action="#">
                                    <input class="search-field" placeholder="Type Keywords" name="s" type="search">
                                    <button class="search-submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                                <span class="close-button">
                                        <i class="fas fa-times"></i>
                                    </span>
                            </div>
                            <!-- navigation bar -->
                            <div class="menu-line"><span></span></div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- // end header -->
    <!-- hamburger menu -->
    <div class="hamburger-menu">
        <!-- hamburger logo -->
        <div class="ham-logo">
            <a href="{{Route('home.index',App()->getLocale())}}"><img src="{{asset('frontend/assets/img/color-logo.png')}}" height="147px" alt="logo"></a>
        </div>
        <!-- close button -->
        <span class="close-btn"></span>
        <!-- hamburger body -->
        <div class="hamburger-body">
            <!-- hamburger text -->
            @if(app()->getLocale() == 'en')
                <p>let's start our collaboration ! drop us an email and we will get back to you as soon as possible we can </p>
        @else
                <p>لنبدأ تعاوننا! أرسل لنا بريدًا إلكترونيًا وسنعاود الاتصال بك في أقرب وقت ممكن </p>
            @endif
            <!-- navigation -->
            <ul class="hamburger-nav mt-5">
                <li>
                    <img src="{{asset('frontend/assets/img/icons/location.png')}}" alt="location">
                    <div class="ham-content">
                        @foreach($settings as $setting)
                        @if($setting->setting_name === "address")
                                <p>{!! json_decode($setting->setting_value)->{app()->getLocale()} !!}</p>
                            @endif
                        @endforeach
                        <span>{{__('location')}}</span>
                    </div>
                </li>
                <li>
                    <img src="{{asset('frontend/assets/img/icons/email.png')}}" alt="email">
                    <div class="ham-content">
                        <p>
                            <a href="mailto:{{\App\Setting::where('setting_name','email')->first()->setting_value}}" class="__cf_email__">{{($setting->setting_value)}}</a>
                        </p>
                        <span>
                            {{__('online_support')}}
                        </span>
                    </div>
                </li>
                <li>
                    <img src="{{asset('frontend/assets/img/icons/phone.png')}}" alt="phone">
                    <div class="ham-content">
                        <p>

                            <a href="https://api.whatsapp.com/send?phone=     {{\App\Setting::where('setting_name','phone')->first()->setting_value}}">     {{\App\Setting::where('setting_name','phone')->first()->setting_value}}</a>
                        </p>
{{--                        <span>Mon - Fri 7AM - 6PM</span>--}}
                    </div>
                </li>
            </ul>


        </div>
    </div>
    <!-- // end hamburger menu -->
    <!-- section banner -->
    @yield('banner')

@include('backend.partials.toaster')
    @yield('content')







    <!-- partners section -->
    <section class="partners-section ex-section equal-space white-color">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="partner-content">
                        <h2>{{$partnersSection->title[App()->getLocale()]}}</h2>
                        <p>{!! $partnersSection->description[App()->getLocale()] !!}</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-7">
                    <ul class="partner-list owl-carousel">
                        @foreach($partners as $partner)
                            <li ><img style="margin-left:10px;border-radius: 50%;height:120px;width: 100px" src="{{asset('storage/'.$partner->image)}}" alt="Image"></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- // end partners section -->
    <!-- subscribe section -->
{{--    <div class="subscribe-section">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12 col-md-4">--}}
{{--                    <a href="index.html" class="footer-logo"><img src="{{asset('frontend/assets/img/color-logo.png')}}" alt="foo_logo"></a>--}}
{{--                </div>--}}
{{--                <div class="col-12 col-md-8">--}}
{{--                    <div class="subscribe-form">--}}
{{--                        <input type="email" name="your_email" placeholder="Enter Your Email">--}}
{{--                        <button class="subscribe-btn main-btn">Subscribe <i class="fas fa-paper-plane"></i></button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
<!-- // end subscribe section -->
    <!-- footer -->
    <footer class="main-footer top-space">
        <!-- footer top -->
        <div class="footer-top bottom-space">
            <div class="container">
                <div class="row">
                    <!-- single footer widget -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="footer-widget">
                            <h3>{{__('about_us')}}</h3>
                            <p>{{__('about_us_desc')}} </p>
                            <ul class="follow-social mt-2">
                                @if(\App\Setting::where('setting_name','facebook')->first() )
                                <li><a href="{{\App\Setting::where('setting_name','facebook')->first()->setting_value}}"><i class="fab fa-facebook-f"></i></a></li>
                                @endif
                                    @if(\App\Setting::where('setting_name','twitter')->first() )
                                <li><a href="{{\App\Setting::where('setting_name','twitter')->first()->setting_value}}"><i class="fab fa-twitter"></i></a></li>
                                    @endif
                                    @if(\App\Setting::where('setting_name','linkedin')->first() )

                                <li><a href="{{\App\Setting::where('setting_name','linkedin')->first()->setting_value}}"><i class="fab fa-linkedin-in"></i></a></li>
                                    @endif
                                    @if(\App\Setting::where('setting_name','instagram')->first() )

                                <li><a href="{{\App\Setting::where('setting_name','instagram')->first()->setting_value}}"><i class="fab fa-instagram"></i></a></li>
                                    @endif
                                    @if(\App\Setting::where('setting_name','youtube')->first() )

                                <li><a href="{{\App\Setting::where('setting_name','youtube')->first()->setting_value}}"><i class="fab fa-youtube"></i></a></li>
                                    @endif
                            </ul>
                        </div>
                    </div>
                    <!-- single footer widget -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="footer-widget">
                            <h3>{{__('latest_news')}}</h3>
                            <ul class="footer-blog-post">
                        @foreach($latestThreeNews as $latest)
                                    <li>
                                        <img src="{{asset('storage/'.$latest->image)}}" alt="post">
                                        <div class="post-desc">
                                            <a href="{{route('news.show',[App()->getLocale(),$latest->id])}}">
                                                <h2>{{$latest->title[App()->getLocale()]}}</h2>
                                            </a>
                                            <span>{{$latest->created_at}}</span>
                                        </div>
                                    </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- single footer widget -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="footer-widget">
                            <h3>{{__('our_links')}}</h3>
                            <ul class="footer-link">
                                @foreach(\App\Page::where('position','footer')->get() as $footer)
                                <li><a href="{{(url(app()->getLocale().'/'.$footer->slug))}}">{{__($footer->name[App()->getLocale()])}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- single footer widget -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="footer-widget">
                            <h3>{{__('contact')}}</h3>
                            <ul class="contact-list">
                               @foreach($settings as $setting)
                                   @if($setting->setting_name == 'address')

                                        <li><i class="fas fa-map-marker-alt"></i> {{json_decode($setting->setting_value)->{App()->getLocale()} }} </li>
                                        @endif
                                @endforeach
                                   @foreach($settings as $setting)
                                       @if($setting->setting_name == 'phone')

                                           <li><i class="fas fa-phone"></i>
                                               <a href="https://api.whatsapp.com/send?phone={{($setting->setting_value) }}">{{($setting->setting_value) }}</a>
                                           </li>
                                       @endif
                                   @endforeach

                                <li><i class="fas fa-envelope-open"></i>
                                    <a href="mailto:{{\App\Setting::where('setting_name','email')->first()->setting_value}}" class="__cf_email__" >{{\App\Setting::where('setting_name','email')->first()->setting_value}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer bottom -->
        <div class="footer-bottom dark-bg white-color">
            <div class="container">
                <div class="row">
                    <!-- go top -->
                    <div class="col-12">
                        <div class="go-top text-center">
                            <i class="fas fa-angle-up"></i>
                        </div>
                    </div>
                    <!-- subscribe section -->
                    <div class="col-12 col-md-6">
                        <p>2021 &copy; copyright <a href="#">Tailors</a></p>
                    </div>
                    <!-- copyright -->
                    <div class="col-12 col-md-6 copyright text-right">
                        <p>Made With <i class="fas fa-heart"></i> By <a href="https://Advie.com/">Tailors</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- // end footer -->
</div>
<!-- // end site wrap -->
<!-- // end body -->

<!-- *** jQuery *** -->
<!-- modernizr -->
<script data-cfasync="false" src="https://meetsomnox.com/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js "></script><script src="{{asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
<!-- jquery  -->

<!-- popper -->
<script src="{{asset('frontend/assets/js/popper.min.js')}}"></script>
<!-- isotope -->
<script src="{{asset('frontend/assets/js/isotope.pkgd.min.js')}}"></script>
<!-- images loaded -->
<script src="{{asset('frontend/assets/js/imagesloaded.pkgd.min.js')}}"></script>
<!-- owl carousel -->
<script src="{{asset('frontend/assets/js/owl.carousel.min.js')}}"></script>
<!-- fancybox -->
<script src="{{asset('frontend/assets/js/jquery.fancybox.min.js')}}"></script>
<!-- smooth scroll -->
<script src="{{asset('frontend/assets/js/smooth-scroll.min.js')}}"></script>
<!-- wow js -->
<script src="{{asset('frontend/assets/js/wow.min.js')}}"></script>
<!-- main jquery -->
<script src="{{asset('frontend/assets/js/main.js')}}"></script>

@yield('js')
</body>


</html>
