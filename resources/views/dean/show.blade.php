<h2 class="sub-header">Uploded Documents</h2>
<table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Dean Id</th>
        <th>Email</th>
        <th>Created_At</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    @if (count($deans) > 0)
        @foreach ( $deans as $dean)
        <tr>
            <td>{{$dean->id}}</td>
            <td>{{$dean->auditor_id}}</td>
            <td><a>{{$dean->email}}</a></td>
            <td><a>{{$dean->created_at}}</a></td>
            <td><a class="btn btn-primary" href="/posts/{{$dean->id}}/edit">Edit</a></td>
            <td>
                <form method="POST" action="/dean/{{$dean->id}}">
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

