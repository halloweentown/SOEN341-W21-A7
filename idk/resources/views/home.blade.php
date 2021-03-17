@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Updates</div>

                <div class="card-body">
                    <form  action="{{route('home')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        {{ csrf_field() }}
                        <textarea name="body" id="caption" rows="3" cols="25" class="form-control" placeholder="Enter your caption here,upload your picture, then press submit!"></textarea>
                        <input type="file" name="image"/>
                        <input type="submit" name="upload" value="Upload"/>

                        <script>
                            //get the text area element
                            //keypress event for when user presses a key
                            //add a function that keeps track of the input after a key is pressed
                            document.getElementById("caption").addEventListener("keypress", function(event){
                                //Split the words into different elements of an array when encountering at least one space character
                                var words = this.value.split(/\s+/);
                                //Get the number of words in that array
                                var numWords = words.length;
                                //Set the maximum number of words to write
                                var maxWords = 250;
                                //When maximum of words is exceeded
                                if(numWords > maxWords){
                                    //prevent further input
                                    event.preventDefault();
                                }
                            })
                        </script>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div align="center" style="position: relative; margin-top: 100px" >
        @foreach($posts as $post)
        <div>
            <div style="width:270px; display: inline-flex;">
                    <div class="card-title" align="left" style="position :relative;width:270px;padding-top: 5px">
                        <img src="{{$post['avatar']}}" style= "width: 30px; height: 30px; border-radius: 50%">
                        <b>{{$post['name']}}</b>
                    </div>

                    <div class="card-title" align="right" style="position :relative;width:270px;">
                        @if(!Auth::user()->isFollowing($post))
                            @if(Auth::user()->id === $post->userID)
                                <a href=""></a>
                            @else
                                <a href="{{ route('user.follow', $post->userID) }}" class="btn btn-success">Follow</a>
                            @endif

                        @elseif(Auth::user()->isFollowing($post))
                            <a href="{{ route('user.unfollow', $post->userID) }}" class="btn btn-danger">Unfollow</a>

                        @endif
                    </div>
            </div>
            <div class="card-img"><img src="/uploads/post/{{$post['image']}}" width="270px" height="480px"></div>
            <div class="card-text" align="left" style="position :relative;width:270px;margin-top: 1%; vertical-align: middle;"> <p><img src="{{$post['avatar']}}" style= "width: 20px; height: 20px; border-radius: 50%">   <b>{{$post['name']}}</b>  {{$post['caption']}}</p></div>
        </div>

        @foreach($comments as $comment)
            @if($post['id']==$comment['post_id'])

                    <div class="card-text" align="left" style="position :relative; width:270px;vertical-align: middle;"><p><img  src="{{$comment['avatar']}}" style= "width: 20px; height: 20px; border-radius: 50%; vertical-align: center;">   <b>{{$comment['user_name']}}</b>  {{$comment['text']}}</p></div>
            @endif
        @endforeach

        <div align = "center" style="position: relative; width:270px;margin-bottom: 100px">
            <form action="/comment" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div><textarea maxlength="300" name="body"  class="form-control" placeholder="Enter your comment here!"></textarea></div>
                <input type="hidden" name="postid" value="{{$post['id']}}">
                <div align = "right"><input type="submit" name="upload" value="Comment"/></div>
            </form>
        </div>

        @endforeach
    </div>
</div>
@endsection
