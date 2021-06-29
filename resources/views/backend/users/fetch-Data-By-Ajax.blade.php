@foreach($users as $key => $user)
    <tr class="id{{$user->id}}">
        <td>{{ $key+1}}</td>
        <td>{{ $user->name }}</td>
        <td>
            <a href="{{route('role.user.to',$user->id)}}" class="btn btn-outline btn-circle green btn-sm purple">
                <i class="fa fa-edit"></i>Role
            </a>
        </td>
        <td>
            <a href="{{route('users.edit' ,$user->id)}}" class="btn btn-outline btn-circle green btn-sm purple">
                <i class="fa fa-edit"></i>Edit
            </a>
        </td>
        <td>
            <form method="POST" action="{{route('users.destroy',$user->id)}}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button data-id="{{$user->id}}" class="deleteRecord btn btn-danger btn btn-outline btn-circle dark btn-sm black">
                    <i class="fa fa-trash-o"></i>Delete
                </button>
            </form>
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="3" align="center">
        {!! $users->links() !!}
    </td>
</tr>
