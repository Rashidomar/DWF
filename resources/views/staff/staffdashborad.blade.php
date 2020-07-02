@extends('layout/master')

@section('title')
    Dashboard
@endsection

@section('content')
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Project name</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="/">Dashboard</a></li>
          @if (Auth::check())
            {
                <li><a href="#"> Hello {{ auth()->user()->staff_id }}</a></li>
            }
          @endif
          <li><a href="#">Profile</a></li>
          <li><a href="/staff/logout">logout</a></li>
        </ul>
        <form class="navbar-form navbar-right">
          <input type="text" class="form-control" placeholder="Search...">
        </form>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
          <li class="active"><a href="#">Staff<span class="sr-only">(current)</span></a></li>
          <li><a href="/document/create">Upload New Document</a></li>
          <li><a id="load_approved" href="#">Approved Document</a></li>
          <li><a id="load_disapproved" href="#">Disapproved Document</a></li>
        </ul>
      </div>
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Dashboard</h1>

        <h2 class="sub-header">Uploded Documents</h2>
        <div  id="content" class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Description</th>
                <th>Document</th>
                <th>Uploaded_At</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
            @if (count($documents) > 0)
                @foreach ( $documents as $document)
                <tr>
                    <td>{{$document->id}}</td>
                    <td>{{$document->description}}</td>
                    <td><a href="/document/{{$document->id}}">{{$document->name}}</a> </td>
                    <td>{{$document->created_at}}</td>
                    <td>
                        <form method="POST" action="/document/{{$document->id}}">
                            @csrf
                            @method("delete")
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                    </td>
                </tr>
                @endforeach
            @else
            </tbody>
                <p>There is no documents posted</p>
            @endif
          </table>
        </div>
      </div>
    </div>
  </div>
  @section('script')
  <script>
      $(document).ready(function () {
            $('#load_approved').click(function (e) {
            e.preventDefault();
            $('#content').load('{{url('/message/approved')}}');
            });

            $('#load_disapproved').click(function (e) {
            e.preventDefault();
            $('#content').load('{{url('/message/disapproved')}}');
            });
        });
      </script>
@endsection
