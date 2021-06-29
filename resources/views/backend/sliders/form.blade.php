@section('title') @if(isset($slider->id)) Edit @else Create New @endif  Slider @endsection
@extends('layouts.admin')
@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <div class="tab-pane active" id="tab_0">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>@if(isset($slider->id)) Edit @else Create New @endif  Slider</div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                    <a id="reload" class="reload"> </a>
                                    <a href="javascript:;" class="remove"> </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="{{ isset($slider->id) ?  route('sliders.update' , [$slider->id]) : route('sliders.store') }}" class="form-horizontal" method="post"  enctype="multipart/form-data">
                                    @csrf
                                    @if(isset($slider->id))
                                        @method('PUT')
                                    @endif
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="page_id" class="control-label col-md-3">Page
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <select name="page_id" id="page_id" class="form-control edited select2-multiple" >
                                                    @if(isset($slider))
                                                        @foreach(\App\Page::all() as $page)
                                                            <option value="{{$page->id}}" {{($page->id ===$slider->page_id) ? "selected" : "" }}>{{$page->slug}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach(\App\Page::all() as $page)
                                                            <option value="{{$page->id}}" >{{$page->slug}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        @foreach($AllLanguages as $one)
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">{{$one->name}} Name
                                                    <span class="required" aria-required="true"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input
                                                        type="text"
                                                        name="name[{{$one->code}}]"
                                                        class="form-control input-circle"
                                                        placeholder="Enter {{$one->name}} Slider name"
                                                        @if(isset($slider->id)) value="{{$slider->name["$one->code"]}}" @else value='{{old("name.".$one->code)}}' @endif
                                                        @if($errors->first("name.".$one->code)) style="border: solid 1px red;" @endif
                                                    >
                                                    <span style="color: red;">{{str_replace("."," ",$errors->first("name.".$one->code)) }}</span>
                                                </div>
                                            </div>
                                        @endforeach

                                        @foreach($AllLanguages as $one)
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">{{$one->name}} Content
                                                    <span class="required" aria-required="true"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                <textarea class="ckeditor form-control" name="content[{{$one->code}}]"
                                                          @if($errors->first("content.".$one->code)) style="border: solid 1px red;" @endif>
                                                    @if(isset($slider->id)) {{$slider->content[$one->code]}} @else {{old("content.".$one->code)}} @endif
                                                </textarea>
                                                    <span style="color: red;">{{str_replace("."," ",$errors->first("content.".$one->code)) }}</span>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Link
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input
                                                    type="text"
                                                    name="link"
                                                    class="form-control input-circle"
                                                    placeholder="Enter Link please"
                                                    @if(isset($slider->id)) value="{{$slider->link}}" @else value="{{old('link')}}" @endif
                                                    @if($errors->first('link')) style="border: solid 1px red;" @endif
                                                >
                                                <span style="color: red;">{{str_replace("."," ",$errors->first('link')) }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Attachment
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                        <img
                                                            id="preview"
                                                            style="width: 200px; height: 150px;"
                                                            @if(isset($slider->image))
                                                            src="{{url('storage/sliders/'.$slider->image)}}"
                                                            @else
                                                            src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                                            @endif
                                                            alt=""
                                                        >
                                                    </div>
                                                    <div>
                                                    <span class="btn default btn-file">
                                                      <input
                                                          id="img"
                                                          type="file"
                                                          name="image"
                                                          @if(isset($slider->id)) value="{{$slider->image}}" @else value="{{@old('image')}}" @endif
                                                          @if($errors->first('image')) style="border: solid 1px red;" @endif
                                                      >
                                                    </span>
                                                    </div>
                                                </div>
                                                <span style="color: red;">Photo should be 1920*960</span><br>
                                                <span style="color: red;">{{str_replace("."," ",@$errors->first('image')) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn btn-circle green" name="submitbutton" value="save-draft" class="btn red">Submit & Close</button>
                                                <button type="submit" class="btn btn-circle green" name="submitbutton" value="save" class="btn red">Submit</button>
                                                <a href="{{route('sliders.index')}}" class="btn btn-circle grey-salsa btn-outline">Cancel</a>
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
