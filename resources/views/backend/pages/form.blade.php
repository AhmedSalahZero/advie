@section('title') @if(isset($page->id)) Edit @else Create New @endif  Page @endsection
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
                                    <i class="fa fa-gift"></i>@if(isset($page->id)) Edit @else Create New @endif  Page</div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                    <a id="reload" class="reload"> </a>
                                    <a href="javascript:;" class="remove"> </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="{{ isset($page->id) ?  route('pages.update' , [$page->id]) : route('pages.store') }}" class="form-horizontal" method="post"  enctype="multipart/form-data">
                                    @csrf
                                    @if(isset($page->id))
                                        @method('PUT')
                                    @endif
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Sub Page
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <select name="page_id" class="form-control edited select2-multiple" id="item_name">
                                                    <option name="sub_of" value="0" >Parent Page</option>
                                                    @foreach(\App\Page::where('page_id',0)->get() as $mainPage)
                                                        <option value="{{$mainPage->id}}" @if(isset($page->id) && $mainPage->id == $page->page_id ) selected  @endif>{{$mainPage->name['en']}}</option>
                                                        @endforeach

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
                                                        placeholder="Enter {{$one->name}} Page name"
                                                        @if(isset($page->id)) value="{{$page->name["$one->code"]}}" @else value='{{old("name.".$one->code)}}' @endif
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
                                                    <textarea class="ckeditor form-control" id="content_{{$one->code}}" name="content[{{$one->code}}]"
                                                              @if($errors->first("content.".$one->code)) style="border: solid 1px red;" @endif>
                                                        @if(isset($page->id)) {{$page->content[$one->code]}} @else {{old("content.".$one->code)}} @endif
                                                    </textarea>
                                                    <span style="color: red;">{{str_replace("."," ",$errors->first("content.".$one->code)) }}</span>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Sort
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input
                                                    type="number"
                                                    name="sort"
                                                    class="form-control input-circle"
                                                    placeholder="Enter Page Number"
                                                    @if(isset($page->id)) value="{{$page->sort}}" @else value='{{old("sort")}}' @endif
                                                    @if($errors->first("sort")) style="border: solid 1px red;" @endif
                                                >
                                                <span style="color: red;">{{str_replace("."," ",$errors->first("sort")) }}</span>
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
                                                            @if(isset($page->id)) {{$page->status == 1 ? 'checked' : ''}}  @endif
                                                            name="status"
                                                            @if(isset($page->id)) value="{{$page->status}}" @else value="{{old('status')}}" @endif
                                                        > Show
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio">
                                                        <input
                                                            type="radio"
                                                            name="status"
                                                            id="optionsRadios26"
                                                            value="0"
                                                            @if(isset($page->id)) value="{{$page->status}}" @else value="{{old('status')}}" @endif
                                                        @if(isset($page->id)) {{$page->status === 0 ? 'checked' : ''}}  @endif
                                                        >Hidden
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Show Dropdown
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <div class="mt-radio-inline">
                                                    <label class="mt-radio">
                                                        <input
                                                            type="radio"
                                                            id="optionsRadios25"
                                                            value="1"
                                                            @if(isset($page->id)) {{$page->dropdown == 1 ? 'checked' : ''}}  @endif
                                                            name="dropdown"
                                                            @if(isset($page->id)) value="{{$page->dropdown}}" @else value="{{old('dropdown')}}" @endif
                                                        > Yes
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio">
                                                        <input
                                                            type="radio"
                                                            name="dropdown"
                                                            id="optionsRadios26"
                                                            value="0"
                                                            checked=""
                                                            @if(isset($page->id)) value="{{$page->dropdown}}" @else value="{{old('dropdown')}}" @endif
                                                        @if(isset($page->id)) {{$page->dropdown == 0 ? 'checked' : ''}}  @endif
                                                        >No
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Page position
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <div class="mt-radio-inline">
                                                    <label class="mt-radio">
                                                        <input
                                                            type="radio"
                                                            id="optionsRadios25"
                                                            value="header"
                                                            checked=""
                                                            @if(isset($page->id)) {{$page->position == 'header' ? 'checked' : ''}}  @endif
                                                            name="position"
                                                            @if(isset($page->id)) value="{{$page->position}}" @else value="{{old('position')}}" @endif
                                                        > Header
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio">
                                                        <input
                                                            type="radio"
                                                            name="position"
                                                            id="optionsRadios26"
                                                            value="footer"
                                                            @if(isset($page->id)) value="{{$page->position}}" @else value="{{old('position')}}" @endif
                                                        @if(isset($page->id)) {{$page->position == 'footer' ? 'checked' : ''}}  @endif
                                                        >Footer
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Image
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    @if(isset($page->id))
                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                            <img
                                                                id="preview"
                                                                style="width: 200px; height: 150px;"
                                                                @if(isset($page->image))
                                                                src="{{url('storage/'.$page->image)}}"
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
                                                          @if(isset($page->id)) value="{{$page->image}}"  @endif
                                                          @if($errors->first('image')) style="border: solid 1px red;" value="{{@old('image')}}" @endif
                                                      >
                                                    </span>
                                                    </div>
                                                </div>
                                                <span style="color: red;">{{str_replace("."," ",@$errors->first('image')) }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Banner
                                                <span class="required" aria-required="true"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    @if(isset($page->id))
                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                            <img
                                                                id="preview2"
                                                                style="width: 200px; height: 150px;"
                                                                @if(isset($page->banner))
                                                                src="{{url('storage/'.$page->banner)}}"
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
                                                      @if(isset($page->id)) value="{{$page->banner}}" @else value="{{@old('banner')}}" @endif
                                                      @if($errors->first('banner')) style="border: solid 1px red;" @endif
                                                  >
                                                </span>
                                                    </div>
                                                </div>
                                                <span style="color: red;">{{str_replace("."," ",@$errors->first('banner')) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn btn-circle green" name="submitbutton" value="save-draft" class="btn red">Submit & Close</button>
                                                <button type="submit" class="btn btn-circle green" name="submitbutton" value="save" class="btn red">Submit</button>
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
