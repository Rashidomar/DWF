@extends('layout/master')

@section('title')
    LogIn Page
@endsection

@section('content')
        <div class="container col-md-9 col-md-offset-1">
            <div class="well well bs-component">
                <form class="form-horizontal" method="post" action="/auditor/login_auditor">
                    @csrf
                    <fieldset>
                        <legend>Auditor LogIn</legend>
                        <div class="form-group">
                            <label for="title" class="col-lg-2 control-label">Auditor Id</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Auditor Id" name="auditor_id" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="Password" name="password" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary">Log In</button>
                                {{-- <a href="/user/signup" class="pull-right btn btn-default">Sign Up</a> --}}
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
@endsection
