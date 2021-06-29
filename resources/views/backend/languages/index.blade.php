<?php $userRoles = Auth::user()->roles->pluck('name'); ?>
@section('title') View Languages @endsection
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
                                <i class="fa fa-picture"></i>View Languages ({{count($AllLanguages)}})</div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                                <a id="reload" class="reload"> </a>
                                <a href="javascript:;" class="remove"> </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-scrollable">
                                <table class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th> Name </th>
                                        <th> Code </th>
                                        <th> status </th>
                                        <th> Image </th>
                                        @if($userRoles->contains('Admin') || $userRoles->contains('Editor'))
                                            <th> Edit </th>
                                        @endif
                                        @if($userRoles->contains('Admin') || $userRoles->contains('Remover'))
                                            <th> Delete </th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($languages as $key => $language)
                                            <tr class="id{{$language->id}}">
                                                <td>{{ $key+1}}</td>
                                                <td>{{ $language->name }}</td>
                                                <td>{{ $language->code }}</td>
                                                <td>
                                                    @if($language->image == null)
                                                        <span class="label label-sm label-warning"> لا يوجد صورة </span>
                                                    @else
                                                        <img id="img-ajax" width="50px" height="50px" src="{{url('storage/languages/'.$language->image) }}">

                                                    @endif
                                                </td>
                                                @if($userRoles->contains('Admin') || $userRoles->contains('Editor'))
                                                    <td>
                                                        <a href="{{route('languages.edit' ,$language->id)}}" class="btn btn-outline btn-circle green btn-sm purple">
                                                            <i class="fa fa-edit"></i>Edit
                                                        </a>
                                                    </td>
                                                @endif
                                                @if($userRoles->contains('Admin') || $userRoles->contains('Remover'))
                                                    <td>
                                                        <form method="POST" action="{{route('languages.destroy',$language->id)}}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button data-id="{{$language->id}}" class="deleteRecord btn btn-danger btn btn-outline btn-circle dark btn-sm black">
                                                                <i class="fa fa-trash-o"></i>Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $languages->links() }}
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
