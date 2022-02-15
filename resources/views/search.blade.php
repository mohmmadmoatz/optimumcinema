@extends("app")
@section("content")




<div class="container-fluid py-2" style="text-align: right;padding: 20px;">
    
    <div class="btn-group" role="group" style="margin-bottom: 15px;">
        
      </div>
     
      <div class="collection">
        <h4> <a href="">الأفلام</a> </h4>
      </div>

        <div class="container-fluid row">

        
      <div id="owl-demo" class="owl-carousel owl-theme">
       
       

        @for($i=0;$i<count($movies);$i++)

        <div class="item">
            <a href="{{route('moviedetails',$movies[$i]["id"])}}">


            
          <div class="image">
            <img src="{{$movies[$i]["poster"]}}" style = "height:263px">
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
                <span class="mvtitle">{{$movies[$i]["name"]}}</span>
              </div>
              <div class="col-md-auto">
                 <span class="brand">IMdb</span> {{$movies[$i]["rate"]}}
              </div>
              <div class="col-12">
                <span class="mvsubtitle">{{$movies[$i]["year"] == null? "  " : $movies[$i]["year"]}} , {{getcategoryname( $movies[$i]["moviecat_id"] ,$cats )}}</span>
              </div>
            </div>

        </div>
        


        @endfor

      
        


       
        
    
      
        
      </div>
    </div>

    <div class="collection">
      <h4> <a href="">المسلسلات</a> </h4>
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
               <span class="brand">IMdb</span> {{$series[$i]["rate"]}}
            </div>
            <div class="col-12">
              <span class="mvsubtitle">{{$series[$i]["year"] == null? "  " : $series[$i]["year"]}} , {{getcategoryname( $series[$i]["series_cat"] ,$cats )}}</span>
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