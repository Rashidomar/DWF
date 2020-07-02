<h2 class="sub-header">Uploded Documents</h2>
<table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Registrar Id</th>
        <th>Email</th>
        <th>Created_At</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    @if (count($registrars) > 0)
        @foreach ( $registrars as $registrar)
        <tr>
            <td>{{$registrar->id}}</td>
            <td>{{$registrar->registrar_id}}</td>
            <td><a>{{$registrar->email}}</a></td>
            <td><a>{{$registrar->created_at}}</a></td>
            <td><a class="btn btn-primary" href="/posts/{{$registrar->id}}/edit">Edit</a></td>
            <td>
                <form method="POST" action="/document/{{$registrar->id}}">
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

