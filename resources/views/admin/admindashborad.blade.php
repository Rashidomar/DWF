@extends('layout/master')

@section('title')
    Admin Dashboard
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
        @auth
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Dashboard</a></li>
          <li><a href="#">Hello {{ auth()->user()->username }}</a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="/admin/logout">logout</a></li>
        </ul>
        @endauth
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
          <li><a href="/staff/register">New Staff</a></li>
          <li><a id="view_staff" href="#">View Staffs</a></li>
          {{-- <li><button class="btn btn default" id="view_staff" >View Staffs</button></li> --}}
        </ul>
        <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Auditor</a></li>
            <li><a href="/auditor/register">Add Auditor</a></li>
            <li><a id="view_auditor" href="#">View Auditors</a></li>
          </ul>
        <ul class="nav nav-sidebar">
          <li class="active"><a href="#">Registrar</a></li>
          <li><a href="/registrar/register">Add Registrar</a></li>
          <li><a id="view_registrar" href="#">View Registrars</a></li>
        </ul>
        <ul class="nav nav-sidebar">
          <li class="active"><a href="#">Dean</a></li>
          <li><a href="/dean/register">Add Dean</a></li>
          <li><a id="view_dean" href="#">View Deans</a></li>
        </ul>
      </div>
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div id="content" class="table-responsive">
        <h2 class="sub-header">Uploded Documents</h2>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Description</th>
                <th>Document</th>
                <th>Uploaded_At</th>
                <th>Created By</th>
              </tr>
            </thead>
            <tbody>
            @if (count($documents) > 0)
                @foreach ( $documents as $document)
                <tr>
                    <td>{{$document->id}}</td>
                    <td>{{$document->description}}</td>
                    <td><a href="/document/{{$document->id}}">{{$document->name}}</a></td>
                    <td>{{$document->created_at}}</td>
                    <td>{{$document->staff->staff_id}}</td>
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
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#view_staff').click(function (e) {
            e.preventDefault();
            $('#content').load('{{url('/staff/staffshow')}}');

            });

            $('#view_auditor').click(function (e) {
            e.preventDefault();
            $('#content').load('{{url('/auditor/show')}}');

            });
            $('#view_registrar').click(function (e) {
            e.preventDefault();
            $('#content').load('{{url('/registrar/show')}}');

            });
            $('#view_dean').click(function (e) {
            e.preventDefault();
            $('#content').load('{{url('/dean/show')}}');

            });
        });
    </script>
@endsection

