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
      <div class="row mb-3">
        <div class="col-md-12 text-center">
          <h3>Detalles Equipo - {{$equipo->chasis_placa}}</h3>
        </div>
      </div>
      <table class="table table-striped table-bordered table-sm">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Chasis</th>
            <th scope="col">Procesador</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <div class="row">
                <div class="col"> Placa: </div>
                <div class="col text-center"> {{$equipo->chasis_placa}} </div>
              </div>
            </td>
            <td>
              <div class="row">
                <div class="col"> Marca: </div>
                <div class="col text-center"> {{$equipo->cpu_marca}} </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="row">
                <div class="col"> Marca: </div>
                <div class="col text-center"> {{$equipo->chasis_marca}} </div>
              </div>
            </td>
            <td>
              <div class="row">
                <div class="col"> Modelo: </div>
                <div class="col text-center"> {{$equipo->cpu_modelo}} </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="row">
                <div class="col"> Serial: </div>
                <div class="col "> <br>{{$equipo->chasis_serial}} </div>
              </div>
            </td>
            <td>
              <div class="row">
                <div class="col"> Núcleos: </div>
                <div class="col text-center"> {{$equipo->cpu_nucleos}} </div>
              </div>
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
              <div class="row">
                <div class="col"> Frecuencia: </div>
                <div class="col text-center"> {{$equipo->cpu_frecuencia}} Ghz</div>
              </div>
            </td>
          </tr>
        </tbody>
        <thead class="thead-dark">
          <tr>
            <th scope="col">Board</th>
            <th scope="col">Fuente</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <div class="row">
                <div class="col"> Marca: </div>
                <div class="col text-center"> {{$equipo->board_marca}} </div>
              </div>
            </td>
            <td>
              <div class="row">
                <div class="col"> Marca: </div>
                <div class="col text-center"> {{$equipo->fuente_marca}} </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="row">
                <div class="col"> Modelo: </div>
                <div class="col text-center"> {{$equipo->board_modelo}} </div>
              </div>
            </td>
            <td>
              <div class="row">
                <div class="col"> Modelo: </div>
                <div class="col text-center"> {{$equipo->fuente_modelo}} </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="row">
                <div class="col"> PCI: </div>
                <div class="col text-center"> {{$equipo->board_pci}} </div>
              </div>
            </td>
            <td>
              <div class="row">
                <div class="col"> Potencia: </div>
                <div class="col text-center"> {{$equipo->fuente_potencia}} W</div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="row">
                <div class="col"> PCIX: </div>
                <div class="col text-center"> {{$equipo->board_pcix}} </div>
              </div>
            </td>
            <td>
              <div class="row">
                <div class="col"> Alimentador: </div>
                <div class="col text-center"> {{$equipo->fuente_alimentador}} pines </div>
              </div>
            </td>
          </tr>
        </tbody>
        <thead class="thead-dark">
          <tr>
            <th scope="col">Área</th>
            <th scope="col">Proveedor</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              {{$equipo->area_nombre}}
            </td>
            <td>
              {{$equipo->nombre_proveedor}}
            </td>
          </tr>
        </tbody>
        <thead class="thead-dark">
          <tr>
            <th scope="col" colspan="2">Encargado</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$equipo->encargado_documento}}</td>
            <td>{{$equipo->encargado_nombre}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</html>
