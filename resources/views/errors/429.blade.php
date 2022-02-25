<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <link rel="icon" href="http://127.0.0.1:8000/packages/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
    <style type="text/css">
      * {
        border: 0;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }
      body {
        background: currentColor;
      }
      /* I. Containers */
      figure {
        font-size: 6px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        width: 64em;
      }
      figcaption {
        color: #fff;
        display: flex;
        align-content: space-between;
        flex-wrap: wrap;
        height: 17em;
      }
      figcaption span:before, .sad-mac:before {
        content: "";
        display: block;
        width: 1em;
        height: 1em;
        transform: translate(-1em,-1em);
      } 
      figcaption span {
        display: inline-block;
        margin: 0 2em;
        width: 4em;
        height: 6em;
      }
      .sr-text {
        overflow: hidden;
        position: absolute;
        width: 0;
        height: 0;
      }
      /* II. Sprites */
      /* 1. Sad Mac */
      .sad-mac {
        background: #fff;
        margin: 0 auto 7em auto;
        width: 23em;
        height: 30em;
      }
      .sad-mac:before {
        box-shadow: 1em 1em, 23em 1em, 4em 3em, 5em 3em, 6em 3em, 7em 3em, 8em 3em, 9em 3em, 10em 3em, 11em 3em, 12em 3em, 13em 3em, 14em 3em, 15em 3em, 16em 3em, 17em 3em, 18em 3em, 19em 3em, 20em 3em, 3em 4em, 21em 4em, 3em 5em, 21em 5em, 3em 6em, 7em 6em, 9em 6em, 15em 6em, 17em 6em, 21em 6em, 3em 7em, 8em 7em, 16em 7em, 21em 7em, 3em 8em, 7em 8em, 9em 8em, 15em 8em, 17em 8em, 21em 8em, 3em 9em, 21em 9em, 3em 10em, 10em 10em, 13em 10em, 21em 10em, 3em 11em, 11em 11em, 12em 11em, 21em 11em, 3em 12em, 21em 12em, 3em 13em, 10em 13em, 11em 13em, 12em 13em, 13em 13em, 14em 13em, 21em 13em, 3em 14em, 9em 14em, 15em 14em, 16em 14em, 21em 14em, 3em 15em, 17em 15em, 21em 15em, 3em 16em, 21em 16em, 4em 17em, 5em 17em, 6em 17em, 7em 17em, 8em 17em, 9em 17em, 10em 17em, 11em 17em, 12em 17em, 13em 17em, 14em 17em, 15em 17em, 16em 17em, 17em 17em, 18em 17em, 19em 17em, 20em 17em, 3em 22em, 4em 22em, 5em 22em, 14em 22em, 15em 22em, 16em 22em, 17em 22em, 18em 22em, 19em 22em, 20em 22em, 1em 27em, 2em 27em, 3em 27em, 4em 27em, 5em 27em, 6em 27em, 7em 27em, 8em 27em, 9em 27em, 10em 27em, 11em 27em, 12em 27em, 13em 27em, 14em 27em, 15em 27em, 16em 27em, 17em 27em, 18em 27em, 19em 27em, 20em 27em, 21em 27em, 22em 27em, 23em 27em, 1em 28em, 23em 28em, 1em 29em, 23em 29em, 1em 30em, 23em 30em;
      }

      h1 {
        font-family: "Open Sans";
        font-weight: 800;
        color: #FFFFFF;
        text-align: center;
        font-size: 25px;
        padding-top: 20px;
        
        @media screen and (max-width: 400px;) {
          padding-left: 20px;
          padding-right: 20px;
          font-size: 2em;
          }
      }

      a{
        text-decoration: none;
        color: #fff;
      }

      .btn {
        font-family: "Open Sans";
        font-weight: 400;
        padding: 10px;
        background-color: #5E7FDC;
        color: white;
        width: 220px;
        margin: 0 auto;
        text-align: center;
        font-size: 12px;
        border-radius: 5px;
        cursor: pointer; 
        margin-top: 10px;
        margin-bottom: 50px;
        transition: all .2s linear;
      }

      .btn:hover {
        background-color: #3656b0;
        transition: all .2s linear;
      }
        
      @media screen and (max-width: 400px;) {
        margin: 0 auto;
        margin-top: 60px;
        margin-bottom: 50px;
          width: 200px;
        }

      /* III. Responsiveness */
      /* This cannot be smoothly done using viewport units; sprite pixels will look divided when font size is a floating point. */
      @media screen and (min-width: 720px) {
        figure {
            font-size: 7px;
        }
      }
      @media screen and (min-width: 1440px) {
        figure {
            font-size: 8px;
        }
      }
    </style>
    
    <title>Albanna</title>
  </head>

  <body>
    
    <figure>
      <div class="sad-mac"></div>
      <h1>Oops! Something went wrong!</h1>
      <div class="btn">
        <a href="http://127.0.0.1:8000/">Return to Home</a>
      </div>
    </figure>    

  </body>
</html>