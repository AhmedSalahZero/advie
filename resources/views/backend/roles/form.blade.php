@section('title') @if(isset($role->id)) Edit @else Create New @endif Role @endsection
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
                                    <i class="fa fa-gift"></i>@if(isset($role->id)) Edit @else Create @endif New Role</div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                    <a id="reload" class="reload"> </a>
                                    <a href="javascript:;" class="remove"> </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="{{ isset($role->id) ?  route('roles.update' , [$role->id]) : route('roles.store') }}" class="form-horizontal" method="post"  enctype="multipart/form-data">
                                    @csrf
                                    @if(isset($role->id))
                                        @method('PUT')
                                    @endif
                                    <div class="form-body">

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Role
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input
                                                    type="text"
                                                    name="name"
                                                    class="form-control input-circle"
                                                    placeholder="Enter User Role"
                                                    @if(isset($role->id)) value="{{$role->name}}" @else value="{{old('name')}}" @endif
                                                    @if($errors->first('name')) style="border: solid 1px red;" @endif
                                                >
                                                <span style="color: red;">{{str_replace("."," ",$errors->first('name')) }}</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn btn-circle green" name="submitbutton" value="save-draft" class="btn red">Submit & Close</button>
                                                <button type="submit" class="btn btn-circle green" name="submitbutton" value="save" class="btn red">Submit</button>
                                                <a href="{{route('roles.index')}}" class="btn btn-circle grey-salsa btn-outline">Cancel</a>
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
