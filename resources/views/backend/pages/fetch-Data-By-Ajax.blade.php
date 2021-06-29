<?php $userRoles = Auth::user()->roles->pluck('name'); ?>
@foreach($pages as $key => $page)
    <tr class="id{{$page->id}}">
        <td>{{ $key+1}}</td>
        <td>{{ $page->name['ar'] }}</td>
        <td>{{ $page->name['en'] }}</td>
        @if($userRoles->contains('Admin') || $userRoles->contains('Editor'))
            <td>
                <a href="{{route('pages.edit' ,$page->id)}}" class="btn btn-outline btn-circle green btn-sm purple">
                    <i class="fa fa-edit"></i>Edit
                </a>
            </td>
        @endif
        @if($userRoles->contains('Admin') || $userRoles->contains('Remover'))
            <td>
                <form method="POST" action="{{route('pages.destroy',$page->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button data-id="{{$page->id}}" class="deleteRecord btn btn-danger btn btn-outline btn-circle dark btn-sm black">
                        <i class="fa fa-trash-o"></i>Delete
                    </button>
                </form>
            </td>
        @endif
    </tr>
@endforeach
<tr>
    <td colspan="3" align="center">
        {!! $pages->links() !!}
    </td>
</tr>
