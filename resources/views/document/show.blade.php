@extends('layout/master')

@section('title')
    Post Details
@endsection

@section('content')
        <a href="/posts" class="btn btn-primary">Go Back</a>
        <hr>
        <div class="well">
           <h3>{{$document->description}}</h3>
           <img style="width:100%"  src="/storage/cover_images/{{$document->name}}">
           <hr>
           <small>Uploaded At :{{$document->created_at}}</small>
           <br>
           <br>
           <small>Posted by {{$document->staff->staff_id}}</small>
           <br>
           <br>
        </div>
        @if(Auth::guard('auditor')->check())
             <a href="{{url('/inbox/registrar/')}}/{{$document->id}}/{{auth()->user()->auditor_id}}/{{$document->staff->staff_id}}" class="btn btn-primary">Approve</a>
             {{-- <a href="#" class="pull-right btn btn-danger">Disapprove</a> --}}
        @elseif(Auth::guard('registrar')->check())
            <a href="{{url('/inbox/dean')}}/{{$document->id}}/{{$document->staff->staff_id}}/{{auth()->user()->registrar_id}}" class="btn btn-primary">Approve</a>
            {{-- <a href="#" class="pull-right btn btn-danger">Disapprove</a> --}}
        @elseif(Auth::guard('dean')->check())
            <a href="{{url('/message/approved')}}/{{$document->id}}/{{$document->staff->staff_id}}" class="btn btn-primary">Approve</a>
            <a href="{{url('/message/disapproved')}}" class="pull-right btn btn-danger">Disapprove</a>
        @endif
@endsection
