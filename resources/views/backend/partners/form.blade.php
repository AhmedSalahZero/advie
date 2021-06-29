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
                                    <i class="fa fa-gift"></i> Partners </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                    <a id="reload" class="reload"> </a>
                                    <a href="javascript:;" class="remove"> </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="{{isset($partner) ? route('partners.update',$partner->id) :route('partners.store') }}" class="form-horizontal" method="post"  enctype="multipart/form-data">
                                    @csrf
                                    @if(isset($partner))
                                        @method('put')
                                        @endif
                                    <div class="form-body">
                                        @foreach($AllLanguages as $one)
                                            <div class="form-group">

                                                <label for="name{{$one->name}}" class="col-md-3 control-label"> Partner {{$one->name}} name

                                                    <span class="required" aria-required="true"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input
                                                        type="text"
                                                        id="name{{$one->name}}"
                                                        name="name[{{$one->code}}]"
                                                        class="form-control input-circle"
                                                        placeholder="Enter {{$one->name}} Partner name "
                                                        value="{{isset($partner) ? $partner->name[$one->code] : old("partner[$one->code]") }}"
                                                        @if($errors->first("name.".$one->code)) style="border: solid 1px red;" @endif
                                                    >
                                                    <span style="color: red;">{{str_replace("."," ",$errors->first("partner.".$one->code)) }}</span>
                                                </div>
                                            </div>

                                                        <div class="form-group">

                                                            <label for="position{{$one->name}}" class="col-md-3 control-label"> Partner {{$one->name}} Position

                                                                <span class="required" aria-required="true"> * </span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <input
                                                                    type="text"
                                                                    id="position{{$one->name}}"
                                                                    name="position[{{$one->code}}]"
                                                                    class="form-control input-circle"
                                                                    placeholder="Enter {{$one->name}} partner position "
                                                                    value="{{isset($partner) ? $partner->position[$one->code] : old("position[$one->code]") }}"
                                                                    @if($errors->first("position.".$one->code)) style="border: solid 1px red;" @endif
                                                                >
                                                                <span style="color: red;">{{str_replace("."," ",$errors->first("position.".$one->code)) }}</span>
                                                            </div>
                                                        </div>




                                        @endforeach

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

                                                                @if(isset($partner))
                                                                src="{{url('storage/'.$partner->image)}}"
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
