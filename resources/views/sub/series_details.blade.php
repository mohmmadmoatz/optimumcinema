@extends("app")

@section("content")

<div class="box" style="padding: 15px;">

    @if($epi)
   
    @php
    $index = $episodes->search(function($epo) use($epi){
    return $epo->id === $epi->id;
    });


    $length = count($episodes);


    if($index == $length -1){
        $nextEpiIndex ="";

    }else{
        $nextEpiIndex =route('playepi',[$series->id,$episodes[$index + 1]->id])  . "?season=" . $episodes[$index + 1]->season_id;


    }
    if($index >0)
    $prvEpiIndex =route('playepi',[$series->id,$episodes[$index - 1]->id]). "?season=" . $episodes[$index - 1]->season_id;
    else
    $prvEpiIndex = "";
    @endphp

    <div  class="container video" style="padding-bottom: 20px;" >
        <video id="player" playsinline controls ratio="16:9"   @if($epi) autoplay @endif>
                  
                   
        </video>
    </div>
    @endif

    <div class="container-fluid"
        style="border: 1px solid #122838; width: 100%; display: block;background-color: #0c1b26;">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="py-5 px-1 py-3">
                    <img src="{{$series->poster}}"
                        title="Movie Details" class="img-responsive rounded" alt="" style="width: 100%" />

                </div>
            </div>
            <!-- <div class="col-lg-4 col-sm-12">

            </div> -->
            <div class="col-lg-4 col-sm-12" style="text-align:right">
                <div class="py-lg-5 p-3">
                    <h2>{{$series->name}}</h2>





                    <h5 style="color:white;font-weight:700"> {{$series->series_rate}}
                        <span class="brand" style="font-size:17px">IMDb</span>
                    </h5>

                    <h6 style="color: grey;font-size: 14px;">
                        {{$series->year}} , {{getcategoryname($series->series_cat ,App\Models\moviecat::all() )}}
                        

                    </h6>
                    <p style="
                    font-size: 14px;
                    color: gray;
                ">
                {{count($seasons)}}
                         مواسم
                    </p>

                    <p style="color:white;font-weight:700;font-size:14px">
                       {{$series->series_desc}}
                    </p>

                    <p style="font-size: 14px;">المخرج :

                        <a href="#">{{$series->director}}</a>
                    </p>

                    <p>الممثلين :

                     <a href="#">{{$series->actor}}</a>
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
                            <button class="btn btncinema"> <i class="fa fa-play"></i> شاهد </button>

                        </div>
                        @guest
                        <div></div>
                        @else
                        <div class="col-md-1" ></div>
                        <div class="col-md-4" >
                            @if($isfav ==1)
                          
                            <a  href="{{route('removeserisefav',$series->id)}}" class="btn btncinema" id="watchbtn"> <i  ></i> ازالة  من  المفضلة </a>
@else 
<a  href="{{route('addseriesfav',$series->id)}}" class="btn btncinema" id="watchbtn"> <i class="fa fa-heart" ></i> اضافة للمفضلة </a>
@endif
                        </div>
          @endguest
                        
                    </div>


                </div>
            </div>
            <div class="col-lg-5 py-lg-5 p-2 col-sm-12">
                <iframe width="100%" height="100%" src="{{$series->trailer}}" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>


<div class="season">

    <ul class="nav nav-tabs">
        <h5 style="margin-left: 10px;margin-top: 10px;">المواسم</h5>

        @foreach ($seasons as $item)
            <li class="nav-item">
            <a class="nav-link {{$selectedseason == $item->id ? 'active' : ''}}" href="#" onclick="addparam('season',{{$item->id}})">{{$item->name}}</a>
        </li>
        @endforeach
        
       
    </ul>

    
    <style>
        .selected{
            border:red 1px solid !important;
        }
    </style>
    <div id="owl-demo" class="owl-carousel owl-theme">
        @foreach($episodes as $item)

        <a href="{{route('playepi',[$series->id,$item->id])}}?season={{$item->season_id}}">
        <div style="padding:10px;">
            <img @isset($epi) @if($epi->id == $item->id) class="selected" @endif @endisset src="{{$series->poster}}" 
                style="border-radius: 16px;height: 120px;max-height: 100%;
                border: 1px solid;">

            <div class="row">
                <div class="col">الحلقة {{$item->name}}</div>
             

            </div>

        </div>
    </a>

        @endforeach

    </div>

</div>


<div class="collection">
    <h4> <a href="">المسلسلات ذات الصلة</a> </h4>
  </div>

    <div class="container-fluid row">

    
  <div id="owl-demo" class="owl-carousel owl-theme">
   
   

    @for($i=0;$i<count($seriess);$i++)

    <div class="item">
        <a href="{{route('seriesdetails',$seriess[$i]["id"])}}">


        
      <div class="image">
        <img src="{{$seriess[$i]["poster"]}}" style = "height:263px">
        <div class="middle">
        
          <button class="btn btn-danger" style="margin-top:50% !important">
          <i class="fa fa-play"></i>
          شاهد الان
          </button>
        </div>
      </div>
    </a>
      
      <div class="row clearfix">
          <div class="col float-right">
            <span class="mvtitle">{{$seriess[$i]["name"]}}</span>
          </div>
          <div class="col-md-auto">
             <span class="brand">IMdb</span> {{$seriess[$i]["rate"]}}
          </div>
          <div class="col-12">
            <span class="mvsubtitle">{{$seriess[$i]["year"] == null? "  " : $seriess[$i]["year"]}} , {{getcategoryname( $seriess[$i]["series_cat"] ,$cats )}}</span>
          </div>
        </div>

    </div>
    


    @endfor

  
    


   
    

  
    
  </div>
</div>




<!-- 
<div class="crew">
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

var url = new URL(location.href);

function addparam(key,value){
  url.searchParams.set(key,value);
  window.location = url.href
}



function incSub() {
    var r = document.querySelector(':root');
    var rs = getComputedStyle(r);
    value = rs.getPropertyValue('--default')
    value = value.split("px")[0];
    value = (value *1)  +4;
    r.style.setProperty('--default', value + "px");

    
  }

  function decSub() {
    var r = document.querySelector(':root');
    var rs = getComputedStyle(r);
    value = rs.getPropertyValue('--default')
    value = value.split("px")[0];
    value = (value *1)  -4;
    r.style.setProperty('--default', value + "px");
    
   

    
  }


const controls = `

<div class="plyr__controls">

<button onclick="incSub()" class="plyr__controls__item plyr__control" type="button" data-plyr="inc">
    
     <span>A+</span>

    <span class="plyr__sr-only">Restart</span>
 </button>

 <button onclick="decSub()" class="plyr__controls__item plyr__control" type="button" data-plyr="inc">
    
     <span>A-</span>

    <span class="plyr__sr-only">Restart</span>
 </button>

 <button class="plyr__controls__item plyr__control" type="button" data-plyr="restart">
    <svg role="presentation" focusable="false">
       <use xlink:href="#plyr-restart"></use>
    </svg>
    <span class="plyr__sr-only">Restart</span>
 </button>
 <button class="plyr__controls__item plyr__control" type="button" data-plyr="rewind">
    <svg role="presentation" focusable="false">
       <use xlink:href="#plyr-rewind"></use>
    </svg>
    <span class="plyr__sr-only">Rewind 10s</span>
 </button>
 <button class="plyr__controls__item plyr__control" type="button" data-plyr="play" aria-label="Play">
    <svg class="icon--pressed" role="presentation" focusable="false">
       <use xlink:href="#plyr-pause"></use>
    </svg>
    <svg class="icon--not-pressed" role="presentation" focusable="false">
       <use xlink:href="#plyr-play"></use>
    </svg>
    <span class="label--pressed plyr__sr-only">Pause</span><span class="label--not-pressed plyr__sr-only">Play</span>
 </button>
 <button class="plyr__controls__item plyr__control" type="button" data-plyr="fast-forward">
    <svg role="presentation" focusable="false">
       <use xlink:href="#plyr-fast-forward"></use>
    </svg>
    <span class="plyr__sr-only">Forward 10s</span>
 </button>
 <div class="plyr__controls__item plyr__progress__container">
    <div class="plyr__progress"><input data-plyr="seek" type="range" min="0" max="100" step="0.01" value="0" autocomplete="off" role="slider" aria-label="Seek" aria-valuemin="0" aria-valuemax="117.312" aria-valuenow="9.77944" id="plyr-seek" style="--value:8.34%;" seek-value="76.29284755620952" aria-valuetext="00:09 of 01:57"><progress class="plyr__progress__buffer" min="0" max="100" value="19.28447217675941" role="progressbar" aria-hidden="true">% buffered</progress><span class="plyr__tooltip" style="left: 76.2928%;">01:29</span></div>
 </div>
 <div class="plyr__controls__item plyr__time--current plyr__time" aria-label="Current time">00:09</div>
 <div class="plyr__controls__item plyr__time--duration plyr__time" aria-label="Duration">01:57</div>
 <div class="plyr__controls__item plyr__volume">
    <button type="button" class="plyr__control" data-plyr="mute">
       <svg class="icon--pressed" role="presentation" focusable="false">
          <use xlink:href="#plyr-muted"></use>
       </svg>
       <svg class="icon--not-pressed" role="presentation" focusable="false">
          <use xlink:href="#plyr-volume"></use>
       </svg>
       <span class="label--pressed plyr__sr-only">Unmute</span><span class="label--not-pressed plyr__sr-only">Mute</span>
    </button>
    <input data-plyr="volume" type="range" min="0" max="1" step="0.05" value="1" autocomplete="off" role="slider" aria-label="Volume" aria-valuemin="0" aria-valuemax="100" aria-valuenow="100" id="plyr-volume" aria-valuetext="100.0%" style="--value:100%;">
 </div>
 <button class="plyr__controls__item plyr__control plyr__control--pressed" type="button" data-plyr="captions">
    <svg class="icon--pressed" role="presentation" focusable="false">
       <use xlink:href="#plyr-captions-on"></use>
    </svg>
    <svg class="icon--not-pressed" role="presentation" focusable="false">
       <use xlink:href="#plyr-captions-off"></use>
    </svg>
    <span class="label--pressed plyr__sr-only">Disable captions</span><span class="label--not-pressed plyr__sr-only">Enable captions</span>
 </button>
 <div class="plyr__controls__item plyr__menu">
    <button aria-haspopup="true" aria-controls="plyr-settings" aria-expanded="false" type="button" class="plyr__control" data-plyr="settings">
       <svg role="presentation" focusable="false">
          <use xlink:href="#plyr-settings"></use>
       </svg>
       <span class="plyr__sr-only">Settings</span>
    </button>
    <div class="plyr__menu__container" id="plyr-settings" hidden="">
       <div>
          <div id="plyr-settings-home">
             <div role="menu"><button data-plyr="settings" type="button" class="plyr__control plyr__control--forward" role="menuitem" aria-haspopup="true" hidden=""><span>Captions<span class="plyr__menu__value">Disabled</span></span></button><button data-plyr="settings" type="button" class="plyr__control plyr__control--forward" role="menuitem" aria-haspopup="true" hidden=""><span>Quality<span class="plyr__menu__value">undefined</span></span></button><button data-plyr="settings" type="button" class="plyr__control plyr__control--forward" role="menuitem" aria-haspopup="true"><span>Speed<span class="plyr__menu__value">Normal</span></span></button></div>
          </div>
          <div id="plyr-settings-captions" hidden="">
             <button type="button" class="plyr__control plyr__control--back"><span aria-hidden="true">Captions</span><span class="plyr__sr-only">Go back to previous menu</span></button>
             <div role="menu"></div>
          </div>
          <div id="plyr-settings-quality" hidden="">
             <button type="button" class="plyr__control plyr__control--back"><span aria-hidden="true">Quality</span><span class="plyr__sr-only">Go back to previous menu</span></button>
             <div role="menu"></div>
          </div>
          <div id="plyr-settings-speed" hidden="">
             <button type="button" class="plyr__control plyr__control--back"><span aria-hidden="true">Speed</span><span class="plyr__sr-only">Go back to previous menu</span></button>
             <div role="menu"><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="0.5"><span>0.5×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="0.75"><span>0.75×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="true" value="1"><span>Normal</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="1.25"><span>1.25×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="1.5"><span>1.5×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="1.75"><span>1.75×</span></button><button data-plyr="speed" type="button" role="menuitemradio" class="plyr__control" aria-checked="false" value="2"><span>2×</span></button></div>
          </div>
       </div>
    </div>
 </div>
 <button class="plyr__controls__item plyr__control" type="button" data-plyr="pip">
    <svg role="presentation" focusable="false">
       <use xlink:href="#plyr-pip"></use>
    </svg>
    <span class="plyr__sr-only">PIP</span>
 </button>
 <a class="plyr__controls__item plyr__control" target="_blank" data-plyr="download" href="{{$epi->url ?? ''}}">
    <svg role="presentation" focusable="false">
       <use xlink:href="#plyr-download"></use>
    </svg>
    <span class="plyr__sr-only">Vimeo</span>
 </a>

 <a href="{{$prvEpiIndex ?? ""}}" style="position:absolute;margin-bottom:100px;margin-right:60px" class="plyr__controls__item plyr__control" type="button">
    
    <i class="fa fa-arrow-left"></i>

    <span class="label--pressed plyr__sr-only">Exit fullscreen</span><span class="label--not-pressed plyr__sr-only">Enter fullscreen</span>
 </a>

 <a href="{{$nextEpiIndex ??""}}"style="position:absolute;margin-bottom:100px;margin-right:20px" class="plyr__controls__item plyr__control" type="button">
    
    <i class="fa fa-arrow-right"></i>

    <span class="label--pressed plyr__sr-only">Exit fullscreen</span><span class="label--not-pressed plyr__sr-only">Enter fullscreen</span>
 </a>


 <button class="plyr__controls__item plyr__control" type="button" data-plyr="fullscreen">
    <svg class="icon--pressed" role="presentation" focusable="false">
       <use xlink:href="#plyr-exit-fullscreen"></use>
    </svg>
    <svg class="icon--not-pressed" role="presentation" focusable="false">
       <use xlink:href="#plyr-enter-fullscreen"></use>
    </svg>
    <span class="label--pressed plyr__sr-only">Exit fullscreen</span><span class="label--not-pressed plyr__sr-only">Enter fullscreen</span>
 </button>
</div>

`;

var player = new Plyr('#player', { controls });
    player.source = {
       
  type: 'video',
  title: "{{$epi->name ?? ''}}",
  sources: [
    {
      src: "{{$epi->url ?? ''}}",
      type: 'video/mp4',
      size: 720,
    },
    
  ],
  
  tracks: [
    {
        
      kind: 'captions',
      label: 'English',
      srclang: 'en',
      
      default: true,
    },
    {
      kind: 'captions',
      label: 'عربي',
      srclang: 'ar',
      src: '{{$epi->subtitle??''}}',
    },
  ],
};

setTimeout(() => {
    @if(isset($_GET['duration']))
var hms = "{{$_GET['duration']}}";
hms = hms.split(".")[0];
var a = hms.split(':'); // split it at the colons

// minutes are worth 60 seconds. Hours are worth 60 minutes.
var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]); 
player.currentTime = seconds;
player.play()
@endif
}, 1000);

@if(isset($epi))

@if(Auth()->user())

window.onbeforeunload = function(e) {

    var date = new Date(null);
date.setSeconds(player.currentTime); // specify value for SECONDS here
var result = date.toISOString().substr(11, 8);

    $.ajax({
    url: "{{route('hist')}}",
    type: "POST",
    data: {
        'last_duration': result + ".0GS",
        'user_id':{{auth()->user()->id}},
        'id':{{$series->id}},
        'season_id':{{$_GET["season"]}},
        "type":"series",
        "epi_id":{{$epi->id}}
    },
    timeout: 10000,
    
    success: function(t) {
        t.suecces ? (toastr.success("Fikr sharh o'chirib tashlandi", "Muvafaqiyatli"), $("#mistakeModal").modal("hide"), $("#coment_" + a).remove()) : toastr.error.message("Sharh fikrni o'chirib bo'lmadi", "Xatolik ")
    }
 
});

  
    console.log("test")
    return "Do you want to exit this page?";

 
};
@endif
@endif


</script>

@endsection

