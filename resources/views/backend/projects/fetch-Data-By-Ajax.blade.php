<?php $userRoles = Auth::user()->roles->pluck('name'); ?>
@foreach($projects as $key => $oneProject)
    <tr class="id{{$oneProject->id}}">
        <td>{{ $key+1}}</td>
        <td>{{ $oneProject->title['ar'] }}</td>
        <td>{{ $oneProject->title['en'] }}</td>
        @if($userRoles->contains('Admin') || $userRoles->contains('Editor'))
            <td>
                <a href="{{route('projects.edit' ,$oneProject->id)}}" class="btn btn-outline btn-circle green btn-sm purple">
                    <i class="fa fa-edit"></i>Edit
                </a>
            </td>
        @endif
        @if($userRoles->contains('Admin') || $userRoles->contains('Remover'))
            <td>
                <form method="POST" action="{{route('projects.destroy',$oneProject->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button data-id="{{$oneProject->id}}" class="deleteRecord btn btn-danger btn btn-outline btn-circle dark btn-sm black">
                        <i class="fa fa-trash-o"></i>Delete
                    </button>
                </form>
            </td>
        @endif
    </tr>
@endforeach
<tr>
    <td colspan="3" align="center">
        {!! $projects->links() !!}
    </td>
</tr>
