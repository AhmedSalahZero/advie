<?php $userRoles = Auth::user()->roles->pluck('name'); ?>
@foreach($sliders as $key => $slider)
    <tr class="id{{$slider->id}}">
        <td>{{ $key+1}}</td>
        <td>{{ $slider->name['ar'] }}</td>
        <td>{{ $slider->name['en'] }}</td>
        @if($userRoles->contains('Admin') || $userRoles->contains('Editor'))
            <td>
                <a href="{{route('sliders.edit' ,$slider->id)}}" class="btn btn-outline btn-circle green btn-sm purple">
                    <i class="fa fa-edit"></i>Edit
                </a>
            </td>
        @endif
        @if($userRoles->contains('Admin') || $userRoles->contains('Remover'))
            <td>
                <form method="POST" action="{{route('sliders.destroy',$slider->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button data-id="{{$slider->id}}" class="deleteRecord btn btn-danger btn btn-outline btn-circle dark btn-sm black">
                        <i class="fa fa-trash-o"></i>Delete
                    </button>
                </form>
            </td>
        @endif
    </tr>
@endforeach
<tr>
    <td colspan="3" align="center">
        {!! $sliders->links() !!}
    </td>
</tr>
