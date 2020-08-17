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
      <table class="table table-striped table-bordered">
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
                <div class="col-sm-6"> Placa: </div>
                <div class="col-sm-6"> {{$equipo->chasis_placa}} </div>
              </div>
            </td>
            <td>
              <div class="row">
                <div class="col-sm-6"> Marca: </div>
                <div class="col-sm-6"> {{$equipo->cpu_marca}} </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="row">
                <div class="col-sm-6"> Marca: </div>
                <div class="col-sm-6"> {{$equipo->chasis_marca}} </div>
              </div>
            </td>
            <td>
              <div class="row">
                <div class="col-sm-6"> Modelo: </div>
                <div class="col-sm-6"> {{$equipo->cpu_modelo}} </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="row">
                <div class="col-sm-6"> Serial: </div>
                <div class="col-sm-6"> {{$equipo->chasis_serial}} </div>
              </div>
            </td>
            <td>
              <div class="row">
                <div class="col-sm-6"> Núcleos: </div>
                <div class="col-sm-6"> {{$equipo->cpu_nucleos}} </div>
              </div>
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
              <div class="row">
                <div class="col-sm-6"> Frecuencia: </div>
                <div class="col-sm-6"> {{$equipo->cpu_frecuencia}} Ghz</div>
              </div>
            </td>
          </tr>
        </tbody>
        <thead class="thead-dark">
          <tr>
            <th scope="col-sm-6">Board</th>
            <th scope="col-sm-6">Fuente</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <div class="row">
                <div class="col-sm-6"> Marca: </div>
                <div class="col-sm-6"> {{$equipo->board_marca}} </div>
              </div>
            </td>
            <td>
              <div class="row">
                <div class="col-sm-6"> Marca: </div>
                <div class="col-sm-6"> {{$equipo->fuente_marca}} </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="row">
                <div class="col-sm-6"> Modelo: </div>
                <div class="col-sm-6"> {{$equipo->board_modelo}} </div>
              </div>
            </td>
            <td>
              <div class="row">
                <div class="col-sm-6"> Modelo: </div>
                <div class="col-sm-6"> {{$equipo->fuente_modelo}} </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="row">
                <div class="col-sm-6"> PCI: </div>
                <div class="col-sm-6"> {{$equipo->board_pci}} </div>
              </div>
            </td>
            <td>
              <div class="row">
                <div class="col-sm-6"> Potencia: </div>
                <div class="col-sm-6"> {{$equipo->fuente_potencia}} W</div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="row">
                <div class="col-sm-6"> PCIX: </div>
                <div class="col-sm-6"> {{$equipo->board_pcix}} </div>
              </div>
            </td>
            <td>
              <div class="row">
                <div class="col-sm-6"> Alimentador: </div>
                <div class="col-sm-6"> {{$equipo->fuente_alimentador}} pines </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</html>
