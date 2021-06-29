@extends('layouts.front')

@section('content')

    <section class="section section-contact bg-element equal-space" id="sec-contact">
        <div class="container">
            <div class="row">
                <!-- heading -->
                <div class="col-12 col-lg-8 offset-lg-2">
                    <div class="heading text-center mb-5">
                        <h2>{{$contact->name[App()->getLocale()]}}</h2>
                    </div>
                </div>
            </div>
            <!-- contact info -->
            <div class="contact-info">
                <div class="row">
                @foreach($settings as $setting)
                    @if($setting->setting_name==='address')

                        <!-- single address -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="single-address">
                                    <img src="{{asset('frontend/assets/img/icons/house.png')}}" alt="office">
                                    <h3>{{__('address')}}</h3>

                                    <p>{{json_decode($setting->setting_value)->{app()->getLocale()} }}</p>
                                </div>
                            </div>
                        @endif
                        @if($setting->setting_name==='email')
                            <div class="col-12 col-md-6 col-lg-4">

                                <div class="single-address">
                                    <img src="{{asset('frontend/assets/img/icons/contact.png')}}" alt="contact">
                                    <h3>{{__('email')}}</h3>
                                    <p>{{$setting->setting_value}}</p>
                                </div>
                            </div>

                        @endif
                        @if($setting->setting_name==='phone')
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="single-address">
                                    <img src="{{asset('frontend/assets/img/icons/date-time.png')}}" alt="date time">
                                    <h3>{{__('phone')}}</h3>

                                    <p>{{$setting->setting_value}}</p>

                                </div>
                            </div>

                        @endif
                    @endforeach
                </div>
            </div>
            <!-- single address -->






            <div class="row">
                <!-- contact address -->
                <div class="col-12 col-lg-5">
                    <div class="contact-text">
                        {!! $contact->content[App()->getLocale()] !!}
                        <ul class="follow-social mt-2">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- contact form -->
                <div class="col-12 col-lg-7">
                    <form method="post" id="contact-form" action="{{Route('messages.store',App()->getLocale())}}">
                        @csrf
                        <div class="row contact-box">
                            <div class="col-12 col-md-6">
                                <p>
                                    <input type="text" name="name" id="name" placeholder="{{__('name')}}">
                                    <span class="gradient-bg-color"></span>
                                </p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p>
                                    <input type="email" name="email" id="email" placeholder="{{__('email')}}">
                                    <span class="gradient-bg-color"></span>
                                </p>
                            </div>
                            <div class="col-12">
                                <p>
                                    <input type="text" name="subject" id="subject" placeholder="{{__('subject')}}">
                                    <span class="gradient-bg-color"></span>
                                </p>
                            </div>
                            <div class="col-12">
                                <p>
                                    <textarea name="message" id="message" placeholder="{{__('write_message')}}"></textarea>
                                    <span class="gradient-bg-color"></span>
                                </p>
                            </div>
                            <div class="col-12">
                                <button class="main-btn main-btn2">{{__('send_message')}}</button>
                                <div id="form-info"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('title')
    {{__('contact')}}
@endsection
@section('navbar')
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link " href="{{Route('home.index',App()->getLocale())}}">{{__('home')}} <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{Route('about.index',App()->getLocale())}}">{{__('about')}}</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{__('services')}}</a>
            <ul class="dropdown-menu">
                @foreach($AllServices as $oneService)
                    <li class="nav-item {{(isset($service)&&$oneService->id === $service->id) ?'active' : ''}} "><a class="dropdown-item " href="{{route('services.show',[App()->getLocale(),$oneService->id])}}">{{$oneService->title[App()->getLocale()]}}</a></li>
                @endforeach
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{__('projects')}}</a>
            <ul class="dropdown-menu">
                @foreach($AllProjects as $oneProject)
                    <li class="nav-item {{(isset($project)&&$oneProject->id === $project->id) ?'active' : ''}} "><a class="dropdown-item " href="{{route('projects.show',[App()->getLocale(),$oneProject->id])}}">{{$oneProject->title[App()->getLocale()]}}</a></li>
                @endforeach
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{Route('news.index',App()->getLocale())}}">{{__('news')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{Route('markets.show',[App()->getLocale()])}}">{{__('market')}}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link active" href="{{route('contact.index',App()->getLocale())}}">{{__('contact')}}</a>
        </li>
    </ul>
@endsection
@section('css')
    <style>
    @if(App()->getLocale() === 'en')

        .section-contact .heading:before {
            content: "Contact Us";
        }
        .owl-stage-outer{height:420px;}
        .banner-bg-one {
            background-image: url({{asset("storage/pages/".$contact->banner)}});
        }



    @else
        .section-contact .heading:before {
        content: "تواصل معنا";
        }
        .owl-stage-outer{height:420px;}
        .banner-bg-one {
        background-image: url({{asset("storage/pages/".$contact->banner)}});
        }
    @endif
    </style>
    @endsection

@section('banner')
    <section class="section section-banner" id="sec-home">
        <!-- Start Main Banner -->
        <div class="banner-slider owl-carousel">
            <!-- single banner slider -->
            <div class="main-banner banner-bg-one">
                <div class="banner-text text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
{{--                                <h3>We will make your bussines</h3>--}}
{{--                                <h1>strong</h1>--}}
{{--                                <h5>We combine design, thinking and technical craft.</h5>--}}
{{--                                <div class="banner-button">--}}
{{--                                    <a href="{{Route('contact.index',App()->getLocale())}}" class="main-btn">Contact</a>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
{{--                                    <a href="{{Route('contact.index')}}" class="main-btn">Contact</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- single banner slider -->
{{--            <div class="main-banner banner-bg-three">--}}
{{--                <div class="banner-text text-center">--}}
{{--                    <div class="container">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-lg-12 col-md-12">--}}
{{--                                <h3>We will make your bussines</h3>--}}
{{--                                <h1>Creative</h1>--}}
{{--                                <h5>We combine design, thinking and technical craft.</h5>--}}
{{--                                <div class="banner-button">--}}
{{--                                    <a href="{{Route('contact.index')}}" class="main-btn">Contact</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>
@endsection
