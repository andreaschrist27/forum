@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a New Thread</div>

                <div class="card-body">
                    <form action="/threads" method="post">
                        @csrf
                       <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="title"></input>
                       </div> 
                       <div class="form-group">
                            <label for="body">Body:</label>
                            <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
                       </div>

                       <button type="submit" class="btn btn-default">Publish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
