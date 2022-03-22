@extends("app")

@section("content")
 @php
      $data = ["Monster Hunter","Judas and the Black Messiah","Space Sweepers","Fly Away","Silk Road","Willy's Wonderland","Space Sweepers"];
      $images =[
        "https://m.media-amazon.com/images/M/MV5BOGU3NTFmNjYtODc3Ny00MWEzLWI3M2ItZjE3NDgwMTI0MzkzXkEyXkFqcGdeQXVyMTEyMjM2NDc2._V1_.jpg",
        "https://upload.wikimedia.org/wikipedia/en/5/55/Judas_and_the_Black_Messiah_poster.png",
        "https://upload.wikimedia.org/wikipedia/en/0/05/Space_Sweepers.jpg",
        "https://upload.wikimedia.org/wikipedia/en/f/f6/Fly_Away_Movie_Poster.jpg",
        "https://upload.wikimedia.org/wikipedia/en/thumb/8/81/Silk_Road_poster.jpg/1200px-Silk_Road_poster.jpg",
        "https://upload.wikimedia.org/wikipedia/en/thumb/e/e0/Willys_wonderland.jpg/220px-Willys_wonderland.jpg",
        "https://upload.wikimedia.org/wikipedia/en/0/05/Space_Sweepers.jpg",
      ]
      @endphp  
 <div id="demo" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->


        <!-- The slideshow -->
        <div class="carousel-inner">
        
        @for($i=0;$i<count($slideshow);$i++)

          <div class="carousel-item @if($i == 0) active @endif">
            <div class="overlay">
              <img src="{{$slideshow[$i]['url']}}" style="object-fit: cover;height: 500px;">
              <div class="carousel-caption">
                <div class="row">
                  <div style="width: 2%"></div>
                  <div>
                    <h1>{{$slideshow[$i]['name']}}</h1>
                  </div>
                  <div style="width: 2%"></div>

                  <div>
                    <span class="slidrate"> <i class="fa fa-star" style="font-size: 15px;"></i>{{$slideshow[$i]['notes']}}
                    </span>
                  </div>
                </div>
    
                <div style="height: 55%"></div>
            <a href="{{$slideshow[$i]['link']}}">
                
                <button class="watchnow btn" style="z-index: 10000 !important">
                  <i class="fa fa-play"></i>
                  شاهد الان

                </button>
        </a>

              </div>
            </div>
          </div>
          @endfor


        </div>
        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>
      </div>



    

     



      


      <div class="collection">
        <h4> <a href="{{route('list','الأفلام المضافة حديثا')}}">الأفلام المضافة حديثا</a> </h4>
      </div>

        <div class="container-fluid row">

        
      <div id="owl-demo" class="owl-carousel owl-theme">
       
       

        @for($i=0;$i<count($movienew);$i++)

        <div class="item">
            <a href="{{route('moviedetails',$movienew[$i]["id"])}}">


            
          <div class="image">
            <img src='{{$movienew[$i]["poster"]}}' style = "height:263px">
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
                <span class="mvtitle">{{$movienew[$i]["name"]}}</span>
              </div>
              <div class="col-md-auto">
                 <span class="brand">IMdb</span> {{$movienew[$i]["rate"]}}
              </div>
              <div class="col-12">
                <span class="mvsubtitle">{{$movienew[$i]["year"] == null? "  " : $movienew[$i]["year"]}} , {{getcategoryname( $movienew[$i]["moviecat_id"] ,$cats )}}</span>
              </div>
            </div>

        </div>
        


        @endfor

      
        


       
        
    
      
        
      </div>
    </div>


    <div class="collection">
      <h4> <a href="{{route('list','المسلسلات المضافة حديثا')}}">المسلسلات المضافة حديثا</a> </h4>
    </div>

      <div class="container-fluid row">

      
    <div id="owl-demo" class="owl-carousel owl-theme">
     
     

      @for($i=0;$i<count($series);$i++)

      <div class="item">
          <a href="{{route('seriesdetails',$series[$i]["id"])}}">


          
        <div class="image">
          <img src="{{$series[$i]["poster"]}}" style = "height:263px">
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
              <span class="mvtitle">{{$series[$i]["name"]}}</span>
            </div>
            <div class="col-md-auto">
               <span class="brand">IMdb</span> {{$series[$i]["series_rate"]}}
            </div>
            <div class="col-12">
              <span class="mvsubtitle">{{$series[$i]["year"] == null? "  " : $series[$i]["year"]}} , {{getcategoryname( $series[$i]["series_cat"] ,$cats )}}</span>
            </div>
          </div>

      </div>
      


      @endfor

    
      

    
      
    </div>
  </div>




      <div class="collection">
        <h4> <a href="{{route('list','الأفلام المميزة')}}">الأفلام المميزة</a> </h4>
      </div>

        <div class="container-fluid row">

        
      <div id="owl-demo" class="owl-carousel owl-theme">
       
       

        @for($i=0;$i<count($boxoffice);$i++)

        <div class="item">
            <a href="{{route('moviedetails',$boxoffice[$i]["id"])}}">


            
          <div class="image">
            <img src="{{$boxoffice[$i]["poster"]}}" style = "height:263px">
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
                <span class="mvtitle">{{$boxoffice[$i]["name"]}}</span>
              </div>
              <div class="col-md-auto">
                 <span class="brand">IMdb</span> {{$boxoffice[$i]["rate"]}}
              </div>
              <div class="col-12">
                <span class="mvsubtitle">{{$boxoffice[$i]["year"] == null? "  " : $boxoffice[$i]["year"]}} , {{getcategoryname( $boxoffice[$i]["moviecat_id"] ,$cats )}}</span>
              </div>
            </div>

        </div>
        


        @endfor

      
        


       
        
    
      
        
      </div>
    </div>

    <div class="collection">
      <h4> <a href="{{route('list','المسلسلات اخترناها لك')}}">المسلسلات اخترناها لك</a> </h4>
    </div>

      <div class="container-fluid row">

      
    <div id="owl-demo" class="owl-carousel owl-theme">
     
     

      @for($i=0;$i<count($seriesrandom);$i++)

      <div class="item">
          <a href="{{route('seriesdetails',$seriesrandom[$i]["id"])}}">


          
        <div class="image">
          <img src="{{$seriesrandom[$i]["poster"]}}" style = "height:263px">
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
              <span class="mvtitle">{{$seriesrandom[$i]["name"]}}</span>
            </div>
            <div class="col-md-auto">
               <span class="brand">IMdb</span> {{$seriesrandom[$i]["series_rate"]}}
            </div>
            <div class="col-12">
              <span class="mvsubtitle">{{$seriesrandom[$i]["year"] == null? "  " : $seriesrandom[$i]["year"]}} , {{getcategoryname( $seriesrandom[$i]["series_cat"] ,$cats )}}</span>
            </div>
          </div>

      </div>
      


      @endfor

    
      

    
      
    </div>
  </div>


 
  @for($i=0;$i<count($collections);$i++)
  <div class="collection">
    <h4> <a href="{{URL::to('collection' . '/' . $collections[$i]["id"] )}} "> {{$collections[$i]["name"]}}</a> </h4>
  </div>

    <div class="container-fluid row">

    
  <div id="owl-demo" class="owl-carousel owl-theme">
   
   

    @for($j=0;$j<count($collections[$i]['movies']);$j++)

    <div class="item">
        <a href="{{route('moviedetails',$collections[$i]['movies'][$j]['id'])}}">


        
      <div class="image">
        <img src="{{$collections[$i]['movies'][$j]["poster"]}}" style = "height:263px">
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
            <span class="mvtitle">{{$collections[$i]['movies'][$j]["name"]}}</span>
          </div>
          <div class="col-md-auto">
             <span class="brand">IMdb</span> {{$collections[$i]['movies'][$j]["rate"]}}
          </div>
          <div class="col-12">
            <span class="mvsubtitle">{{$collections[$i]['movies'][$j]["year"] == null? "  " : $collections[$i]['movies'][$j]["year"]}} , {{getcategoryname( $collections[$i]['movies'][$j]["moviecat_id"] ,$cats )}}</span>
          </div>
        </div>

    </div>
    


    @endfor

  
    


   
    

  
    
  </div>
</div>
@endfor



@foreach(App\Models\SeriesCollection::get() as $item)
<div class="collection">
  <h4> <a href="{{URL::to('seriescollection' . '/' . $item->id )}} "> {{$item->name}}</a> </h4>
</div>
<div class="container-fluid row">
  <div id="owl-demo" class="owl-carousel owl-theme">


    @foreach($item->serieses as $x)

    <div class="item">
        <a href="{{route('seriesdetails',$x->id)}}">
    
    
        
      <div class="image">
        <img src="{{$x->poster}}" style = "height:263px">
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
            <span class="mvtitle">{{$x->name}}</span>
          </div>
          <div class="col-md-auto">
             <span class="brand">IMdb</span> {{$x->series_rate}}
          </div>
          <div class="col-12">
            <span class="mvsubtitle">{{$x->year == null? "  " : $x->year}} , {{getcategoryname( $x->series_cat ,$cats )}}</span>
          </div>
        </div>
    
    </div>
    
    
    
    @endforeach
    
    
    
    
    
    
    </div>
    </div>


  

@endforeach

    
</div>

</div>
    @endsection