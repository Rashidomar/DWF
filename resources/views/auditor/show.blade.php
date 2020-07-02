<h2 class="sub-header">Uploded Documents</h2>
<table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Auditor Id</th>
        <th>Emaail</th>
        <th>Created_At</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    @if (count($auditors) > 0)
        @foreach ( $auditors as $auditor)
        <tr>
            <td>{{$auditor->id}}</td>
            <td>{{$auditor->auditor_id}}</td>
            <td><a>{{$auditor->email}}</a></td>
            <td><a>{{$auditor->created_at}}</a></td>
            <td><a class="btn btn-primary" href="/posts/{{$auditor->id}}/edit">Edit</a></td>
            <td>
                <form method="POST" action="/auditor/{{$auditor->id}}">
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

