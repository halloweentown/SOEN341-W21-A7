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
                        <textarea name="body" id="caption" rows="3" cols="25" class="form-control" placeholder="Enter your caption here,upload your picture, then press submit!"></textarea>
                        <input type="file" name="image"/>
                        <input type="submit" name="upload" value="Upload"/>
                        <div id="submit"></div>
                        <!--- <script src="{{asset('js/app.js')}}"></script> ---->
                        <script type="text/javascript">
                            //get the text area element
                            //keypress event for when user presses a key
                            //add a function that keeps track of the input after a key is pressed
                            document.getElementById("caption").addEventListener("keypress", function(event){
                                //Split the words into different elements of an array when encountering at least one space character
                                var words = this.value.split(/\s+/);
                                //Get the number of words in that array
                                var numWords = words.length;
                                //Set the maximum number of words to write
                                var maxWords = 5;
                                //When maximum of words is exceeded
                                if(numWords > maxWords){
                                    //prevent further input
                                    event.preventDefault();
                                }
                            });
                        </script>
                    </form>
                </div>



            </div>
        </div>
    </div>

    @foreach($posts as $post)
    <div>
        <b>{{$post['name']}}</b>
        <p>{{$post['image']}}</p>
        <p>{{$post['caption']}}</p>
    </div>
    @endforeach
</div>
@endsection
