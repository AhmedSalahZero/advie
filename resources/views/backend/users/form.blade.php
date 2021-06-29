@section('title') @if(isset($user->id)) Edit @else Create @endif New User @endsection
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
                                    <i class="fa fa-gift"></i>@if(isset($user->id)) Edit @else Create @endif New User</div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                    <a id="reload" class="reload"> </a>
                                    <a href="javascript:;" class="remove"> </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="{{ isset($user->id) ?  route('users.update' , [$user->id]) : route('users.store') }}" class="form-horizontal" method="post"  enctype="multipart/form-data">
                                    @csrf
                                    @if(isset($user->id))
                                        @method('PUT')
                                    @endif
                                    <div class="form-body">

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Name
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input
                                                    type="text"
                                                    name="name"
                                                    class="form-control input-circle"
                                                    placeholder="Enter User name"
                                                    @if(isset($user->id)) value="{{$user->name}}" @else value="{{old('name')}}" @endif
                                                    @if($errors->first('name')) style="border: solid 1px red;" @endif
                                                >
                                                <span style="color: red;">{{str_replace("."," ",$errors->first('name')) }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Email Address
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon input-circle-left">
                                                        <i class="fa fa-envelope"></i>
                                                    </span>
                                                    <input
                                                        type="email"
                                                        class="form-control input-circle-right"
                                                        placeholder="Enter Email Address"
                                                        name="email"
                                                        @if(isset($user->id)) value="{{$user->email}}" @else value="{{old('email')}}" @endif
                                                        @if($errors->first('email')) style="border: solid 1px red;" @endif
                                                    >
                                                </div>
                                                <span style="color: red;">{{str_replace("."," ",$errors->first('email')) }}</span>
                                            </div>
                                        </div>
                                        @if(!isset($user->id))
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Password
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input
                                                        type="password"
                                                        class="form-control input-circle-left"
                                                        placeholder="Enter Password"
                                                        name="password"
                                                        @if(isset($user->id)) value="{{$user->password}}" @else value="{{old('password')}}" @endif
                                                        @if($errors->first('password')) style="border: solid 1px red;" @endif
                                                    >
                                                    <span class="input-group-addon input-circle-right">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                </div>
                                                <span style="color: red;">{{str_replace("."," ",$errors->first('password')) }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Confirm Password
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input
                                                        type="password"
                                                        class="form-control input-circle-left"
                                                        placeholder="Enter Password"
                                                        name="password_confirmation"
                                                        @if(isset($user->id)) value="{{$user->password}}" @else value="{{old('password')}}" @endif
                                                        @if($errors->first('password')) style="border: solid 1px red;" @endif
                                                    >
                                                    <span class="input-group-addon input-circle-right">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                </div>
                                                <span style="color: red;">{{str_replace("."," ",$errors->first('password')) }}</span>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">phone</label>
                                            <div class="col-md-6">
                                                <input
                                                    type="text"
                                                    name="phone"
                                                    class="form-control input-circle"
                                                    placeholder="Enter phone"
                                                    name="phone"
                                                    @if(isset($user->id)) value="{{$user->phone}}" @else value="{{@old('phone')}}" @endif
                                                    @if($errors->first('phone')) style="border: solid 1px red;" @endif
                                                >
                                                <span style="color: red;">{{str_replace("."," ",@$errors->first('phone')) }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Address</label>
                                            <div class="col-md-6">
                                                <input
                                                    type="text"
                                                    name="address"
                                                    class="form-control input-circle"
                                                    placeholder="Enter Address"
                                                    @if(isset($user->id)) value="{{$user->address}}" @else value="{{@old('address')}}" @endif
                                                    @if($errors->first('address')) style="border: solid 1px red;" @endif
                                                >
                                                <span style="color: red;">{{str_replace("."," ",@$errors->first('address')) }}</span>
                                            </div>
                                        </div>

                                        <!-- Start Image -->
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Avatar
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                        <img
                                                            id="preview"
                                                            style="width: 200px; height: 150px;"
                                                            @if(isset($user->avatar))
                                                                src="{{url('storage/users/'.$user->avatar)}}"
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
                                                      name="avatar"
                                                      @if(isset($user->id)) value="{{$user->address}}" @else value="{{@old('avatar')}}" @endif
                                                      @if($errors->first('avatar')) style="border: solid 1px red;" @endif
                                                >
                                                </span>
                                                    </div>
                                                </div>
                                                <span style="color: red;">{{str_replace("."," ",@$errors->first('avatar')) }}</span>
                                            </div>
                                        </div>
                                        <!-- End Image -->
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn btn-circle green" name="submitbutton" value="save-draft" class="btn red">Submit & Close</button>
                                                <button type="submit" class="btn btn-circle green" name="submitbutton" value="save" class="btn red">Submit</button>
                                                <a href="{{route('users.index')}}" class="btn btn-circle grey-salsa btn-outline">Cancel</a>
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
