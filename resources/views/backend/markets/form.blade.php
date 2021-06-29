@section('title') @if(isset($market->id)) Edit @else Create markets @endif  Page @endsection
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
                                    <i class="fa fa-gift"></i>@if(isset($market->id)) Edit @else Create markets @endif </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                    <a id="reload" class="reload"> </a>
                                    <a href="javascript:;" class="remove"> </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="{{ isset($market->id) ?  route('markets.update' , [$market->id]) : route('markets.store') }}" class="form-horizontal" method="post"  enctype="multipart/form-data">
                                    @csrf
                                    @if(isset($market->id))
                                        @method('PUT')
                                    @endif
                                    <div class="form-body">
                                        @foreach($AllLanguages as $one)
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">{{$one->name}} Title
                                                    <span class="required" aria-required="true"> * </span>
                                                </label>
                                                <div class="col-md-6">
                                                    <input
                                                        type="text"
                                                        name="title[{{$one->code}}]"
                                                        class="form-control input-circle"
                                                        placeholder="Enter {{$one->name}} markets Title"
                                                        @if(isset($market->id)) value="{{$market->title["$one->code"]}}" @else value='{{old("title.".$one->code)}}' @endif
                                                        @if($errors->first("title.".$one->code)) style="border: solid 1px red;" @endif
                                                    >
                                                    <span style="color: red;">{{str_replace("."," ",$errors->first("title.".$one->code)) }}</span>
                                                </div>
                                            </div>
                                        @endforeach

                                        @foreach($AllLanguages as $one)
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">{{$one->name}} Content
                                                    <span class="required" aria-required="true"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <textarea class="ckeditor form-control" id="content_{{$one->code}}" name="content[{{$one->code}}]"
                                                              @if($errors->first("content.".$one->code)) style="border: solid 1px red;" @endif>
                                                        @if(isset($market->id)) {{$market->content[$one->code]}} @else {{old("content.".$one->code)}} @endif
                                                    </textarea>
                                                    <span style="color: red;">{{str_replace("."," ",$errors->first("content.".$one->code)) }}</span>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Image
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <div class="fileinput fileinput-market" data-provides="fileinput">
                                                    @if(isset($market->id))
                                                        <div class="fileinput-market thumbnail" style="width: 200px; height: 150px;">

                                                            <img
                                                                id="preview"
                                                                style="width: 200px; height: 150px;"
                                                                @if(isset($market->image))
                                                                src="{{url('storage/'.$market->image)}}"
                                                                @else
                                                                src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                                                @endif
                                                                alt="">
                                                        </div>
                                                    @endif
                                                    <div>
                                                    <span class="btn default btn-file">
                                                      <input
                                                          id="img"
                                                          type="file"
                                                          name="image"
                                                          @if(isset($market->id)) value="{{$market->image}}"  @endif
                                                          @if($errors->first('image')) style="border: solid 1px red;" value="{{@old('image')}}" @endif
                                                      >
                                                    </span>
                                                    </div>
                                                </div>
                                                <span style="color: red;">{{($errors->first('image')) }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Banner
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <div class="fileinput fileinput-market" data-provides="fileinput">
                                                    @if(isset($market->id))
                                                        <div class="fileinput-market thumbnail" style="width: 200px; height: 150px;">
                                                            <img
                                                                id="preview2"
                                                                style="width: 200px; height: 150px;"
                                                                @if(isset($market->banner))
                                                                src="{{url('storage/'.$market->banner)}}"
                                                                @else
                                                                src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                                                @endif
                                                                alt="">
                                                        </div>
                                                    @endif
                                                    <div>
                                                <span class="btn default btn-file">
                                                  <input
                                                      id="img"
                                                      type="file"
                                                      name="banner"
                                                      @if(isset($market->id)) value="{{$market->banner}}" @else value="{{@old('banner')}}" @endif
                                                      @if($errors->first('banner')) style="border: solid 1px red;" @endif
                                                  >
                                                </span>
                                                    </div>
                                                </div>
                                                <span style="color: red;">{{$errors->first('banner')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn btn-circle green" name="submitbutton" value="save-draft" class="btn red">Submit & Close</button>
                                                <button type="submit" class="btn btn-circle green" name="submitbutton" value="save" class="btn red">Submit</button>
                                                <a href="{{route('markets.index')}}" class="btn btn-circle grey-salsa btn-outline">Cancel</a>
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
@section('js')



    <script>

        $(document).ready(function () {


            $('#item_name').select2({

                ajax: {
                    url: '{{route('pages.select')}}',
                    data: function (params) {
                        return {
                            search: params.term,
                            page: params.page || 1
                        };
                    },
                    dataType: 'json',
                    processResults: function (data) {
                        data.page = data.page || 1;
                        return {
                            results: data.items.map(function (item) {
                                // var name_en =JSON.parse(item.name);
                                // name_en.en
                                return {
                                    id: item.id,
                                    text: item.name['en']
                                };
                            }),
                            pagination: {
                                more: data.pagination
                            }
                        }
                    },
                    cache: true,
                    delay: 250
                },
                placeholder: 'من فضلك اختار الموضوعات التابعة',
                // minimumInputLength: 2,
                multiple: false
            });
        });
    </script>
    <script>
@foreach($AllLanguages as $lang)
CKEDITOR.replace('content_{{$lang->code}}', {
    height: 300,
    filebrowserUploadUrl: "{{Route('upload.image',['_token'=>csrf_token()])}}",

});
    @endforeach

    </script>


@endsection
@section('js')
    <script>
        @foreach($AllLanguages as $lang)
        CKEDITOR.replace('content_{{$lang->code}}', {
            height: 300,
            filebrowserUploadUrl: "{{Route('upload.image',['_token'=>csrf_token()])}}",

        });
        @endforeach

    </script>
@endsection
@section('js')
    <script>
        @foreach($AllLanguages as $lang)
        CKEDITOR.replace('content_{{$lang->code}}', {
            height: 300,
            filebrowserUploadUrl: "{{Route('upload.image',['_token'=>csrf_token()])}}",

        });
        @endforeach

    </script>
@endsection
