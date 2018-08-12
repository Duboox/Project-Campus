<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
      <title>Certificado de calibración</title>
      <style type="text/css">
      @page certificate1 {
        size: letter;
        /* margin: 2cm; */
      }
      .page1 {
        page: certificate1;
        page-break-after: always;
      }
      @page certificate2 {
        size: letter;
        /* margin: 2cm; */
      }
      .page2 {
        page: certificate2;
        page-break-after: always;
      }
      @page certificate3 {
        size: letter;
        /* margin: 2cm; */
      }
      .page3 {
        page: certificate3;
        page-break-after: always;
      }
      .image_service{
        position: absolute;
        top: 0%;
        height: 100%;
        width: 100%;
        margin: 0 !important;
        padding: 0 !important;
      }
      .image_servicePage2{
        position: absolute;
        top: 0%;
        height: 100%;
        width: 100%;
        margin: 0 !important;
        padding: 0 !important;
      }
      .image_servicePage3{
        position: absolute;
        top: 0%;
        height: 100%;
        width: 100%;
        margin: 0 !important;
        padding: 0 !important;
      }
      .client_name {
        position: absolute;
        z-index: 999;
        color: black;
        top: 17%;
        left: 22%;
        font-size: 1em;
      }
      .product_name {
        position: absolute;
        z-index: 999;
        color: black;
        top: 23%;
        left: 22%;
        font-size: 1em;
      }
      .product_model {
        position: absolute;
        z-index: 999;
        color: black;
        top: 30%;
        left: 25%;
        font-size: 1em;
      }
      .product_fabricator {
        position: absolute;
        z-index: 999;
        color: black;
        top: 37%;
        left: 25%;
        font-size: 1em;
      }
      .product_serial {
        position: absolute;
        z-index: 999;
        color: black;
        top: 45%;
        left: 29%;
        font-size: 1em;
      }
      .product_internal {
        position: absolute;
        z-index: 999;
        color: black;
        top: 52%;
        left: 29%;
        font-size: 1em;
      }

      .date_delivery{
        position: absolute;
        z-index: 999;
        color: black;
        top: 75%;
        left: 10%;
        font-size: 1em;
      }
      .date_return{
        position: absolute;
        z-index: 999;
        color: black;
        top: 82%;
        left: 10%;
        font-size: 1em;
      }
      </style>
   </head>
   <body>
    <div class="page1">
      <img src="{{ public_path('images/static/certificate/1.png')}}" class="image_service">
      @if($service->client!=null)
          <p class="client_name">{{ $service->client->name }} {{ $service->client->last_name }}</p>
      @endif
      @if($service->product!=null)
          <p class="product_name">{{ $service->product->name }}</p>
          <p class="product_model">{{ $service->product->model }}</p>
          <p class="product_fabricator">{{ $service->product->fabricator->name }}</p>
          <p class="product_serial">{{ $service->product->serial_number }}</p>
          <p class="product_internal">{{ $service->product->internal_code }}</p>
      @endif
    </div>
    <div class="page2">
      <img src="{{ public_path('images/static/certificate/2.png')}}" class="image_servicePage2">
    </div>
    <div class="page3">
      <img src="{{ public_path('images/static/certificate/3.png')}}" class="image_servicePage3">
    </div>
   </body>
</html>