@extends("app")
@section("content")

<div class="container-fluid py-2" style="text-align: right;padding: 20px;">

<h1 style="color: #fff"> <span>{{$data[0]['name']}}</span></h1>
          
    <div class="row py-2">
                  @foreach ($data[0]['serieses'] as $item)
        

      <div class="item" style="width: 170px;margin-right: 10px;
      margin-left: 10px;margin-bottom: 10px;">
        <a href="@route('seriesdetails',$item->id)">


        
             <div class="image">
        <img src="{{$item->poster}}" width="170px" style="border-radius: 32px;height:263px">
       
               </div>
              </a>
      
      <div class="row">
          <div class="col">
            <span class="mvtitle">{{$item->name}}</span>
          </div>
          <div class="col-md-auto" style="color: #fff;">
             <span class="brand">IMdb</span> {{ $item->rate}}
          </div>
          <div class="col-12">
            <span class="mvsubtitle">{{$item->year}} , {{getcategoryname($item->series_cat ,$cats)}}</span>
          </div>
        </div>

    </div>
  

               @endforeach

</div>
 
 


   

</div>
@endsection
