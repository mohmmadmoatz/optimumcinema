@extends("app")

@section("content")
<div class="box" style="padding: 15px;">

    @if($epi)
   
    <div  class="container video" style="padding-bottom: 20px;" >
        <video id="player" playsinline controls ratio="16:9">
                  
                   
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

    

    <div id="owl-demo" class="owl-carousel owl-theme">
        @foreach($episodes as $item)

        <a href="{{route('playepi',[$series->id,$item->id])}}">
        <div style="padding:10px;">
            <img src="{{$series->poster}}"
                style="border-radius: 16px;height: 120px;max-height: 100%;border: 1px solid;">

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

</script>

@endsection

