@extends('layouts.front')
@section('title')
    {{__('Articles')}}
@endsection

{{--@section('navbar')--}}
{{--    <ul class="navbar-nav">--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link " href="{{Route('home.index',App()->getLocale())}}">{{__('home')}} <span class="sr-only">(current)</span></a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link " href="{{Route('about.index',App()->getLocale())}}">{{__('about')}}</a>--}}
{{--        </li>--}}
{{--        <li class="nav-item dropdown">--}}
{{--            <a class="nav-link dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{__('services')}}</a>--}}
{{--            <ul class="dropdown-menu">--}}
{{--                @foreach($AllServices as $oneService)--}}
{{--                    <li class="nav-item {{(isset($service)&&$oneService->id === $service->id) ?'active' : ''}} "><a class="dropdown-item " href="{{route('services.show',[App()->getLocale(),$oneService->id])}}">{{$oneService->title[App()->getLocale()]}}</a></li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li class="nav-item dropdown">--}}
{{--            <a class="nav-link dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{__('projects')}}</a>--}}
{{--            <ul class="dropdown-menu">--}}
{{--                @foreach($AllProjects as $oneProject)--}}
{{--                    <li class="nav-item {{(isset($project)&&$oneProject->id === $project->id) ?'active' : ''}} "><a class="dropdown-item " href="{{route('projects.show',[App()->getLocale(),$oneProject->id])}}">{{$oneProject->title[App()->getLocale()]}}</a></li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link active" href="{{Route('news.index',App()->getLocale())}}">{{__('news')}}</a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link " href="{{Route('markets.show',[App()->getLocale()])}}">{{__('market')}}</a>--}}
{{--        </li>--}}

{{--        <li class="nav-item">--}}
{{--            <a class="nav-link " href="{{route('contact.index',App()->getLocale())}}">{{__('contact')}}</a>--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--@endsection--}}
@section('banner')
    <section class="section page-banner">
        <div class="d-flex w-100 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="page-banner-text">
                            <h1>{{__('Articles')}}</h1>
                        </div>
                    </div>
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{Route('home.index',App()->getLocale())}}"><i class="fas fa-home"></i>{{__('home')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('Articles')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <main class="section blog-posts-section equal-space">
        <div class="container">
            <div class="row">
                <!-- single blog -->
               @foreach($news as $new)
                    <div class="col-12 col-lg-4 col-md-6">
                        <article class="single-blog">
                            <!-- thumbnail -->
                            <div class="post-image">
                                <img src="{{asset('storage/'.$new->image)}}" alt="alt">
                            </div>
                            <!-- post content -->
                            <div class="post-content">
                                <ul class="post-meta">
                                    <li style="margin-right: 50px;margin-left: 30px"> <a href="#">{{$new->user->name}}</a></li>
                                    <li><i class="fas fa-calendar"></i> {{$new->created_at}}</li>

                                </ul>
                                <h2><a href="{{Route('news.show',[App()->getLocale(),$new->id])}}">{{$new->title[App()->getLocale()]}}</a></h2>
                                <p>{{$new->small_description[App()->getLocale()]}}</p>
                                <a href="{{Route('news.show',[App()->getLocale(),$new->id])}}" class="read-more"><i class="fas fa-angle-right"></i>{{__('read_more')}}</a>
                            </div>
                        </article>
                    </div>
               @endforeach
                <!-- pagination -->
                <div class="col-12 mt-4 justify-content-center">

                         <div class="justify-content-at-center" >
                             {!! $news->links() !!}
                         </div>


                </div>
            </div>
        </div>
    </main>


@endsection
