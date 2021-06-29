<?php $userRoles = Auth::user()->roles->pluck('name'); ?>
@foreach($news as $key => $new)
    <tr class="id{{$new->id}}">
        <td>{{ $key+1}}</td>
        <td>{{ $new->title['ar'] }}</td>
        <td>{{ $new->title['en'] }}</td>
        @if($userRoles->contains('Admin') || $userRoles->contains('Editor'))
            <td>
                <a href="{{route('blog.edit' ,$new->id)}}" class="btn btn-outline btn-circle green btn-sm purple">
                    <i class="fa fa-edit"></i>Edit
                </a>
            </td>
        @endif
        @if($userRoles->contains('Admin') || $userRoles->contains('Remover'))
            <td>
                <form method="POST" action="{{route('blog.destroy',$new->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button data-id="{{$new->id}}" class="deleteRecord btn btn-danger btn btn-outline btn-circle dark btn-sm black">
                        <i class="fa fa-trash-o"></i>Delete
                    </button>
                </form>
            </td>
        @endif
    </tr>
@endforeach
<tr>
    <td colspan="3" align="center">
        {!! $news->links() !!}
    </td>
</tr>
