@extends('layouts.front')

@section('title')
    {{__('projects')}}
@endsection
@section('navbar')
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link " href="{{Route('home.index')}}">{{__('home')}} <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item ">
            <a class="nav-link " href="{{Route('about.index',App()->getLocale())}}">{{__('about')}}</a>
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
            <a class="nav-link dropdown-toggle active" data-toggle="dropdown" data-hover="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{__('projects')}}</a>
            <ul class="dropdown-menu">
                @foreach($AllProjects as $oneProject)
                    <li class="nav-item  "><a class="dropdown-item {{(isset($project)&&$oneProject->id === $project->id) ?'active' : ''}}" href="{{route('projects.show',[App()->getLocale(),$oneProject->id])}}">{{$oneProject->title[App()->getLocale()]}}</a></li>
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
            <a class="nav-link" href="{{route('contact.index',App()->getLocale())}}">{{__('contact')}}</a>
        </li>
    </ul>
@endsection
@section('css')
    <style>
        .owl-stage-outer{height:420px;}
        .banner-bg-one {
            background-image: url({{asset("storage/".$project->banner)}});
        }
        .section-about .heading:before {
            content: "{{__('projects')}}";
        }


    </style>

@endsection

@section('banner')
    <section class="section section-banner" id="sec-home">
        <!-- Start Main Banner -->
        <div class="banner-slider owl-carousel">
            <!-- single banner slider -->
            <div class="main-banner banner-bg-one" >
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

@section('content')
    <section class="section section-about bg-element equal-space" id="sec-about">
        <div class="container">
            <div class="row">
                <!-- heading -->
                <div class="col-12 col-lg-8 offset-lg-2">
                    <div class="heading text-center mb-5">
                        <h2>{!! $project->title[App()->getLocale()] !!}</h2>

                    </div>
                </div>
                <!-- about image -->
                <div class="col-12 col-lg-6">
                    <div class="about-image">
                        <div class="box-img">
                            <img src="{{asset('storage/'.$project->image)}}" alt="project">
                        </div>
                    </div>
                </div>
                <!-- about content -->
                <div class="col-12 col-lg-6">
                    <div class="about-content">

                        {!! $project->description[App()->getLocale()] !!}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

