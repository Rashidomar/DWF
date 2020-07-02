<table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Staff_id</th>
        <th>message</th>
        <th>document Name</th>
        <th>Upload at</th>
      </tr>
    </thead>
    <tbody>
    @if (count($inboxs) > 0)
        @foreach ( $inboxs as $inbox)
        <tr>
            <td>{{$inbox->id}}</td>
            <td>{{$inbox->staff_id}}</td>
            <td>{{$inbox->message}}</td>
            <td><a href="/document/{{$inbox->document_id}}">{{$inbox->document_name}}</a></td>
            <td>{{$inbox->created_at}}</td>
        </tr>
        @endforeach
    @else
    </tbody>
        <p>There is no documents posted</p>
    @endif
  </table>
