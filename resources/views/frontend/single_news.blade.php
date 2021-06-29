@extends('layouts.front')

@section('title')
{{$new->title[App()->getLocale()]}}
@endsection

@section('navbar')
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link " href="{{Route('home.index',App()->getLocale())}}">{{__('home')}} <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
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
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{__('projects')}}</a>
            <ul class="dropdown-menu">
                @foreach($AllProjects as $oneProject)
                    <li class="nav-item {{(isset($project)&&$oneProject->id === $project->id) ?'active' : ''}} "><a class="dropdown-item " href="{{route('projects.show',[App()->getLocale(),$oneProject->id])}}">{{$oneProject->title[App()->getLocale()]}}</a></li>
                @endforeach
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{Route('news.index',App()->getLocale())}}">{{__('news')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{Route('markets.show',[App()->getLocale()])}}">{{__('market')}}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="{{route('contact.index',App()->getLocale())}}">{{__('contact')}}</a>
        </li>
    </ul>
@endsection


@section('banner')
    <section class="section page-banner">
        <div class="d-flex w-100 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="page-banner-text">
                            <h1>{{$new->title[App()->getLocale()]}}</h1>
                        </div>
                    </div>
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{Route('home.index',App()->getLocale())}}"><i class="fas fa-home"></i>Home</a></li>
                            <li class="breadcrumb-item"><a href="{{Route('news.index',App()->getLocale())}}"><i class="fas fa-newspaper"></i>News</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$new->title[App()->getLocale()]}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('css')
    <style>
        .owl-stage-outer{height:420px;}
        .banner-bg-one
        {
            background-image: url({{asset("storage/".$new->banner)}});
        }

    </style>
@endsection
@section('content')
    <main class="section blog-posts-section equal-space">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="blog-posts">
                        <div class="row">
                            <!-- single blog -->
                            <div class="col-12">
                                <article class="blog-post-single">
                                    <!-- thumbnail -->
                                    <div class="blog-image">
                                        <img src="{{asset('storage/'.$new->image)}}" alt="post-image">
                                    </div>
                                    <!-- post content -->
                                    <div class="single-content">
                                        <ul class="post-meta">
                                            <li>{{$new->user->name}}</li>
                                            <li><i class="fas fa-calendar"></i>{{date($new->created_at)}}</li>

                                        </ul>

                                        {!! $new->content[App()->getLocale()] !!}
                                    </div>
{{--                                    <a href=""> share this </a>--}}
                                    <!-- single post share -->
                                    <div class="single-post-share mt-5">
                                        <ul class="side-so-share">
                                            <li class="fb-bg"><a href="https://www.facebook.com/sharer/sharer.php?u={{url('/'.App()->getLocale().'/'.'news/'.$new->id)}}&display=popup"><i class="fab fa-facebook-f"></i>Share on facebook</a></li>

                                        </ul>
                                    </div>

                                </article>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
