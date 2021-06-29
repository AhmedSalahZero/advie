<?php $userRoles = Auth::user()->roles->pluck('name'); ?>
@foreach($services as $key => $oneService)
    <tr class="id{{$oneService->id}}">
        <td>{{ $key+1}}</td>
        <td>{{ $oneService->title['ar'] }}</td>
        <td>{{ $oneService->title['en'] }}</td>
        @if($userRoles->contains('Admin') || $userRoles->contains('Editor'))
            <td>
                <a href="{{route('services.edit' ,$oneService->id)}}" class="btn btn-outline btn-circle green btn-sm purple">
                    <i class="fa fa-edit"></i>Edit
                </a>
            </td>
        @endif
        @if($userRoles->contains('Admin') || $userRoles->contains('Remover'))
            <td>
                <form method="POST" action="{{route('services.destroy',$oneService->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button data-id="{{$oneService->id}}" class="deleteRecord btn btn-danger btn btn-outline btn-circle dark btn-sm black">
                        <i class="fa fa-trash-o"></i>Delete
                    </button>
                </form>
            </td>
        @endif
    </tr>
@endforeach
<tr>
    <td colspan="3" align="center">
        {!! $services->links() !!}
    </td>
</tr>
