<?php $userRoles = Auth::user()->roles->pluck('name'); ?>
@foreach($markets as $key => $market)
    <tr class="id{{$market->id}}">
        <td>{{ $key+1}}</td>
        <td>{{ $market->title['ar'] }}</td>
        <td>{{ $market->title['en'] }}</td>
        @if($userRoles->contains('Admin') || $userRoles->contains('Editor'))
            <td>
                <a href="{{route('markets.edit' ,$market->id)}}" class="btn btn-outline btn-circle green btn-sm purple">
                    <i class="fa fa-edit"></i>Edit
                </a>
            </td>
        @endif
        @if($userRoles->contains('Admin') || $userRoles->contains('Remover'))
            <td>
                <form method="POST" action="{{route('markets.destroy',$market->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button data-id="{{$market->id}}" class="deleteRecord btn btn-danger btn btn-outline btn-circle dark btn-sm black">
                        <i class="fa fa-trash-o"></i>Delete
                    </button>
                </form>
            </td>
        @endif
    </tr>
@endforeach
<tr>
    <td colspan="3" align="center">
        {!! $markets->links() !!}
    </td>
</tr>
