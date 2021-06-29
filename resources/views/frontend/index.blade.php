@extends('layouts.front')
@section('title')
    {{__('home')}}
@endsection

@section('css')
    <style>

     .section-blog .heading:before {
       content: "@lang('app.Articles')";
   }
   .section-about .heading:before {
       content: "@lang('app.about_us')";
   }






    </style>
    @endsection

@section('navbar')
{{--    <ul class="navbar-nav">--}}
{{--        @foreach($pages as $page)--}}
{{--            @if(!$page->dropdown)--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link active" href="{{Route('home.index',App()->getLocale())}}">{{__('home')}} <span class="sr-only">(current)</span></a>--}}
{{--        </li>--}}
{{--            @else--}}
{{--        <li class="nav-item dropdown">--}}
{{--            <a class="nav-link dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{__('projects')}}</a>--}}
{{--            <ul class="dropdown-menu">--}}
{{--                @foreach($AllProjects as $oneProject)--}}
{{--                    <li class="nav-item {{(isset($project)&&$oneProject->id === $project->id) ?'active' : ''}} "><a class="dropdown-item " href="{{route('projects.show',[App()->getLocale(),$oneProject->id])}}">{{$oneProject->title[App()->getLocale()]}}</a></li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--            @endif--}}
{{--        @endforeach--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link " href="{{Route('news.index',App()->getLocale())}}">{{__('news')}}</a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link " href="{{Route('markets.show',[App()->getLocale()])}}">{{__('market')}}</a>--}}
{{--        </li>--}}

{{--        <li class="nav-item">--}}
{{--            <a class="nav-link " href="{{route('contact.index',App()->getLocale())}}">{{__('contact')}}</a>--}}
{{--        </li>--}}
{{--    </ul>--}}
@endsection
@section('banner')
    <section class="section section-banner" id="sec-home">
        <!-- Start Main Banner -->
        <div class="banner-slider owl-carousel">
            <!-- single banner slider -->
            @foreach($sliders as $slider)
                <div class="main-banner banner-bg-one" style="background:url({{asset('storage/sliders/'.$slider->image)}})">
                    <div class="banner-text text-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <h3>{{$slider->name[App()->getLocale()]}}</h3>
                             {!! $slider->content[App()->getLocale()] !!}
                                    <div class="banner-button">
                                        <a href="{{Route('contact.index',App()->getLocale())}}" class="main-btn">@lang('app.Contact')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
            <!-- single banner slider -->
{{--            <div class="main-banner banner-bg-two">--}}
{{--                <div class="banner-text text-center">--}}
{{--                    <div class="container">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-lg-12 col-md-12">--}}
{{--                                <h3>We will make your bussines</h3>--}}
{{--                                <h1>Great Again</h1>--}}
{{--                                <h5>We combine design, thinking and technical craft.</h5>--}}
{{--                                <div class="banner-button">--}}
{{--                                    <a href="{{Route('contact.index',App()->getLocale())}}" class="main-btn">Contact</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- single banner slider -->--}}
{{--            <div class="main-banner banner-bg-three">--}}
{{--                <div class="banner-text text-center">--}}
{{--                    <div class="container">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-lg-12 col-md-12">--}}
{{--                                <h3>We will make your bussines</h3>--}}
{{--                                <h1>Creative</h1>--}}
{{--                                <h5>We combine design, thinking and technical craft.</h5>--}}
{{--                                <div class="banner-button">--}}
{{--                                    <a href="{{Route('contact.index',App()->getLocale())}}" class="main-btn">Contact</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>
@endsection
@section('content')
    <!-- header -->

    <!-- End section banner -->
    <!-- Services Slider -->
    <section class="services-slider">
        <div class="container">
            <div class="row">
                <div class="services-grid white-color owl-carousel">
                @foreach($sections as $section)
                    @if($section->title['en'] ==='Design')

                        <div class="slide-service">
                            <img style="width: 52px;height: 52px;margin-left: 131px;margin-bottom: 5px" src="{{asset('storage/'.$section->image)}}">
                            {{--                                <i class="fas fa-pen-nib"></i>--}}
                            <h3>{!! $section->title[App()->getLocale()] !!}</h3>
                            <p>{!! $section->description[App()->getLocale()] !!}</p>
                        </div>

                    @endif
                @endforeach


                       @foreach($sections as $section)
                           @if($section->title['en'] ==='strategy')

                               <div class="slide-service">
                                   <img style="width: 52px;height: 52px;margin-left: 131px;margin-bottom: 5px" src="{{asset('storage/'.$section->image)}}">
                                   {{--                                <i class="fas fa-pen-nib"></i>--}}
                                   <h3 >{!! $section->title[App()->getLocale()] !!}</h3>
                                   <p >{!! $section->description[App()->getLocale()] !!}</p>
                               </div>

                           @endif
                       @endforeach
                    @foreach($sections as $section)
                        @if($section->title['en'] ==='content')

                                <div class="slide-service">
                                    <img style="width: 52px;height: 52px;margin-left: 131px;margin-bottom: 5px" src="{{asset('storage/'.$section->image)}}">
                                    {{--                                <i class="fas fa-pen-nib"></i>--}}
                                    <h3>{!! $section->title[App()->getLocale()] !!}</h3>
                                    <p>{!! $section->description[App()->getLocale()] !!}</p>
                                </div>

                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- // End Services Slider -->
    <!-- Section about -->

    @foreach($sections as $section)

        @if($section->title['en'] == 'About Us')

            <section class="section section-about bg-element equal-space" id="sec-about">
                <div class="container">
                    <div class="row">
                        <!-- heading -->
                        <div class="col-12 col-lg-8 offset-lg-2">
                            <div class="heading text-center mb-5">
                                <h2>{{__('about_us')}}</h2>

                            </div>
                        </div>
                        <!-- about image -->
                        <div class="col-12 col-lg-6">
                            <div class="about-image">
                                <div class="box-img">

                                    <img src="{{asset('storage/'.$section->image)}}" alt="about">
                                </div>
                            </div>
                        </div>
                        <!-- about content -->
                        <div class="col-12 col-lg-6">
                            <div class="about-content">


                                {!! $section->description[App()->getLocale()] !!}


                            </div>
                        </div>
                    </div>
                </div>
            </section>


        @endif

    @endforeach

    @foreach($sections as $section)
        @if($section->title['en'] == 'our_video')

            <section class="video-section ex-section equal-space white-color">
                <div class="container">
                    <div class="row">
                        <!-- video text -->
                        <div class="col-12 col-lg-6">
                            <div class="video-text">


                                <p>{!! $section->description[App()->getLocale()] !!}</p>
                                {{--                        <a href="#" class="main-btn">Join Now</a>--}}
                            </div>
                        </div>

                        <!-- video -->
                        <div class="col-12 col-lg-6">
                            <div class="video">
                                <img src="{{asset('storage/'.$section->image)}}" alt="video" class="hoverZoomLink">
                                <a class="video-icon gradient-bg-color" data-fancybox="youtube" href="{{$section->link}}">
                                    <i class="fas fa-play-circle"></i>
                                    <h3>{{__('watch_video')}}</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endforeach
{{--    <section class="section section-blog bg-element equal-space">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <!-- heading -->--}}
{{--                <div class="col-12 col-lg-8 offset-lg-2">--}}
{{--                    <div class="heading text-center mb-5">--}}
{{--                        <h2>@lang('app.Articles')</h2>--}}
{{--                        <p>Hoev wpsuv seloe eit bmet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-12">--}}
{{--                    <!-- blog post list -->--}}
{{--                    <div class="blog-list owl-carousel owl-loaded owl-drag">--}}
{{--                        <!-- single blog -->--}}

{{--                        <!-- single blog -->--}}

{{--                        <!-- single blog -->--}}

{{--                        <!-- single blog -->--}}

{{--                        <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-1140px, 0px, 0px); transition: all 0.9s ease 0s; width: 3800px;"><div class="owl-item cloned" style="width: 350px; margin-right: 30px;">--}}

{{--                                   @foreach($AllNews as $news)--}}
{{--                                        <article class="single-blog">--}}
{{--                                            <!-- thumbnail -->--}}
{{--                                            <div class="post-image">--}}
{{--                                                <img src="{{asset('storage/'.$news->image)}}" alt="post-image" class="hoverZoomLink">--}}
{{--                                            </div>--}}
{{--                                            <!-- post content -->--}}
{{--                                            <div class="post-content">--}}
{{--                                                <ul class="post-meta">--}}
{{--                                                    <li> {{$news->user->name}}</li>--}}
{{--                                                    <li><i class="fas fa-calendar"></i>{{$news->created_at}}</li>--}}

{{--                                                </ul>--}}
{{--                                                <a href="{{route('news.show',[App()->getLocale(),$news->id])}}"><h2>{{$news->title[App()->getLocale()]}}</h2></a>--}}
{{--                                                <p>{{$news->small_description[App()->getLocale()]}}</p>--}}
{{--                                                <a href="#" class="read-more"><i class="fas fa-angle-right"></i> {{__('read_more')}}</a>--}}
{{--                                            </div>--}}
{{--                                        </article></div><div class="owl-item cloned" style="width: 350px; margin-right: 30px;">--}}
{{--                                    @endforeach--}}



{{--                                </div></div></div><div class="owl-nav disabled">--}}
{{--                            <button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots"><button role="button" class="owl-dot active"><span></span></button><button role="button" class="owl-dot"><span></span></button></div></div>--}}
{{--                </div>--}}
{{--                <!-- more post -->--}}
{{--                <div class="col-12 text-center">--}}
{{--                    <a href="{{route('news.index',App()->getLocale())}}" class="main-btn main-btn2 mt-4">@lang('app.All Articles')</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
@endsection
