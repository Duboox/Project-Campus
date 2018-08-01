<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
      <title>Solicitudes</title>
      <style type="text/css">
         table.blueTable {
          border: 1px solid #1C6EA4;
          background-color: #EEEEEE;
          width: 100%;
          text-align: left;
          border-collapse: collapse;
         }

         table.blueTable td, table.blueTable th {
          border: 1px solid #AAAAAA;
          padding: 3px 2px;
         }

         table.blueTable tbody td {
          font-size: 13px;
         }

         table.blueTable tr:nth-child(even) {
          background: #D0E4F5;
         }

         table.blueTable thead {
           background: #1C6EA4;
           background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
           background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
           background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
           border-bottom: 2px solid #444444;
         }

         table.blueTable thead th {
           font-size: 10px;
           text-transform: uppercase;
           font-weight: bold;
           color: #FFFFFF;
           border-left: 2px solid #D0E4F5;
         }

         table.blueTable thead th:first-child {
          border-left: none;
         }

         table.blueTable tfoot {
           font-size: 14px;
           font-weight: bold;
           color: #FFFFFF;
           background: #D0E4F5;
           background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
           background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
           background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
           border-top: 2px solid #444444;
         }

         table.blueTable tfoot td {
          font-size: 14px;
         }
      </style>
   </head>
   <body class="gray-bg">
    <h1>{{ config('app.name') }}</h1>
    <p>Reporte generado por: <strong>{{ username() }}</strong>
      {{ 'el: '.Carbon\Carbon::now()->format('d-m-Y - h:i:s') }}
    </p>
      <table class="blueTable">
         <thead>
            <tr>
              <th>#ID</th>
              <th>Fecha entrega</th>
              <th>Fecha devolución</th>
              <th>Cliente</th>
              <th>Producto</th>
              <th>Registro</th>
            </tr>
         </thead>
         <tbody>
            @foreach($services as $service)
            <tr>
               <td>{{ $service->id }}</td>
               <td>{{ $service->date_delivery }}</td>
               <td>{{ $service->date_return }}</td>
               @if($service->client!=null)
                        <td>{{ $service->client->name }}</td>
               @endif
               @if($service->product!=null)
                        <td>{{ $service->product->name }}</td>
               @endif
               <td>{{ Carbon\Carbon::parse($service->created_at)->format('d-m-Y') }}</td>
            </tr>
            @endforeach
         </tbody>
      </table>
    <script type="text/php">

    </script>
   </body>
</html>