<?php $userRoles = Auth::user()->roles->pluck('name'); ?>
@section('title') Messages @endsection
@extends('layouts.admin')
@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box red">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-picture"></i>View Messages ({{count($AllMessages)}})</div>
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
                                @if(count($messages) > 0)

                                <table class="all_table table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th class="sorting" data-sorting_type="asc" data-column_name="id"> # <span id="id_icon"></span></th>
                                        <th class="sorting" data-sorting_type="asc" data-column_name="post_title">name <span id="post_title_icon"></span></th>
                                        <th class="sorting" data-sorting_type="asc" data-column_name="post_title">email <span id="post_title_icon"></span></th>
                                        <th class="sorting" data-sorting_type="asc" data-column_name="post_title">subject <span id="post_title_icon"></span></th>
                                        <th class="sorting" data-sorting_type="asc" data-column_name="post_title">Message <span id="post_title_icon"></span></th>
                                        <th class="sorting" data-sorting_type="asc" data-column_name="post_title">Status <span id="post_title_icon"></span></th>




                                            <th> MarkAsRead </th>



                                            <th > Delete </th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                       @include('backend.messages.fetch-Data-By-Ajax')


                                    </tbody>
                                </table>
                                @else
                                    <div class="alert alert-danger text-center">
                                        <h2>There is no messages untill now </h2>
                                    </div>
                                @endif

                                    <div class="alert alert-danger text-center no_messages" style="display: none">
                                        <h2>There is no messages untill now </h2>
                                    </div>

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
            $('.deleteRecord').on('click',function(event){
                event.preventDefault();
                let message_id = ($(event.target).attr('message_id'));

                $.ajax({
                    type: 'delete',
                    url: "/admin/messages/"+message_id,
                    data: {
                        '_token':"{{csrf_token()}}",

                    },
                    success: function (data) {

                        $(`.id${data.message_id}`).remove();
                        if(data.count_messages === 0 )
                        {
                            $('.no_messages').show();
                            $('.all_table').hide();
                        }


                    }, error: function (reject) {


                    }
                });



            })
        })
    </script>
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
                    url:"/admin/messages/paginate_by_ajax?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query,
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
