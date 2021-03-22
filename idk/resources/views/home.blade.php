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

            <div class="card-title" align="left" style="position :relative;width:500px; display:flex">
                <img src="{{$post['avatar']}}" style= "width: 30px; height: 30px; border-radius: 50%">

                <form action="/userpage" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="username" value="{{$post['name']}}">
                    <input type="submit" name="url" value="{{$post['name']}}">
                </form>
                
                <!-- <b>{{$post['name']}}</b> -->

                <?php
                    foreach($follows as $follow){
                        $foo = FALSE;
                    if($follow['beingfollowed']==$post['name'] && $follow['following']==Auth::user()->name){
                        $foo=TRUE; 
                        break;
                    } 
                    }

                    if($post['name']==Auth::user()->name){

                    }elseif($foo){
                       
                        
                        echo '&nbsp&nbsp Following';
                        
                        
                    }else{
                        echo'<form action="/follow" method="POST">';
                        echo '<input type="hidden" name="_token" value="'.Session::token().'">';
                        echo '<input type="hidden" name="postname" value="'.$post['name'].'">';
                        echo '<input type="submit" value="Follow!" style="margin-left: 15px; background-color: #0095f6; font-weight: bold; border: none;
                        border-radius: 0.5em; padding: 5px 12px; color: white;cursor: pointer;"> ';
                        echo '</form>';
                    }
                ?>
                
                
               
               
                
                
               
            </div>
            <div class="card-img"><img src="/uploads/post/{{$post['image']}}" width="500px"></div>
            <div class="card-text" align="left" style="position :relative;width:500px;margin-top: 1%; vertical-align: middle;"> <p><img src="{{$post['avatar']}}" style= "width: 20px; height: 20px; border-radius: 50%">   <b>{{$post['name']}}</b>  {{$post['caption']}}</p></div>
        </div>

        @foreach($comments as $comment)
            @if($post['id']==$comment['post_id'])

                    <div class="card-text" align="left" style="position :relative; width:500px;vertical-align: middle;"><p><img  src="{{$comment['avatar']}}" style= "width: 20px; height: 20px; border-radius: 50%; vertical-align: center;">   <b>{{$comment['user_name']}}</b>  {{$comment['text']}}</p></div>
            @endif
        @endforeach

        <div align = "center" style="position: relative; width:500px;margin-bottom: 100px">
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
