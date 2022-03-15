<!doctype html>
@php

@endphp
<html lang="en" dir="rtl">



<head>
  <style>
    :root {
  --default: 20px;
}

.plyr__caption{
    font-size:var(--default);
    background:transparent !important
    
}

.plyr__video-wrapper::before {
  position: absolute;
  top: 5px;
  left: 5px;
  z-index: 10;
  content: url('{{asset("img/wat.png")}}');
}
  </style>
  <!-- Required meta tags -->
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Markazi+Text:wght@400;700&display=swap" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <script defer="" src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
    integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
    crossorigin="anonymous"></script>
  <script defer="" src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
    integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
    crossorigin="anonymous"></script>

  <link rel="stylesheet" href="{{asset('Owl/dist/assets/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('Owl/dist/assets/owl.theme.default.css')}}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.min.css" integrity="sha512-3q8fi8M0VS+X/3n64Ndpp6Bit7oXSiyCnzmlx6IDBLGlY5euFySyJ46RUlqIVs0DPCGOypqP8IRk/EyPvU28mQ==" crossorigin="anonymous" />

  <link rel="stylesheet" href="https://cdn.plyr.io/3.6.4/plyr.css" />

  <style>
    .float-right{
      float: right!important;
    white-space: nowrap;
    width: 50px;
    overflow: hidden;
    text-overflow: ellipsis;
    }
  </style>


  <title>Cinemana</title>
</head>

<body class="cbg-dark">

  <div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
      <div class="sidebar-header">

        <a href="@route('home')">    <h3><img src="{{asset('img/logo.png')}}" width="150px"></h3>  </a>

        <span style="font-size: 1.5rem;padding-right: 15px;padding-top: 20px;" id="sidebarCollapse">
          <i class="fas fa-bars"></i>

        </span>
        <strong></strong>
      </div>

      <ul class="list-unstyled components">
      @guest
      <li >
          <a href="{{route('loginweb')}}">
            <i class="fa fa-fire"></i>
            <span>تسجيل الدخول</span>

          </a>

          </li>

          @else


   <li >
          <a  href="{{ route('logout') }}"      onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <i class="fa fa-fire"></i>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              
              @csrf
          </form>
            <span>تسجيل خروج</span>

          </a>

          </li>

          @endguest
        <li class="@isActive('home', 'active')">
          <a href="@route('home')">
            <i class="fas fa-home"></i>
            <span>الصفحة الرئيسية</span>
          </a>

        </li>

          <li >
          
          <a href="{{route('newmovies')}}">
            <i class="fa fa-fire"></i>
            <span>الاصدارات الجديدة</span>

          </a>

        </li>


         <li >
          <a href="{{route('famous')}}">
            <i class="fa fa-comment-alt"></i>
            <span>المشهورة</span>

          </a>

        </li>

          <li class="@isActive(['moviedetails','movies'], 'active')">
            <a  data-toggle="dropdown">
           
              <i class="fa fa-film"></i>
         
              <span>الأفلام</span>
              
                  <i class="fa fa-arrow-circle-down"></i>
               

                <div class="dropdown-menu">
                  <a class="dropdown-item" href="@route('movies')" onclick = "removeparam('language')">الجميع</a>
                  <div class="dropdown-divider"></div>
                  
                  @foreach (App\Models\language::get() as $item)
                  <a class="dropdown-item"  style= "color:white;" onclick="movielang({{$item->id}})">{{$item->name}}</a>
                  {{-- href="@route('movies?language='{{$item->id}})" --}}
                  @endforeach
                  
                 
              
                </div>
          
            </a>
       
        
            
             
            </li>
      
         

          

            

        <li class="@isActive(['series','seriesdetails'], 'active')">
          <a data-toggle="dropdown">
            <i class="fa fa-tv"></i>
            <span>المسلسلات</span>

            <i class="fa fa-arrow-circle-down"></i>
               

            <div class="dropdown-menu">
              <a class="dropdown-item" href="@route('series')" onclick = "removeparam('language')">الجميع</a>
              <div class="dropdown-divider"></div>
              
              @foreach (App\Models\language::get() as $item)
              <a class="dropdown-item"  style= "color:white;" onclick="serieslang({{$item->id}})">{{$item->name}}</a>
              {{-- href="@route('movies?language='{{$item->id}})" --}}
              @endforeach
              
             
          
            </div>
          </a>

        </li>
        <hr>
        @guest
<div></div>
        @else
        <li>
          <a href="{{route('favorate')}}">
            <i class="fa fa-bookmark"></i>
            <span>المفضلة </span>


          </a>

        </li>
        <li>
          <a href="{{route('continuwhatch')}}">
            <i class="fa fa-bookmark"></i>
            <span>متابعة المشاهدة </span>


          </a>

        </li>
        <hr>
        @endguest

        <li style="text-align: center;">
          <img width="30px" src="{{asset('img/facebook-hover.svg')}}">

        </li>

      </ul>

    </nav>

    <!-- Page Content  -->
    <div id="content">

      <nav class="navbar navbar-expand-lg navbar-light">


        <span style="font-size: 1.5rem;
    padding-right: 15px;
    padding-top: 13px;
    color: white;
    padding-left: 15px" id="sidebarCollapse2">
          <i class="fas fa-bars"></i>

        </span> 
       
        <div class="input-group">
          <i class="fa fa-search" style="margin-top: 13px;
          color: white;"></i>
          <input type="text" class="form-control" id="searchbar"  placeholder="بحث عن فلم او مسلسلة" onkeydown="search(this)">
          </div>
         
          <!-- <span style="
          margin-top: 8px;
          color: white;
          font-size: 20px;
      "><i class="fa fa-search"></i></span>
            <input type="text" class="form-control" id="searchbar" placeholder="بحث عن فلم او مسلسلة"> -->

          
        

      </nav>

     



        @yield("content")




    </div>
  </div>

  <!-- Optional JavaScript -->

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


<script>

function search(ele) {
    if(event.key === 'Enter') {
      "@route('movies')"
      // route('moviedetails',$boxoffice[$i]["id"])}}
      window.location.href = "{{URL::to('search')}}" + "/" + ele.value 
    }
}
function movielang(id) {
    
      "@route('movies')"
      // route('moviedetails',$boxoffice[$i]["id"])}}
      window.location.href = "{{URL::to('movies?language=')}}" + id 
     
}
function serieslang(id) {
    
    "@route('series')"
    // route('moviedetails',$boxoffice[$i]["id"])}}
    window.location.href = "{{URL::to('series?language=')}}" + id 
   
}
</script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="{{asset('Owl/dist/owl.carousel.min.js')}}"></script>
  <script src="{{asset('js/jquery.nicescroll.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js" integrity="sha512-f0VlzJbcEB6KiW8ZVtL+5HWPDyW1+nJEjguZ5IVnSQkvZbwBt2RfCBY0CBO1PsMAqxxrG4Di6TfsCPP3ZRwKpA==" crossorigin="anonymous"></script>
  <script src="https://cdn.plyr.io/3.6.4/plyr.js"></script>
  <script type="text/javascript">
   

    $(document).ready(function () {
      $("body").niceScroll({
        cursorcolor: "#1E2C36", 
        cursorwidth: "5px", // cursor width in pixel (you can also write "5px")
        cursorborder: "1px solid #1E2C36", //
        autohidemode : false,
        rtlmode : "auto"
      });
      var scrol = document.getElementById("ascrail2000")
     scrol.style.removeProperty("right")
     scrol.style.left = "0px"
      $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
      });

 $('#sidebarCollapse2').on('click', function () {
        $('#sidebar').toggleClass('active');
      });
      var owl = $(".owl-carousel");

      owl.owlCarousel({
        loop: false,
        stagePadding: 2,
           
            nav: true,
            rtl: true,
            dots: false,
            mouseDrag: true,
            touchDrag: true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 7
                },
                1200: {
                    items: 8
                },
            }
      });
    });

  </script>
@yield("script")
</body>

</html>