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

    @foreach($posts as $post)
    <div>
        <b>{{$post['name']}}</b>
        <img  src="{{asset('/uploads/post/'.$post->image)}}">
        <p>{{$post['caption']}}</p>
        <p>Comments:</p>
        
    </div>

    @foreach($comments as $comment)
        @if($post['id']==$comment['post_id'])
            <b>{{$comment['user_name']}}:</b>
            <p>{{$comment['text']}}</p>
        @endif
    @endforeach

    <div>
    <form action="/comment" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }} 
                        <textarea name="body" rows="1" cols="1" class="form-control" placeholder="Enter your comment here!"></textarea>
                        <input type="hidden" name="postid" value="{{$post['id']}}">
                        <input type="submit" name="upload" value="Comment"/>
    </form>
    </div>
    @endforeach
</div>
@endsection
