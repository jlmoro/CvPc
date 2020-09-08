<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style media="screen">
      body{
        margin: 0 auto;
      }
      .table{
        width: 100%;
      }
    </style>
  </head>
  <body>
    <div class="container justify-content-center">
      <div class="row w-100">
        <div class="col-md-12 text-center">
          <img src="../public/img/logo.png" height="150" width="170" alt="">
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12 text-center">
          <h3>Listado de Pantallas</h3>
        </div>
      </div>
      <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Marca</th>
            <th scope="col">Placa</th>
            <th scope="col">Serial</th>
            <th scope="col">Encargado</th>
            <th scope="col">Proveedor</th>
            <th scope="col">Estado</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pantalla as $key => $pan)
          <tr>
            <th scope="row">{{++$key}}</th>
            <td>{{$pan->marca}}</td>
            <td>{{$pan->placa}}</td>
            <td>{{$pan->serial}}</td>
            <td>{{$pan->nombre_ecnargado}}</td>
            <td>{{$pan->nombre_proveedor}}</td>
            <td>
              @if ($pan->estado == 1)
              <span>Activo</span>
              @else
              <span>Inactivo</span>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>
