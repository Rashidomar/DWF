@extends('layout/master')

@section('title')
    Edit
@endsection

@section('content')
        <div class="container col-md-9 col-md-offset-1">
            <div class="well well bs-component">
                <form class="form-horizontal" method="post" action="/staff/{{$post->id}}/edit">
                    @csrf
                     @method("put")
                    <fieldset>
                        <legend>Edit Staff Details</legend>
                        <div class="form-group">
                            <label for="title" class="col-lg-2 control-label">Staff Id</label>
                            <div class="col-lg-10">
                                <input  type="text" class="form-control" name="staff_id" value="{{$staff->staff_id}}">
                            </div>
                        </div>
                        <legend>Edit Staff Details</legend>
                        <div class="form-group">
                            <label for="title" class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-10">
                                <input  type="text" class="form-control" name="email" value="{{$staff->email}}">
                            </div>
                        </div>
                        <legend>Edit Staff Details</legend>
                        <div class="form-group">
                            <label for="title" class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-10">
                                <input  type="text" class="form-control" name="title" value="{{$staff->password}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <a href="#" class="btn btn-default">Canell</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
@endsection
