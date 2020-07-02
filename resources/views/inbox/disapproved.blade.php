
<table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Staff_id</th>
        <th>Document_id</th>
        <th>message</th>
        <th>document Name</th>
        <th>Approved at</th>
      </tr>
    </thead>
    <tbody>
    @auth
    @if (count($approves) > 0)
        @foreach ( $approves as $approve)
        @if((auth()->user()->staff_id ) == $approve->staff_id)
        <tr>
            <td>{{$approve->id}}</td>
            <td>{{$approve->staff_id}}</td>
            <td>{{$approve->document_id}}</td>
            <td>{{$approve->message}}</td>
            <td>
                @inject('document', 'App\Document')
                {{$document::find($approve->document_id)->name}}
           </td>
            <td>{{$approve->created_at}}</td>
        </tr>
        @endif
        @endforeach
    @else
    </tbody>
        <p>There is no document disapproved</p>
    @endif
    @endauth
  </table>

