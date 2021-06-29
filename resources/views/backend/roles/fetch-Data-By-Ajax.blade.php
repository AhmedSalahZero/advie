@foreach($roles as $key => $role)
    <tr class="id{{$role->id}}">
        <td>{{ $key+1}}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a href="{{route('roles.edit' ,$role->id)}}" class="btn btn-outline btn-circle green btn-sm purple">
                <i class="fa fa-edit"></i>Edit
            </a>
        </td>
        <td>
            <form method="POST" action="{{route('roles.destroy',$role->id)}}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button data-id="{{$role->id}}" class="deleteRecord btn btn-danger btn btn-outline btn-circle dark btn-sm black">
                    <i class="fa fa-trash-o"></i>Delete
                </button>
            </form>
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="3" align="center">
        {!! $roles->links() !!}
    </td>
</tr>
