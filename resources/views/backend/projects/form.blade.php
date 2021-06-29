@section('title') @if(isset($project->id)) Edit @else Create New @endif  Project @endsection
@extends('layouts.admin')

@section('content')

    <div class="page-content-wrapper">

        <div class="page-content">


            @include('backend.partials.toaster')

            <div class="row">
                <div class="col-md-12">
                    <div class="tab-pane active" id="tab_0">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> Sections </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                    <a id="reload" class="reload"> </a>
                                    <a href="javascript:;" class="remove"> </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="{{isset($project) ? route('projects.update',$project->id) :route('projects.store') }}" class="form-horizontal" method="post"  enctype="multipart/form-data">
                                    @csrf
                                    @if(isset($project))
                                        @method('put')
                                        @endif
                                    <div class="form-body">

                                        @foreach($AllLanguages as $one)


                                                        <div class="form-group">

                                                            <label for="title{{$one->name}}" class="col-md-3 control-label"> project {{$one->name}} title

                                                                <span class="required" aria-required="true"> * </span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <input
                                                                    type="text"
                                                                    id="title{{$one->name}}"
                                                                    name="title[{{$one->code}}]"
                                                                    class="form-control input-circle"
                                                                    placeholder="Enter {{$one->name}} project Title "
                                                                    value="{{isset($project) ? $project->title[$one->code] : old("title[$one->code]") }}"
                                                                    @if($errors->first("title.".$one->code)) style="border: solid 1px red;" @endif
                                                                >
                                                                <span style="color: red;">{{str_replace("."," ",$errors->first("title.".$one->code)) }}</span>
                                                            </div>
                                                        </div>



                                                        <div class="form-group">
                                                            <label for="description{{$one->code}}" class="col-md-3 control-label">{{$one->name}} description
                                                                <span class="required" aria-required="true"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                    <textarea class="ckeditor form-control" id="description{{$one->code}}" name="description[{{$one->code}}]"
                                                              @if($errors->first("description.".$one->code)) style="border: solid 1px red;" @endif>
                                                       @if(isset($project))
                                                            {{$project->description[$one->code]}}
                                                        @else

                                                        @endif
                                                    </textarea>
                                                                <span style="color: red;">{{str_replace("."," ",$errors->first("description.".$one->code)) }}</span>
                                                            </div>
                                                        </div>
                                        @endforeach
{{--                                            <div class="form-group">--}}

{{--                                                <label for="link" class="col-md-3 control-label"> link--}}

{{--                                                    <span class="required" aria-required="true"> * </span>--}}
{{--                                                </label>--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <input--}}
{{--                                                        type="text"--}}
{{--                                                        id="link"--}}
{{--                                                        name="link"--}}
{{--                                                        class="form-control input-circle"--}}
{{--                                                        placeholder="Enter The Link "--}}
{{--                                                        value="{{isset($section) ? $section->link : old("link") }}"--}}
{{--                                                        @if($errors->first("link")) style="border: solid 1px red;" @endif--}}
{{--                                                    >--}}
{{--                                                    <span style="color: red;">{{$errors->first("link") }}</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Image
                                                    <span class="required" aria-required="true"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">

                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                            <img
                                                                id="preview2"
                                                                style="width: 200px; height: 150px;"

                                                                @if(isset($project))
                                                                src="{{url('storage/'.$project->image)}}"
                                                                @else
                                                                    @endif

                                                                alt="">
                                                        </div>

                                                        <div>
                                                <span class="btn default btn-file">
                                                  <input
                                                      id="img"
                                                      type="file"
                                                      name="image"
                                                      @if($errors->first('image')) style="border: solid 1px red;" @endif
                                                  >
                                                    <span style="color: red;">{{($errors->first("image")) }}</span>
                                                </span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Banner
                                                    <span class="required" aria-required="true"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">

                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                            <img
                                                                id="preview2"
                                                                style="width: 200px; height: 150px;"

                                                                @if(isset($project))
                                                                src="{{url('storage/'.$project->banner)}}"
                                                                @else
                                                                @endif

                                                                alt="">
                                                        </div>

                                                        <div>
                                                <span class="btn default btn-file">
                                                  <input
                                                      id="img"
                                                      type="file"
                                                      name="banner"
                                                      @if($errors->first('banner')) style="border: solid 1px red;" @endif
                                                  >
                                                    <span style="color: red;">{{($errors->first("banner")) }}</span>
                                                </span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>




                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn btn-circle green btn red"  >Submit</button>
                                                <a href="{{route('projects.index')}}" class="btn btn-circle grey-salsa btn-outline">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
@endsection
