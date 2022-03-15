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
  
  const controls = `
  <div class="plyr__controls"><button class="plyr__controls__item plyr__control" type="button" data-plyr="play" aria-label="Play, View From A Blue Moon"><svg class="icon--pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-pause"></use></svg><svg class="icon--not-pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-play"></use></svg><span class="label--pressed plyr__tooltip">Pause</span><span class="label--not-pressed plyr__tooltip">Play</span></button><div class="plyr__controls__item plyr__progress__container"><div class="plyr__progress"><input data-plyr="seek" type="range" min="0" max="100" step="0.01" value="0" autocomplete="off" role="slider" aria-label="Seek" aria-valuemin="0" aria-valuemax="183.126" aria-valuenow="0" id="plyr-seek-8357" aria-valuetext="00:00 of 00:00" style="--value:0%;" seek-value="32.17065436725281"><progress class="plyr__progress__buffer" min="0" max="100" value="3.892948024857202" role="progressbar" aria-hidden="true">% buffered</progress><span class="plyr__tooltip" hidden="" style="left: 28.2502%;">00:51</span><div class="plyr__preview-thumb" style="left: 37px;"><div class="plyr__preview-thumb__image-container" style="height: 112px; width: 199px;"><img src="https://cdn.plyr.io/static/demo/thumbs/100p-00002.jpg" data-index="58" data-filename="100p-00002.jpg" style="height: 784px; width: 1395.52px; left: -398.72px; top: -112px;"></div><div class="plyr__preview-thumb__time-container"><span>00:58</span></div></div></div></div><div class="plyr__controls__item plyr__time--current plyr__time" aria-label="Current time">03:03</div><div class="plyr__controls__item plyr__volume"><button type="button" class="plyr__control" data-plyr="mute"><svg class="icon--pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-muted"></use></svg><svg class="icon--not-pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-volume"></use></svg><span class="label--pressed plyr__tooltip">Unmute</span><span class="label--not-pressed plyr__tooltip">Mute</span></button><input data-plyr="volume" type="range" min="0" max="1" step="0.05" value="1" autocomplete="off" role="slider" aria-label="Volume" aria-valuemin="0" aria-valuemax="100" aria-valuenow="100" id="plyr-volume-8357" aria-valuetext="100.0%" style="--value:100%;"></div><button class="plyr__controls__item plyr__control plyr__control--pressed" type="button" data-plyr="captions"><svg class="icon--pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-captions-on"></use></svg><svg class="icon--not-pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-captions-off"></use></svg><span class="label--pressed plyr__tooltip">Disable captions</span><span class="label--not-pressed plyr__tooltip">Enable captions</span></button><div class="plyr__controls__item plyr__menu"><button aria-haspopup="true" aria-controls="plyr-settings-8357" aria-expanded="false" type="button" class="plyr__control" data-plyr="settings"><svg aria-hidden="true" focusable="false"><use xlink:href="#plyr-settings"></use></svg><span class="plyr__tooltip">Settings</span></button><div class="plyr__menu__container" id="plyr-settings-8357" hidden=""><div><div id="plyr-settings-8357-home"><div role="menu"><button data-plyr="settings" type="button" class="plyr__control plyr__control--forward" role="menuitem" aria-haspopup="true"><span>Captions<span class="plyr__menu__value">English</span></span></button><button data-plyr="settings" type="button" class="plyr__control plyr__control--forward" role="menuitem" aria-haspopup="true"><span>Quality<span class="plyr__menu__value">576p</span></span></button><button data-plyr="settings" type="button" class="plyr__control plyr__control--forward" role="menuitem" aria-haspopup="true"><span>Speed<span class="plyr__menu__value">Normal</span></span></button></div></div><div id="plyr-settings-8357-captions" hidden=""><button type="button" class="plyr__control plyr__control--back"><span aria-hidden="true">Captions</span><span class="plyr__sr-only">Go back to previous menu</span></button><div role="menu"><button data-plyr="language" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="-1"><span>Disabled</span></button><button data-plyr="language" type="button" role="menuitemradio" class="plyr__control" aria-checked="true" value="0"><span>English<span class="plyr__menu__value"><span class="plyr__badge">EN</span></span></span></button><button data-plyr="language" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="1"><span>Français<span class="plyr__menu__value"><span class="plyr__badge">FR</span></span></span></button></div></div><div id="plyr-settings-8357-quality" hidden=""><button type="button" class="plyr__control plyr__control--back"><span aria-hidden="true">Quality</span><span class="plyr__sr-only">Go back to previous menu</span></button><div role="menu"><button data-plyr="quality" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="1080"><span>1080p<span class="plyr__menu__value"><span class="plyr__badge">HD</span></span></span></button><button data-plyr="quality" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="720"><span>720p<span class="plyr__menu__value"><span class="plyr__badge">HD</span></span></span></button><button data-plyr="quality" type="button" role="menuitemradio" class="plyr__control" aria-checked="true" value="576"><span>576p<span class="plyr__menu__value"><span class="plyr__badge">SD</span></span></span></button></div></div><div id="plyr-settings-8357-speed" hidden=""><button type="button" class="plyr__control plyr__control--back"><span aria-hidden="true">Speed</span><span class="plyr__sr-only">Go back to previous menu</span></button><div role="menu"><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="0.5"><span>0.5×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="0.75"><span>0.75×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="true" value="1"><span>Normal</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="1.25"><span>1.25×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="1.5"><span>1.5×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="1.75"><span>1.75×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="2"><span>2×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="4"><span>4×</span></button></div></div></div></div></div><button class="plyr__controls__item plyr__control" type="button" data-plyr="pip"><svg aria-hidden="true" focusable="false"><use xlink:href="#plyr-pip"></use></svg><span class="plyr__tooltip">PIP</span></button><button class="plyr__controls__item plyr__control" type="button" data-plyr="fullscreen"><svg class="icon--pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-exit-fullscreen"></use></svg><svg class="icon--not-pressed" aria-hidden="true" focusable="false"><use xlink:href="#plyr-enter-fullscreen"></use></svg><span class="label--pressed plyr__tooltip">Exit fullscreen</span><span class="label--not-pressed plyr__tooltip">Enter fullscreen</span></button></div>
`;

  var controls2 =
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
// var player = Plyr.setup('#player', {
// 	debug: 		true,
// 	title: 		'Video demo',
// 	tooltips: 	true,
// 	html: 		controls,
// });

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