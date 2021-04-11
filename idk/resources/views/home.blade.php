@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Updates</div>

                <div class="card-body">
                    <!-- This form is filled when the user wants to post a picture. The form takes in a caption and an image.-->
                    <form  action="{{route('home')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        {{ csrf_field() }}
                        <textarea name="body" id="caption" rows="3" cols="25" class="form-control" placeholder="Enter your caption here,upload your picture, then press submit!"></textarea>
                        <input type="file" name="image"/>
                        <input type="submit" name="upload" value="Upload"/>

                        <!-- This script limits the amount of words that the user can put in their caption you can have to 200 words. -->
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

        <!-- This is a foreach loop which will be used to diplay the posts, an array of posts got sent during the route which is how we have access to it.-->
        @foreach($posts as $post)
        <div>
            <div style="width:270px; display: inline-flex;">
                    <!-- This displays the user's username over a post, it is also used as a link so that we can be redirected to the user's page.-->
                    <div class="card-title" align="left" style="position :relative;width:270px;padding-top: 5px">
                        <img src="{{$post['avatar']}}" style= "width: 30px; height: 30px; border-radius: 50%">
                        <a href="{{ route('profile.page', $post->userID) }}"><b>{{$post['name']}}</b></a>
                    </div>

                    <!-- This part is for the following button, if you are viewing your post, it doesn't appear, if you are unfollowing you can unfollow,
                    and if you aren't following you can follow.-->
                    <div class="card-title" align="right" style="position :relative;width:270px;">
                        @if(!Auth::user()->isFollowing($post))
                            <!-- This is if you are viewing your own post.-->
                            @if(Auth::user()->id === $post->userID)
                                <a href=""></a>
                            @else
                            <!-- This is if you view a post from someone you aren't following.-->
                                <a href="{{ route('user.follow', $post->userID) }}" class="btn btn-success">Follow</a>
                            @endif

                        <!-- This is if you are following the person, the button will allow you to unfollow the user.-->
                        @elseif(Auth::user()->isFollowing($post))
                            <a href="{{ route('user.unfollow', $post->userID) }}" class="btn btn-danger">Unfollow</a>

                        @endif
                    </div>
            </div>
            <div class="card-img"><img src="/uploads/post/{{$post['image']}}" style="width:270px; height:360px; object-fit: inherit;"></div>
            <div class="card-text" align="left" style="position :relative;width:270px;margin-top: 1%; vertical-align: middle;"> <p><img src="{{$post['avatar']}}" style= "width: 20px; height: 20px; border-radius: 50%">   <b>{{$post['name']}}</b>  {{$post['caption']}}</p></div>
        </div>

        <!-- This takes an array of comments attributed to the post so that they can be displayed.-->
        @foreach($comments as $comment)
            @if($post['id']==$comment['post_id'])
                    <!-- The comment will display alongside the username of the commenter as well as their profile picture.-->
                    <div class="card-text" align="left" style="position :relative; width:270px;vertical-align: middle;"><p><img  src="{{$comment['avatar']}}" style= "width: 20px; height: 20px; border-radius: 50%; vertical-align: center;">   <b>{{$comment['user_name']}}</b>  {{$comment['text']}}</p></div>
            @endif
        @endforeach

        <div align = "center" style="position: relative; width:270px;margin-bottom: 100px">
            <!-- Every post will have a button to comment. The user can only input text for this.-->
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
