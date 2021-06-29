<?php $userRoles = Auth::user()->roles->pluck('name'); ?>
@section('title') View Partners @endsection
@extends('layouts.admin')
@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN CONDENSED TABLE PORTLET-->
                    <div class="portlet box red">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-picture"></i>View Partners ({{count($AllSections)}})</div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                                <a id="reload" class="reload"> </a>
                                <a href="javascript:;" class="remove"> </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="form-group">
                                <input type="text" name="serach" id="serach" class="form-control" />
                            </div>
                            <div class="table-scrollable">
                                <table class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th class="sorting" data-sorting_type="asc" data-column_name="id"> # <span id="id_icon"></span></th>
                                        <th class="sorting" data-sorting_type="asc" data-column_name="post_title"> Name <span id="post_title_icon"></span></th>
                                        <th class="sorting" data-sorting_type="asc" data-column_name="post_title"> Position <span id="post_title_icon"></span></th>
                                        @if($userRoles->contains('Admin') || $userRoles->contains('Editor'))
                                            <th> Edit </th>
                                        @endif
                                        @if($userRoles->contains('Admin') || $userRoles->contains('Remover'))
                                            <th> Delete </th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @include('backend.partners.fetch-Data-By-Ajax')
                                    </tbody>
                                </table>
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                                <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                                <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                            </div>
                        </div>
                    </div>
                    <!-- END CONDENSED TABLE PORTLET-->
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
        $(document).ready(function(){

            function clear_icon()
            {
                $('#id_icon').html('');
                $('#post_title_icon').html('');
            }

            function fetch_data(page, sort_type, sort_by, query)
                {
                $.ajax({
                    url:"/admin/partners/paginate_by_ajax?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query,
                    success:function(data)
                    {
                        $('tbody').html('');
                        $('tbody').html(data);
                    }
                })
            }

            $(document).on('keyup', '#serach', function(){
                var query = $('#serach').val();
                var column_name = $('#hidden_column_name').val();
                var sort_type = $('#hidden_sort_type').val();
                var page = $('#hidden_page').val();
                fetch_data(page, sort_type, column_name, query);
            });

            $(document).on('click', '.sorting', function(){
                var column_name = $(this).data('column_name');
                var order_type = $(this).data('sorting_type');
                var reverse_order = '';
                if(order_type == 'asc')
                {
                    $(this).data('sorting_type', 'desc');
                    reverse_order = 'desc';
                    clear_icon();
                    $('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-bottom"></span>');
                }
                if(order_type == 'desc')
                {
                    $(this).data('sorting_type', 'asc');
                    reverse_order = 'asc';
                    clear_icon
                    $('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-top"></span>');
                }
                $('#hidden_column_name').val(column_name);
                $('#hidden_sort_type').val(reverse_order);
                var page = $('#hidden_page').val();
                var query = $('#serach').val();
                fetch_data(page, reverse_order, column_name, query);
            });

            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var column_name = $('#hidden_column_name').val();
                var sort_type = $('#hidden_sort_type').val();

                var query = $('#serach').val();

                $('li').removeClass('active');
                $(this).parent().addClass('active');
                fetch_data(page, sort_type, column_name, query);
            });

        });
    </script>
@endsection
