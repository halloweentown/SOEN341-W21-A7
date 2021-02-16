@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Updates</div>

                <div class="card-body">
                    <form action="{{route('home')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }} 
                        <textarea name="body" rows="3" cols="25" class="form-control" placeholder="Enter your caption here,upload your picture, then press submit!"></textarea>
                        <input type="file" name="image"/>
                        <input type="submit" name="upload" value="Upload"/>
                    </form>
                </div>
    
                

            </div>
        </div>
    </div>
</div>
@endsection
