    <!-- CSS -->
    
    <link rel="stylesheet" href="{{ asset('css/kendogrid/kendo.default-v2.css') }}" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    
<style>
    p,label,h1,h2,h3,h4,h5,th,button,input,select,option,a,span,td,strong,textarea {
        text-transform: uppercase; 
    }
    .fontenormal {
        text-transform: initial;
        font-size: 12pt;
    }

/*Início estilo PDF Kendo Grid */
    .k-grid td, .k-input, .k-item {
            font-family: "DejaVu Sans", "Arial", sans-serif;
            font-size: 7pt;
        }
    .k-datepicker{
        height: 30%;
        width: 120px;
    }

     /* Page Template for the exported PDF */
     .page-template {
          font-family: "DejaVu Sans", "Arial", sans-serif;
          position: absolute;
          width: 100%;
          height: 100%;
          top: 0;
          left: 0;
        }
        .page-template .header {
          position: absolute;
          top: 30px;
          left: 30px;
          right: 30px;
          border-bottom: 1px solid #888;
          color: #888;
        }
        .page-template .footer {
          position: absolute;
          bottom: 30px;
          left: 30px;
          right: 30px;
          border-top: 1px solid #888;
          text-align: center;
          color: #888;
        }
        .page-template .watermark {
          font-weight: bold;
          font-size: 300%;
          text-align: center;
          margin-top: 30%;
          color: #aaaaaa;
          opacity: 0.1;
          transform: rotate(-35deg) scale(1.7, 1.5);
        }

        /* Content styling */
        .customer-photo {
          display: inline-block;
          width: 32px;
          height: 32px;
          border-radius: 50%;
          background-size: 32px 35px;
          background-position: center center;
          vertical-align: middle;
          line-height: 32px;
          box-shadow: inset 0 0 1px #999, inset 0 0 10px rgba(0,0,0,.2);
          margin-left: 5px;
        }
        kendo-pdf-document .customer-photo {
          border: 1px solid #dedede;
        }
        .customer-name {
          display: inline-block;
          vertical-align: middle;
          line-height: 32px;
          padding-left: 3px;
        }
    /*Final estilo PDF Kendo Grid */        

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }


        /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
    .shadowDiv {
    box-shadow: 0 1rem 3rem rgba(0,0,0,.5)!important;
    }

     .nav-link,#navbarDropdown {
        color: yellow !important;
        /* background-color: brown;
        background-size: 0.2%; */
    }

    @media (min-width: 700px) and (max-width: 1500px) {

    .nav-item {
            font-size: 10px;
        }
    }
        @media (min-width: 1501px) {
            .nav-item {
            font-size: 13px;
        }
        }
    }
 

    /*
    Use the DejaVu Sans font for displaying and embedding in the PDF file.
    The standard PDF fonts do not support Unicode characters.
*/
    div,table, td {
        font-family: "DejaVu Sans", "Arial", sans-serif;
        font-size: 10px !important;
    }


    /*
  The example loads the DejaVu Sans from the Kendo UI CDN.
  Other fonts have to be hosted from your application.
  The official site of the Deja Vu Fonts project is
  https://dejavu-fonts.github.io/.
*/
    @font-face {
        font-family: "DejaVu Sans";
        src: url("https://kendo.cdn.telerik.com/2017.2.621/styles/fonts/DejaVu/DejaVuSans.ttf") format("truetype");
    }

    @font-face {
        font-family: "DejaVu Sans";
        font-weight: bold;
        src: url("https://kendo.cdn.telerik.com/2017.2.621/styles/fonts/DejaVu/DejaVuSans-Bold.ttf") format("truetype");
    }

    @font-face {
        font-family: "DejaVu Sans";
        font-style: italic;
        src: url("https://kendo.cdn.telerik.com/2017.2.621/styles/fonts/DejaVu/DejaVuSans-Oblique.ttf") format("truetype");
    }

    @font-face {
        font-family: "DejaVu Sans";
        font-weight: bold;
        font-style: italic;
        src: url("https://kendo.cdn.telerik.com/2017.2.621/styles/fonts/DejaVu/DejaVuSans-Oblique.ttf") format("truetype");
    }
</style>