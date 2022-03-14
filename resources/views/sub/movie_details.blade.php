@extends("app")

@section("content")

<style>
.hide{
    display:none;
}
</style>

<div x-data="{video:false}" class="box" style="padding: 15px;" id="top">

    <div x-show="video" id = "vidconta" class="container video" style="padding-bottom: 20px;" >
        <video id="player" playsinline controls ratio="16:9">
                  
                   
        </video>
    </div>
    


    <div  class="container-fluid"
        style="border: 1px solid #122838; width: 100%; display: block;background-color: #0c1b26;">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="py-5 px-1 py-3">
                    <img src="{{$movie->poster}}" title="Movie Details" class="img-responsive rounded" alt=""
                        style="width: 100%" />

                </div>
            </div>
            <!-- <div class="col-lg-4 col-sm-12">

            </div> -->
            <div class="col-lg-4 col-sm-12" style="text-align:right">
                <div class="py-lg-5 p-3">
                    <h2>{{$movie->name}}</h2>





                    <h5 style="color:white;font-weight:700"> {{$movie->rate}}
                        <span class="brand" style="font-size:17px">IMDb</span>
                    </h5>

                    <h6 style="color: grey;font-size: 14px;">

                        {{$movie->year}} , {{getcategoryname($movie->moviecat_id ,App\Models\moviecat::all() )}}

                    </h6>
                    <p style="
                    font-size: 14px;
                    color: gray;
                ">
                       {{$movie->movietime}}
                    </p>

                    <p style="color:white;font-weight:700;font-size:14px">
                        {{$movie->desc}}
                    </p>

                    <p style="font-size: 14px;">المخرج :

                        {{$movie->director}}
                    </p>

                    <p>الممثلين :
                        {{$movie->actors}}
                    
                    </p>
                    <style>
                        .btncinema {
                            background-color: #c9170f;
                            padding: 10px 20px;
                            border-radius: 32px;
                            height: 48;
                            width: 144px;
                            color: #ffffff !important;
                        }

                        .favbtn {

                            padding: 10px 20px;
                            border-radius: 32px;
                            height: 48;
                            width: 144px;
                            color: #ffffff !important;
                            cursor: pointer;
                        }

                        .btn i {
                            top: 0;
                        }
                    </style>
                    <div class="row">
                        <div class="col-md-4">
                            <a  href="#top" class="btn btncinema" id="watchbtn" @click="video=true;player.play();setTimeout(function(){$('body').getNiceScroll().resize();},150)"> <i class="fa fa-play" ></i> شاهد </a>

                        </div>
                        <div class="col-md-1"> </div>
                        @guest
                        <div></div>
                        @else
                        <div class="col-md-4" >
                            @if($isfav ==1)
                          
                            <a  href="{{route('showmovieafterremovefav',$movie->id)}}" class="btn btncinema" id="watchbtn"> <i  ></i> ازالة  من  المفضلة </a>
@else 
<a  href="{{route('showmovieafteraddtofav',$movie->id)}}" class="btn btncinema" id="watchbtn"> <i class="fa fa-heart" ></i> اضافة للمفضلة </a>
@endif
                        </div>
          @endguest

                    </div>


                </div>
            </div>
            <div class="col-lg-5 py-lg-5 p-2 col-sm-12">
                <iframe width="100%" id="ds" height="100%" src="{{$movie->trailer}}" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
            
                
            
        </div>
    </div>

</div>


<div class="collection">
    <h4> <a href="">افلام ذات صلة</a> </h4>
  </div>

    <div class="container-fluid row">

    
  <div id="owl-demo" class="owl-carousel owl-theme">
   
   

    @for($i=0;$i<count($relatives);$i++)

    <div class="item">
        <a href="{{route('moviedetails',$relatives[$i]["id"])}}">


        
      <div class="image">
        <img src="{{$relatives[$i]["poster"]}}" style = "height:263px">
        <div class="middle">
        
          <button class="btn btn-danger" style="margin-top:50% !important" >
          <i class="fa fa-play"></i>
          شاهد الان
          </button>
        </div>
      </div>
    </a>
      
      <div class="row clearfix">
          <div class="col float-right">
            <span class="mvtitle">{{$relatives[$i]["name"]}}</span>
          </div>
          <div class="col-md-auto">
             <span class="brand">IMdb</span> {{$relatives[$i]["rate"]}}
          </div>
          <div class="col-12">
            <span class="mvsubtitle">{{$relatives[$i]["year"] == null? "  " : $relatives[$i]["year"]}} , {{getcategoryname($relatives[$i]["moviecat_id"] ,App\Models\moviecat::all())}}</span>
          </div>
        </div>

    </div>
    


    @endfor

  
    


   
    

  
    
  </div>
</div>



<!-- <div class="crew">
        <h5>الطاقم</h5>

        <div class="row">

            <div class="col-lg-3 col-md-3 col-sm-3">
                <img src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png"
                    width="50">
                Mohmmad Moatz
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3">
                <img src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png"
                    width="50">
                Ahmed Yousef
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12">
                <br>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3">
                <p>المخرج</p>
                <p style="color: white;">Hamed Sihatkm</p>
                <p style="color: white;">Wail ashrf</p>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3">
                <p>كاتب السيناريو</p>
                <p style="color: white;">Hamed Sihatkm</p>
                <p style="color: white;">Wail ashrf</p>
            </div>

        </div>


    </div> -->
@endsection


@section("script")

<script>
document.getElementById("ds").src =  "https://www.youtube.com/embed/" + document.getElementById("ds").src.substring(32);
 
    
    </script>

<script>
  
  
  var controls =
[
    'play-large', // The large play button in the center
    'restart', // Restart playback
    'rewind', // Rewind by the seek time (default 10 seconds)
    'play', // Play/pause playback
    'fast-forward', // Fast forward by the seek time (default 10 seconds)
    'progress', // The progress bar and scrubber for playback and buffering
    'current-time', // The current time of playback
    'duration', // The full duration of the media
    'mute', // Toggle mute
    'volume', // Volume control
    'captions', // Toggle captions
    'settings', // Settings menu
    'pip', // Picture-in-picture (currently Safari only)
    'airplay', // Airplay (currently Safari only)
    'download', // Show a download button with a link to either the current source or a custom URL you specify in your options
    'fullscreen' // Toggle fullscreen
];

var player = new Plyr('#player', { controls });
    player.source = {
       
  type: 'video',
  title: "{{$movie->name}}",
  sources: [
    {
      src: "{{$movie->url}}",
      type: 'video/mp4',
      size: 720,
    },
    
  ],
  
  tracks: [
    {
        
      kind: 'captions',
      label: 'English',
      srclang: 'en',
      src: '/path/to/captions.en.vtt',
      default: true,
    },
    {
      kind: 'captions',
      label: 'عربي',
      srclang: 'ar',
      src: '{{$movie->vvt}}',
    },
  ],
};
</script>

@endsection