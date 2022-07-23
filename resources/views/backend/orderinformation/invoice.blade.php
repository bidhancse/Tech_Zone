@php
$setting = DB::table('settinginformation')->first();
$contact = DB::table('contactinformation')->first();
@endphp


<!doctype html>
   <html lang="en">
   <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tech Zone || Invoice</title>
    <link rel="icon" type="image/x-icon" href="{{url($setting->favicon)}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>


 </head>
<body style="background-image: url();">
    <style>
       body {
          font-family: 'Calibri', sans-serif !important
       }

       .mt-100 {
          margin-top: 50px
       }

       .mb-100 {
          margin-bottom: 50px
       }

       .card {
          border-radius: 1px !important
       }

       .card-header {
          background-color: #fff
       }

       .card-header:first-child {
          border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0
       }

       .btn-sm,
       .btn-group-sm>.btn {
          padding: .25rem .5rem;
          font-size: .765625rem;
          line-height: 1.5;
          border-radius: .2rem
       }

       @media print {
          input#btnPrint {
             display: none;
          }
       }
    </style>



   <div class="container mt-100 mb-100 ">
      <div id="ui-view">
      <div>
         <div class="card">
            @if(isset($CustomerInfo))
            <div class="card-header"> Invoice : <strong># {{$CustomerInfo->id}}</strong>
            @endif

               <div class="pull-right"> 
                  <input type="button" id="btnPrint" class="btn btn-primary btn-sm" onclick="window.print();" value="Print" style="margin-right:-0px; border-radius: 0px; font-size: 16px;" align="right">
               </div>
            </div>
            <div class="card-body">
               <div class="row ">
                  <div class="col-sm-12" style="margin-top:-20px;">
                     <img src="{{url($setting->image)}}" class="img-fluid mt-2"  style="max-height: 40px; margin-left: -10px;"> 
                  </div>
               </div>

               <div class="row mb-4 mt-2">

                  <div class="col-sm-4">
                     <h6 class="mb-1">From:</h6>
                        <div><strong>ADDRESS :</strong> AVENEU-5, ROAD-5, HOUSE-353,
                        MIRPUR DOHS, DHAKA.</div>
                        <div><strong>E-MAIL :</strong> SUPPORT@TECHZONE.COM</div>
                        <div><strong>CONTACT :</strong> +880 1851932347</div>
                  </div>

                  <div class="col-sm-4">
                     <h6 class="mb-1">To:</h6>
                     @if(isset($CustomerInfo))

                     <div><strong>NAME :</strong> {{$CustomerInfo->name}}</div>
                     <div><strong>E-MAIL :</strong> {{$CustomerInfo->email}}</div>
                     <div><strong>Phone :</strong> {{$CustomerInfo->phone}}</div>
                     <div><strong>ADDRESS :</strong> {{$CustomerInfo->address}}</div>

                     @endif
                  </div>

                  <div class="col-sm-4">
                     <h6 class="mb-1">Details:</h6>
                     @if(isset($CustomerInfo))
                     <div><strong>Invoice ID:</strong> # {{$CustomerInfo->id}}</div>
                     <div><strong>Track ID:</strong>  {{$CustomerInfo->tracking_code}}</div>
                     <div><strong>Order Date :</strong> {{$CustomerInfo->order_date}}</div>
                     <div><strong>Payment Method:</strong> {{$CustomerInfo->payment_method}}</div>
                     @endif
                  </div>
               </div>

         <div class="table-responsive-sm">
            <table class="table table-striped">
               <thead>
                  <tr>
                     <th class="center"># SL</th>
                     <th>Product Name</th>
                     <th>Price</th>
                     <th class="center">Quantity</th>
                     <th >Total</th>
                  </tr>
               </thead>
               <tbody>

                  @php
                  $i=1;
                  $total=0;
                  @endphp

                  @if(isset($OrderProductInfo))
                  @foreach($OrderProductInfo as $OrderProductInfoShow)

                  @php
                  $total=$total+$OrderProductInfoShow->total_price;
                  @endphp

                  <tr>

                     <td class="center">{{$i++}}</td>
                     <td class="center">{{$OrderProductInfoShow->product_name}}</td>
                     <td class="center">{{$OrderProductInfoShow->price}}</td>
                     <td class="center">{{$OrderProductInfoShow->qty}}</td>
                     <td class="center">{{$OrderProductInfoShow->total_price}}</td>

                  </tr>

                  @endforeach
                  @endif

               </tbody>
            </table>
         </div>

         <div class="row">

         <div class="col-lg-4 col-sm-5 mt-5">

            @php
            $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
            @endphp
            <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($CustomerInfo->id, $generatorPNG::TYPE_CODE_128)) }}">
            <p>Thanks for your Business.</p>

         </div>

         <div class="col-lg-4 col-sm-5 ml-auto">
            <table class="table table-clear">
               <tbody>
                  <tr>
                  <td class="left"><strong>Subtotal</strong></td>
                  <td class="right">TK. {{$total}}.00</td>
                  </tr>
                  <tr>
                     <td class="left"><strong>Delivery Charge</strong></td>
                     <td class="right">TK. 60.00</td>
                  </tr>
                  <tr>
                     <td class="left"><strong>VAT </strong></td>
                     <td class="right">TK. 00</td>
                  </tr>
                  <tr>
                     <td class="left"><strong>Grand Total</strong></td>
                     <td class="right"><strong>TK. {{$total+60}}.00</strong></td>
                  </tr>
               </tbody>
            </table>

         </div>
      </div>
   </div>
</div>
</div>
</div>
</div>
</div>


<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>
</html>
