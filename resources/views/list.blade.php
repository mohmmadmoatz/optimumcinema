@extends("app")
@section("content")
<div class="container-fluid py-2" style="text-align: right;padding: 20px;">

  <h1 style="color: #fff"> <span>{{$titlename}}</span></h1>

  <div class="row py-2">
    @foreach ($data as $item)
                                 
          @if($titlename == "الأفلام المضافة حديثا" || "الأفلام المميزة")
    <div class="item" style="width: 170px;margin-right: 10px;
      margin-left: 10px;margin-bottom: 10px;">
      <a href="@route('moviedetails',$item->id)">



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
          <span class="mvsubtitle">{{$item->year}} , {{getcategoryname($item->moviecat_id ,$cats)}}</span>
        </div>
      </div>

    </div>
  @else 
  
  
  <div class="item">
    <a href="{{route('seriesdetails',$seriesrandom[$i]["id"])}}">


    
  <div class="image">
    <img src="{{$item->poster}}" style = "height:263px">
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
        <span class="mvtitle">{{$item->name}}</span>
      </div>
      <div class="col-md-auto">
         <span class="brand">IMdb</span> {{$item->series_rate}}
      </div>
      <div class="col-12">
        <span class="mvsubtitle">{{$item->year == null? "  " : $item->year}} , {{getcategoryname( $item->series_cat ,$cats )}}</span>
      </div>
    </div>

</div>
@endif
    @endforeach

  </div>






</div>
@endsection