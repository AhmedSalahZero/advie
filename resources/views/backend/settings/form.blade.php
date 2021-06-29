@section('title') @if(isset($page->id)) Edit @else Create New @endif  Page @endsection
@extends('layouts.admin')

@section('content')


    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE BASE CONTENT -->

            @include('backend.partials.toaster')

            <div class="row">
                <div class="col-md-12">
                    <div class="tab-pane active" id="tab_0">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> Settings </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                    <a id="reload" class="reload"> </a>
                                    <a href="javascript:;" class="remove"> </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="{{route('settings.store') }}" class="form-horizontal" method="post"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">

                                           @foreach($settings as $setting)
                                            @if($setting->setting_type === 'json')
                                            @foreach($AllLanguages as $one)
                                                    <div class="form-group">

                                                        <label for="{{$setting->setting_name}}[{{$one->code}}]" class="col-md-3 control-label">{{$one->name}} {{$setting->setting_name}}

                                                            <span class="required"  aria-required="true"> * </span>
                                                        </label>
                                                        <div class="col-md-6">

                                                            <input
                                                                                               type="text"
                                                                name="{{$setting->setting_name}}[{{$one->code}}]"
                                                                class="form-control input-circle"
                                                                placeholder="Enter {{$one->name}} About Title "
                                                                value="{{ json_decode($setting->setting_value)->{$one->code} }}"
                                                                id="{{$setting->setting_name}}[{{$one->code}}]"
                                                                @if($errors->first("$setting->setting_name.".$one->code)) style="border: solid 1px red;" @endif
                                                            >
                                                            <span style="color: red;">{{str_replace("."," ",$errors->first("$setting->setting_name.".$one->code)) }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @else
                                                <div class="form-group">

                                                    <label for="{{$setting->setting_name}}" class="col-md-3 control-label">{{$setting->setting_name}}

                                                        <span class="required"  aria-required="true"> * </span>
                                                    </label>

                                                    <div class="col-md-6">
                                                        <input
                                                            type="text"
                                                            name="{{$setting->setting_name}}"
                                                            class="form-control input-circle"
                                                            placeholder="Enter {{$setting->setting_name}}"
                                                            value="{{$setting->setting_value}}"
                                                            id="{{$setting->setting_name}}"
                                                            @if($errors->first("$setting->setting_name")) style="border: solid 1px red;" @endif
                                                        >
                                                        <span style="color: red;">{{($errors->first($setting->setting_name)) }}</span>
                                                    </div>
                                                </div>

                                                   @endif





                                            @endforeach



                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn btn-circle green btn red"  >Submit</button>
                                                <a href="{{route('pages.index')}}" class="btn btn-circle grey-salsa btn-outline">Cancel</a>
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
