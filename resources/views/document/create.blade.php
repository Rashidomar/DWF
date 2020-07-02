@extends('layout/master')

@section('title')
    Post Create
@endsection

@section('content')
        <a href="/posts" class="btn btn-primary">Go Back</a>
        <div class="container col-md-9   col-md-offset-1    ">
            <div class="well well bs-component">
                <form class="form-horizontal" method="post" action="/document" enctype="multipart/form-data">
                    @csrf
                    {{-- @method("put") --}}
                    <fieldset>
                        <legend>Upload Your document</legend>
                        <div class="form-group">
                            <label for="title" class="col-lg-4 control-label">Choose your document</label>
                            <div class="col-lg-8">
                                <input type="file" placeholder="Choose your document" name="document_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-lg-4 control-label">File Description</label>
                            <div class="col-lg-8">
                                <textarea class="form-control" rows="3" name="description"></textarea>
                                <span class="help-block">Name_content</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button class="btn btn-default">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
@endsection
