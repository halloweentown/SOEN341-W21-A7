@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div  class="d-inline-flex" align="center">

                    <div class="col-3 pl-6">
                        <img src="/{{$user->avatar}}" style= "width: 100px; height: 100px; border-radius: 50%">
                    </div>
                 <div>
                    <div class="row col-9 d-inline-flex">
                        <div><h1>{{$user->name}}</h1></div>

                        <!-- This sequence of ifelse statements control whether the user sees nothing, or  a follow button, or am unfollow button. It will be positionned at the top
                         of the user's page.-->
                        <div class="pl-4">
                            @if(!Auth::user()->isFollowingUser($user))
                                @if(Auth::user()->id === $user->id)
                                    <a href=""></a>
                                @else
                                    <a href="{{ route('user.follow', $user->id) }}" class="btn btn-success">Follow</a>
                                @endif

                            @elseif(Auth::user()->isFollowingUser($user))
                                <a href="{{ route('user.unfollow', $user->id) }}" class="btn btn-danger">Unfollow</a>

                            @endif
                        </div>
                    </div>


                    <div class="row col-9 d-inline-flex pt-2">

                        <!-- This set of if else statements is used to display the amount of people follow the user as well as how many people the user is following.-->
                        @if($user->followers->count() > 1 )
                            <div class="pr-2">{{$user->followers->count()}} <a data-toggle="modal" data-target="#Followers">Followers</a></div>
                        @else
                            <div class="pr-2">{{$user->followers->count()}} <a data-toggle="modal" data-target="#Followers">Follower</a></div>
                        @endif
                        <div class="pr-2">{{$user->following->count()}} <a data-toggle="modal" data-target="#Following">Following</a></div>


                                <!-- Modal -->
                                <div class="modal fade" id="Followers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <h4 class="modal-title" id="myModalLabel">Followers</h4>
                                                <!-- A button that will open and close a portion of text-->
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- If the button above is turned on, the names of the followers will appear on the screen.-->
                                                @foreach($user->followers as $follower)
                                                    <div>{{$follower->name}}</div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <div class="modal fade" id="Following" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <h4 class="modal-title" id="myModalLabel">Following</h4>
                                            <!-- A button that will open and close a portion of text-->
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- If the button above is turned on, the names of the the people that this user is following will appear. -->
                                            @foreach($user->following as $follow)
                                                <div>{{$follow->name}}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>


                    </div>
                 </div>

            </div>

        </div>
    </div>

        <div class="row-cols-12" align="center" style="position: relative; margin-top: 100px" >
            <!-- The foreach loop here works similarly to the foreach loop on the home.blade file. It will show all of the user's posts, however, user's will not be able to
            comment on the posts.-->
            @foreach($posts as $post)
                <div class="d-inline-flex">

                    @if($post->userID === $user->id)
                        <div class="col-4"><img src="/uploads/post/{{$post['image']}}" style="width:270px; height:360px; object-fit: inherit;"></div>
                    @endif
                </div>


            @endforeach
        </div>
    </div>
@endsection
