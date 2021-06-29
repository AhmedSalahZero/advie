@section('title') @if(isset($language->id)) Edit @else Create New @endif Language @endsection
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
                                    <i class="fa fa-gift"></i>@if(isset($language->id)) Edit @else Create @endif New Language</div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                    <a id="reload" class="reload"> </a>
                                    <a href="javascript:;" class="remove"> </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="{{ isset($language->id) ?  route('languages.update' , [$language->id]) : route('languages.store') }}" class="form-horizontal" method="post"  enctype="multipart/form-data">
                                    @csrf
                                    @if(isset($language->id))
                                        @method('PUT')
                                    @endif
                                    <div class="form-body">

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Language
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input
                                                    type="text"
                                                    name="name"
                                                    class="form-control input-circle"
                                                    placeholder="Enter User Language"
                                                    @if(isset($language->id)) value="{{$language->name}}" @else value="{{old('name')}}" @endif
                                                    @if($errors->first('name')) style="border: solid 1px red;" @endif
                                                >
                                                <span style="color: red;">{{str_replace("."," ",$errors->first('name')) }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Code
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input
                                                    type="text"
                                                    name="code"
                                                    class="form-control input-circle"
                                                    placeholder="Enter Language Code"
                                                    @if(isset($language->id)) value="{{$language->code}}" @else value="{{old('code')}}" @endif
                                                    @if($errors->first('code')) style="border: solid 1px red;" @endif
                                                >
                                                <span style="color: red;">{{str_replace("."," ",$errors->first('code')) }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Status
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <div class="mt-radio-inline">
                                                    <label class="mt-radio">
                                                        <input
                                                            type="radio"
                                                            id="optionsRadios25"
                                                            value="1"
                                                            checked=""
                                                            @if(isset($language->id)) {{$language->active == 1 ? 'checked' : ''}}  @endif
                                                            name="active"
                                                            @if(isset($language->id)) value="{{$language->active}}" @else value="{{old('active')}}" @endif
                                                        > Active
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio">
                                                        <input
                                                            type="radio"
                                                            name="active"
                                                            id="optionsRadios26"
                                                            value="0"
                                                            @if(isset($language->id)) value="{{$language->active}}" @else value="{{old('active')}}" @endif
                                                            @if(isset($language->id)) {{$language->active == 0 ? 'checked' : ''}}  @endif
                                                        >Deactive
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                            <img
                                                                id="preview"
                                                                style="width: 200px; height: 150px;"
                                                                @if(isset($language->image))
                                                                src="{{url('storage/languages/'.$language->image)}}"
                                                                @else
                                                                src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                                                @endif
                                                                alt="">
                                                        </div>
                                                        <div>
                                                        <span class="btn default btn-file">
                                                          <input
                                                              id="img"
                                                              type="file"
                                                              name="image"
                                                              @if(isset($language->id)) value="{{$language->image}}" @else value="{{@old('image')}}" @endif
                                                              @if($errors->first('image')) style="border: solid 1px red;" @endif
                                                          >
                                                        </span>
                                                        </div>
                                                    </div>
                                                    <span style="color: red;">{{str_replace("."," ",@$errors->first('image')) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn btn-circle green" name="submitbutton" value="save-draft" class="btn red">Submit & Close</button>
                                                <button type="submit" class="btn btn-circle green" name="submitbutton" value="save" class="btn red">Submit</button>
                                                <a href="{{route('languages.index')}}" class="btn btn-circle grey-salsa btn-outline">Cancel</a>
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
