@foreach($activities as $key => $activity)
    <tr class="id{{$activity->id}}">
        <td>{{ $key+1}}</td>
        <td>{{ $activity->oneUser->name }}</td>
        <td>{{ $activity->action }}</td>
        <td>{{ $activity->text }}</td>
    </tr>
@endforeach
<tr>
    <td colspan="10" align="center">
        {!! $activities->links() !!}
    </td>
</tr>
