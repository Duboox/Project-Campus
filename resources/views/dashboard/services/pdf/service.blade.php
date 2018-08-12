<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
      <title>Solicitud de servicio</title>
      <style type="text/css">
      .image_service{
        position: absolute;
        top: 0%;
        width: 100%;
      }
      .client_name {
        position: absolute;
        z-index: 999;
        color: black;
        top: 16%;
        left: 10%;
        font-size: 1em;
      }
      .client_city {
        position: absolute;
        z-index: 999;
        color: black;
        top: 19%;
        left: 10%;
        font-size: 1em;
      }
      .client_residency {
        position: absolute;
        z-index: 999;
        color: black;
        top: 22.5%;
        left: 10%;
        font-size: 1em;
      }
      .client_phone {
        position: absolute;
        z-index: 999;
        color: black;
        top: 25.8%;
        left: 10%;
        font-size: 1em;
      }
      .client_fax {
        position: absolute;
        z-index: 999;
        color: black;
        top: 29%;
        left: 10%;
        font-size: 1em;
      }
      .client_email {
        position: absolute;
        z-index: 999;
        color: black;
        top: 32%;
        left: 10%;
        font-size: 1em;
      }
      .product_name {
        position: absolute;
        z-index: 999;
        color: black;
        top: 16%;
        left: 50%;
        font-size: 1em;
      }
      .product_fabricator {
        position: absolute;
        z-index: 999;
        color: black;
        top: 19%;
        left: 50%;
        font-size: 1em;
      }
      .product_model {
        position: absolute;
        z-index: 999;
        color: black;
        top: 22.5%;
        left: 50%;
        font-size: 1em;
      }
      .product_serial {
        position: absolute;
        z-index: 999;
        color: black;
        top: 25.8%;
        left: 50%;
        font-size: 1em;
      }
      .product_internal {
        position: absolute;
        z-index: 999;
        color: black;
        top: 29%;
        left: 50%;
        font-size: 1em;
      }

      .date_entry{
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
      .observation{
        position: absolute;
        z-index: 999;
        color: black;
        top: 87%;
        left: 10%;
        font-size: 1em;
      }
      </style>
   </head>
   <body>
    <img src="{{ public_path('images/static/solicitud.jpg')}}" class="image_service">
    @if($service->client!=null)
        <p class="client_name">{{ $service->client->name }} {{ $service->client->last_name }}</p>
        <p class="client_city">{{ $service->client->city }}</p>
        <p class="client_residency">{{ $service->client->residency }}</p>
        <p class="client_phone">{{ $service->client->phone }}</p>
        <p class="client_fax">{{ $service->client->fax }}</p>
        <p class="client_email">{{ $service->client->email }}</p>
     @endif
     @if($service->product!=null)
        <p class="product_name">{{ $service->product->name }}</p>
        <p class="product_fabricator">{{ $service->product->fabricator->name }}</p>
        <p class="product_model">{{ $service->product->model }}</p>
        <p class="product_serial">{{ $service->product->serial_number }}</p>
        <p class="product_internal">{{ $service->product->internal_code }}</p>
     @endif

     <p class="date_entry">{{ $service->date_entry }}</p>
     <p class="date_return">{{ $service->date_return }}</p>
     <p class="observation">{{ $service->observation }}</p>
   </body>
</html>