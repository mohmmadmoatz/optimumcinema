@extends("app")
@section("content")




<div class="container-fluid py-2" style="text-align: right;padding: 20px;">
    
    <div class="btn-group" role="group" style="margin-bottom: 15px;">
        <a href="@route('movies')" type="button"  class="btn {{$type=='movies' ?  'active' :'notactive'}}">افلام</a>
        <a href="@route('series')" type="button" class="btn {{$type=='series' ?  'active' :'notactive'}}">مسلسلات</a>
        
      </div>
      
      <div class="btn-group">
        <button type="button" class="btn filterbtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{isset($_GET['cat']) ? $cats->find($_GET['cat'])->name : 'الفئة'}}
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#" onclick = "removeparam('cat')">الجميع</a>
          <div class="dropdown-divider"></div>
          @foreach ($cats as $cat)
          <a class="dropdown-item" href="#" onclick="addparam('cat',{{$cat->id}})">{{$cat->name}}</a>

          @endforeach
          
      
        </div>
      </div>

      <div class="btn-group">
        <button type="button" class="btn filterbtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{isset($_GET['language']) ? $languages->find($_GET['language'])->name : 'اللغة'}}
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#" onclick = "removeparam('language')">الجميع</a>
          <div class="dropdown-divider"></div>
          @foreach ($languages as $item)
          <a class="dropdown-item" href="#" style= "color:white" onclick="addparam('language',{{$item->id}})">{{$item->name}}</a>
              
          @endforeach
          
         
      
        </div>
      </div>


      <div class="btn-group">
        <button type="button" class="btn filterbtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{isset($_GET['sort']) ? $_GET['sort'] : 'التصنيف'}}
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#" onclick="removeparam('sort')">الجميع</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" onclick = "addparam('sort','الأحدث')">الأحدث</a>
          <a class="dropdown-item" href="#" onclick = "addparam('sort','الأعلى تقيما')">الأعلى تقيما</a>
          
         
         
      
        </div>
      </div>

    

        
    
        

          <div class="row py-2">
           
            @foreach ($data as $item)
                
       
              <div class="item" style="width: 170px;margin-right: 10px;
              margin-left: 10px;margin-bottom: 10px;">
                <a href="@route($type == 'movies' ? 'moviedetails' : 'seriesdetails',$item->id)">
    
    
                
              <div class="image">
                <img src="{{$item->poster}}" width="170px" style="border-radius: 32px;height:263px">
               
              </div>
            </a>
              
              <div class="row">
                  <div class="col">
                    <span class="mvtitle">{{$item->name}}</span>
                  </div>
                  <div class="col-md-auto" style="color: #fff;">
                     <span class="brand">IMdb</span> {{$type == 'movies' ? $item->rate : $item->series_rate}}
                  </div>
                  <div class="col-12">
                    <span class="mvsubtitle">{{$item->year}} , {{getcategoryname( $type == 'movies' ? $item->moviecat_id : $item->series_cat ,$cats )}}</span>
                  </div>
                </div>
    
            </div>

            @endforeach

         
         


           
          </div>

         <div class="container">
          {{ $data->links("pagination::bootstrap-4") }}
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