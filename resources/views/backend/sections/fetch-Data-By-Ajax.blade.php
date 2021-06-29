<?php $userRoles = Auth::user()->roles->pluck('name'); ?>
@foreach($sections as $key => $section)
    <tr class="id{{$section->id}}">
        <td>{{ $key+1}}</td>
        <td>{{ $section->title['ar'] }}</td>
        <td>{{ $section->title['en'] }}</td>
        @if($userRoles->contains('Admin') || $userRoles->contains('Editor'))
            <td>
                <a href="{{route('sections.edit' ,$section->id)}}" class="btn btn-outline btn-circle green btn-sm purple">
                    <i class="fa fa-edit"></i>Edit
                </a>
            </td>
        @endif
        @if($userRoles->contains('Admin') || $userRoles->contains('Remover'))
            <td>
                <form method="POST" action="{{route('sections.destroy',$section->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button data-id="{{$section->id}}" class="deleteRecord btn btn-danger btn btn-outline btn-circle dark btn-sm black">
                        <i class="fa fa-trash-o"></i>Delete
                    </button>
                </form>
            </td>
        @endif
    </tr>
@endforeach
<tr>
    <td colspan="3" align="center">
        {!! $sections->links() !!}
    </td>
</tr>
