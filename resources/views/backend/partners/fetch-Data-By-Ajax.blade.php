<?php $userRoles = Auth::user()->roles->pluck('name'); ?>
@foreach($partners as $key => $partner)
    <tr class="id{{$partner->id}}">
        <td>{{ $key+1}}</td>
        <td>{{ $partner->name['en'] }}</td>
        <td>{{ $partner->position['en'] }}</td>
        @if($userRoles->contains('Admin') || $userRoles->contains('Editor'))
            <td>
                <a href="{{route('partners.edit' ,$partner->id)}}" class="btn btn-outline btn-circle green btn-sm purple">
                    <i class="fa fa-edit"></i>Edit
                </a>
            </td>
        @endif
        @if($userRoles->contains('Admin') || $userRoles->contains('Remover'))
            <td>
                <form method="POST" action="{{route('partners.destroy',$partner->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button data-id="{{$partner->id}}" class="deleteRecord btn btn-danger btn btn-outline btn-circle dark btn-sm black">
                        <i class="fa fa-trash-o"></i>Delete
                    </button>
                </form>
            </td>
        @endif
    </tr>
@endforeach
<tr>
    <td colspan="3" align="center">
        {!! $partners->links() !!}
    </td>
</tr>
