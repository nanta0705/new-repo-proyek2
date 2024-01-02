
<!-- /*
* Template Name: LuxuryHotel
* Template Author: Untree.co
* Tempalte URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="{{url('/layout_landing')}}/favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="" />

    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:400,500i,700|Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   @include('layout_landing.css.style_css')
    <title>LuxuryHotel Free HTML Template by Untree.co</title>
  </head>
  <body>

    <div id="untree_co--overlayer"></div>
    <div class="loader">
      <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <nav class="untree_co--site-mobile-menu">
      <div class="close-wrap d-flex">
        <a href="#" class="d-flex ml-auto js-menu-toggle">
          <span class="close-label">Close</span>
          <div class="close-times">
            <span class="bar1"></span>
            <span class="bar2"></span>
          </div>
        </a>
      </div>
      <div class="site-mobile-inner"></div>
    </nav>


    <div class="untree_co--site-wrap">

        @include('layout_landing.header.v_header')

      <div class="untree_co--site-main">


        @include('layout_landing.hero.v_hero')

        @include('layout_landing.room.v_room')

        @include('layout_landing.featured.v_featured')

        @include('layout_landing.news.v_news')


        <div class="untree_co--site-section py-5 bg-body-darker cta">
          <div class="container">
            <div class="row">
              <div class="col-12 text-center">
                <h3 class="m-0 p-0">If you have any special requests, please feel free to call us. <a href="tel://+123456789012">+12.345.678.9012</a></h3>
              </div>
            </div>
          </div>
        </div>


      </div>
        @include('layout_landing.footer.v_footer')
    </div>

    <!-- Search -->
    <div class="search-wrap">
      <a href="#" class="close-search js-search-toggle">
        <span>Close</span>
      </a>
      <div class="container">
        <div class="row justify-content-center align-items-center text-center">
          <div class="col-md-12">
            <form action="#">
              <input type="search" name="s" id="s" placeholder="Type a keyword and hit enter..."  autocomplete="false">
            </form>
          </div>
        </div>
      </div>
    </div>

   @include('layout_landing.js.v_js')
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
