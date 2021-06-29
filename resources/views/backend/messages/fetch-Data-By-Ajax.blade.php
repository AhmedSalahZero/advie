<?php $userRoles = Auth::user()->roles->pluck('name'); ?>
@foreach($messages as $key => $message)
    <tr class="id{{$message->id}}">
        <td>{{ $key+1}}</td>
        <td>{{ $message->name }}</td>
        <td>{{ $message->email }}</td>
        <td>{{ $message->subject }}</td>
        <td>{{ $message->message }}</td>
        <td>{{ $message->status }}</td>
        @if($userRoles->contains('Admin')  )
            <td>
                @if($message->status == 'unread')
                <a href="{{route('messages.edit' ,$message->id)}}" class="btn btn-outline btn-circle green btn-sm purple">
                    <i class="fa fa-edit"></i>Read
                </a>
                    @endif
            </td>
        @endif
        @if($userRoles->contains('Admin') )
            <td  id="delete_message_id">
                <form method="post" >
                    @method('delete')
                    {{ csrf_field() }}

                    <button  data-id="{{$message->id}}" message_id="{{$message->id}}" class="deleteRecord btn btn-danger btn btn-outline btn-circle dark btn-sm black">
                        <i class="fa fa-trash-o"></i>Delete
                    </button>
                </form>
            </td>
        @endif
    </tr>
@endforeach
<tr>
    <td colspan="3" align="center">
        {!! $messages->links() !!}
    </td>
</tr>
