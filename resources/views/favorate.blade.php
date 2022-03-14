@extends("app")
@section("content")



<div class="container-fluid py-2" style="text-align: right;padding: 20px;">
  
    <div class="btn-group" role="group" style="margin-bottom: 15px;">
        
      </div>
     
      <div class="collection">
        <h4> <a href="">الأفلام المشهورة</a> </h4>
      </div>

        <div class="container-fluid row">

        
      <div id="owl-demo" class="owl-carousel owl-theme">
       
       

        @for($i=0;$i<count($movies);$i++)

        <div class="item">
            <a href="{{route('moviedetails',$movies[$i]['movie']["id"])}}">


            
          <div class="image">
            <img src="{{$movies[$i]['movie']["poster"]}}" style = "height:263px">
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
                <span class="mvtitle">{{$movies[$i]['movie']["name"]}}</span>
              </div>
              
              <div class="col-md-auto">
                 <span class="brand">IMdb</span> {{$movies[$i]['movie']["rate"]}}
              </div>
              <div class="col-12">
                <span class="mvsubtitle">{{$movies[$i]['movie']["year"] == null? "  " : $movies[$i]['movie']["year"]}} , {{getcategoryname( $movies[$i]['movie']["moviecat_id"] ,$cats )}}</span>
              </div>
              <div class="container">
                
                  <a href="{{route('removefav',$movies[$i]['movie']["id"])}}">
               
                
                    <label class="icon--heart" for="fav">ازالة</label>
                  </a>
        
            </div>
              
            </div>

        </div>
        


        @endfor

      
        


       
        
    
      
        
      </div>
    </div>

    <div class="collection">
      <h4> <a href="">المسلسلات المشهورة</a> </h4>
    </div>

      <div class="container-fluid row">

      
    <div id="owl-demo" class="owl-carousel owl-theme">
     
     

      @for($i=0;$i<count($series);$i++)

      <div class="item">
          <a href="{{route('seriesdetails',$series[$i]['series']["id"])}}">


          
        <div class="image">
          <img src="{{$series[$i]['series']["poster"]}}" style = "height:263px">
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
              <span class="mvtitle">{{$series[$i]['series']["name"]}}</span>
            </div>
            <div class="col-md-auto">
               <span class="brand">IMdb</span> {{$series[$i]['series']["rate"]}}
            </div>
            <div class="col-12">
              <span class="mvsubtitle">{{$series[$i]['series']["year"] == null? "  " : $series[$i]['series']["year"]}} , {{getcategoryname( $series[$i]['series']["series_cat"] ,$cats )}}</span>
            </div>
            <div class="container">
                
                <a href="{{route('removeserisefav',$series[$i]['series']["id"])}}">
             
              
                  <label class="icon--heart" for="fav">ازالة</label>
                </a>
      
          </div>
          </div>

      </div>
      


      @endfor

    
      


     
      
  
    
      
    </div>
  </div>



    
    
</div>

@endsection



@section("script")
<script>

var url = new URL(location.href);

function addparam(key,value){
  url.searchParams.set(key,value);
  window.location = url.href
}

function removeparam(key){
  url.searchParams.delete(key);
  window.location = url.href
}

$("#ex18b").slider({
	min: 0,
	max: 10,
	value: [3, 6],
	labelledby: ['ex18-label-2a', 'ex18-label-2b']
});
</script>


@endsection