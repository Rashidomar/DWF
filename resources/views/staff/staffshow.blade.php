
<table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Staff Id</th>
        <th>Emaail</th>
        <th>Created_At</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    @if (count($staffs) > 0)
        @foreach ( $staffs as $staff)
        <tr>
            <td>{{$staff->id}}</td>
            <td>{{$staff->staff_id}}</td>
            <td><a>{{$staff->email}}</a></td>
            <td><a>{{$staff->created_at}}</a></td>
            <td><a class="btn btn-primary" href="/staff/{{$staff->id}}/edit">Edit</a></td>
            <td>
                <form method="POST" action="/staff/{{$staff->id}}">
                    @csrf
                    @method("delete")
                    <input type="submit" class="btn btn-danger" value="Delete">
                </form>
            </td>
        </tr>
        @endforeach
    @else
    </tbody>
        <p>There is no staff foundes</p>
    @endif
  </table>


