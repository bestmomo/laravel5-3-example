<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {!! HTML::style('css/front.css') !!}

    <style>

      a,
      a:focus,
      a:hover {
        color: #fff;
      }
      .btn-default,
      .btn-default:hover,
      .btn-default:focus {
        color: #333;
        text-shadow: none;
        background-color: #fff;
        border: 1px solid #fff;
      }
      html,
      body {
        height: 100%;
        background-color: #333;
      }
      body {
        color: #fff;
        text-align: center;
        text-shadow: 0 1px 3px rgba(0,0,0,.5);
      }
      .site-wrapper {
        display: table;
        width: 100%;
        height: 100%; /* For at least Firefox */
        min-height: 100%;
        -webkit-box-shadow: inset 0 0 100px rgba(0,0,0,.5);
                box-shadow: inset 0 0 100px rgba(0,0,0,.5);
      }
      .site-wrapper-inner {
        display: table-cell;
        vertical-align: top;
      }
      .cover-container {
        margin-right: auto;
        margin-left: auto;
      }
      .inner {
        padding: 30px;
      }
      .cover {
        padding: 0 20px;
      }
      .cover .btn-lg {
        padding: 10px 20px;
        font-weight: bold;
      }
      @media (min-width: 768px) {
        .site-wrapper-inner {
          vertical-align: middle;
        }
        .cover-container {
          width: 100%; 
        }
      }
      @media (min-width: 992px) {
        .cover-container {
          width: 700px;
        }
      }

    </style>

  </head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="inner cover">
          
            @yield('content')

          </div>

        </div>

      </div>

    </div>
    
  </body>
</html>
