@extends('layouts.app')


@section('content')





<div align="center" style="position: relative; margin-top: 100px" >

        <?php 
        echo $usernametoview;
        ?>

        @foreach($posts as $post)
        @if($post['name']==$usernametoview)
        
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
                            echo'<form action="/followup" method="POST">';
                            echo '<input type="hidden" name="_token" value="'.Session::token().'">';
                            echo '<input type="hidden" name="username" value="'.$post['name'].'">';
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
                <form action="/commentup" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="username" value="{{$post['name']}}">
                    <div><textarea maxlength="300" name="body"  class="form-control" placeholder="Enter your comment here!"></textarea></div>
                    <input type="hidden" name="postid" value="{{$post['id']}}">
                    <div align = "right"><input type="submit" name="upload" value="Comment"/></div>
                </form>
            </div>
        @endif               
        @endforeach
    </div>




@endsection