@extends('layouts.app')
<style>
    thead, td {
        text-align: center;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Reporte felder: {{$alumno->name.' '.$alumno->lastname}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 table-responsive">
                            <h5>ACT-REF</h5>
                            <table class="table table-bordered table-dark">
                                <thead>
                                <th>Nº Pregunta</th>
                                <th>A</th>
                                <th>B</th>
                                </thead>
                                <tbody>
                                @foreach($primeras as $key => $p)
                                    <tr style="text-align: center">
                                        <td>{{$primPreg[$key]}}</td>
                                        @if($p == 1)
                                            <td>✅</td>
                                        @else
                                            <td>❌</td>
                                        @endif
                                        @if($p==2)
                                            <td>✅</td>
                                        @else
                                            <td>❌</td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 col-sm-12 table-responsive">
                            <h5>SENS-INT</h5>
                            <table class="table table-bordered table-dark">
                                <thead>
                                <th>Nº Pregunta</th>
                                <th>A</th>
                                <th>B</th>
                                </thead>
                                <tbody>
                                @foreach($segundas as $key => $p)
                                    <tr style="text-align: center">
                                        <td>{{$segPreg[$key]}}</td>
                                        @if($p == 1)
                                            <td>✅</td>
                                        @else
                                            <td>❌</td>
                                        @endif
                                        @if($p==2)
                                            <td>✅</td>
                                        @else
                                            <td>❌</td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 table-responsive">
                            <h5>VIS-VERB</h5>
                            <table class="table table-bordered table-dark">
                                <thead>
                                <th>Nº Pregunta</th>
                                <th>A</th>
                                <th>B</th>
                                </thead>
                                <tbody>
                                @foreach($terceras as $key => $p)
                                    <tr style="text-align: center">
                                        <td>{{$terPreg[$key]}}</td>
                                        @if($p == 1)
                                            <td>✅</td>
                                        @else
                                            <td>❌</td>
                                        @endif
                                        @if($p==2)
                                            <td>✅</td>
                                        @else
                                            <td>❌</td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 col-sm-12 table-responsive">
                            <h5>SEC-GLOB</h5>
                            <table class="table table-bordered table-dark">
                                <thead>
                                <th>Nº Pregunta</th>
                                <th>A</th>
                                <th>B</th>
                                </thead>
                                <tbody>
                                @foreach($cuartas as $key => $p)
                                    <tr style="text-align: center">
                                        <td>{{$cuartPreg[$key]}}</td>
                                        @if($p == 1)
                                            <td>✅</td>
                                        @else
                                            <td>❌</td>
                                        @endif
                                        @if($p==2)
                                            <td>✅</td>
                                        @else
                                            <td>❌</td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- SUMAS DE CADA UNA -->
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 table-responsive">
                            <h5>ACT-REF</h5>
                            <table class="table table-dark table-bordered">
                                <thead>
                                <th colspan="1"></th>
                                <th>A</th>
                                <th>B</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        Total columna
                                    </td>
                                    <td>{{$sumasTotales[0][0]}}</td>
                                    <td>{{$sumasTotales[0][1]}}</td>
                                </tr>
                                <tr>
                                    <td>Restar menor al mayor</td>
                                    @if($sumasTotales[0][0]>$sumasTotales[0][1])
                                        <td colspan="2">{{$sumasTotales[0][0]-$sumasTotales[0][1]}}</td>
                                    @else
                                        <td colspan="2">{{$sumasTotales[0][1]-$sumasTotales[0][0]}}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Asignar letra mayor</td>
                                    @if($sumasTotales[0][0]>$sumasTotales[0][1])
                                        <td colspan="2">{{$sumasTotales[0][0]-$sumasTotales[0][1].'A'}}</td>
                                    @else
                                        <td colspan="2">{{$sumasTotales[0][1]-$sumasTotales[0][0].'B'}}</td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 col-sm-6 table-responsive">
                            <h5>SENS-INT</h5>
                            <table class="table table-dark table-bordered">
                                <thead>
                                <th colspan="1"></th>
                                <th>A</th>
                                <th>B</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        Total columna
                                    </td>
                                    <td>{{$sumasTotales[1][0]}}</td>
                                    <td>{{$sumasTotales[1][1]}}</td>
                                </tr>
                                <tr>
                                    <td>Restar menor al mayor</td>
                                    @if($sumasTotales[1][0]>$sumasTotales[1][1])
                                        <td colspan="2">{{$sumasTotales[1][0]-$sumasTotales[1][1]}}</td>
                                    @else
                                        <td colspan="2">{{$sumasTotales[1][1]-$sumasTotales[1][0]}}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Asignar letra mayor</td>
                                    @if($sumasTotales[1][0]>$sumasTotales[1][1])
                                        <td colspan="2">{{$sumasTotales[1][0]-$sumasTotales[1][1].'A'}}</td>
                                    @else
                                        <td colspan="2">{{$sumasTotales[1][1]-$sumasTotales[1][0].'B'}}</td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 table-responsive">
                            <h5>VIS-VERB</h5>
                            <table class="table table-dark table-bordered">
                                <thead>
                                <th colspan="1"></th>
                                <th>A</th>
                                <th>B</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        Total columna
                                    </td>
                                    <td>{{$sumasTotales[2][0]}}</td>
                                    <td>{{$sumasTotales[2][1]}}</td>
                                </tr>
                                <tr>
                                    <td>Restar menor al mayor</td>
                                    @if($sumasTotales[2][0]>$sumasTotales[2][1])
                                        <td colspan="2">{{$sumasTotales[2][0]-$sumasTotales[2][1]}}</td>
                                    @else
                                        <td colspan="2">{{$sumasTotales[2][1]-$sumasTotales[2][0]}}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Asignar letra mayor</td>
                                    @if($sumasTotales[2][0]>$sumasTotales[2][1])
                                        <td colspan="2">{{$sumasTotales[2][0]-$sumasTotales[2][1].'A'}}</td>
                                    @else
                                        <td colspan="2">{{$sumasTotales[2][1]-$sumasTotales[2][0].'B'}}</td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 col-sm-6 table-responsive">
                            <h5>SEC-GLOB</h5>
                            <table class="table table-dark table-bordered">
                                <thead>
                                <th colspan="1"></th>
                                <th>A</th>
                                <th>B</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        Total columna
                                    </td>
                                    <td>{{$sumasTotales[3][0]}}</td>
                                    <td>{{$sumasTotales[3][1]}}</td>
                                </tr>
                                <tr>
                                    <td>Restar menor al mayor</td>
                                    @if($sumasTotales[3][0]>$sumasTotales[3][1])
                                        <td colspan="2">{{$sumasTotales[3][0]-$sumasTotales[3][1]}}</td>
                                    @else
                                        <td colspan="2">{{$sumasTotales[3][1]-$sumasTotales[3][0]}}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Asignar letra mayor</td>
                                    @if($sumasTotales[3][0]>$sumasTotales[3][1])
                                        <td colspan="2">{{$sumasTotales[3][0]-$sumasTotales[3][1].'A'}}</td>
                                    @else
                                        <td colspan="2">{{$sumasTotales[3][1]-$sumasTotales[3][0].'B'}}</td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Orientación -->
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 table-responsive">
                            <table class="table table-dark table-bordered">
                                <thead>
                                <th>Tipo aprendizaje</th>
                                <th>Valor</th>
                                </thead>
                                <tbody>
                                <tr>
                                    @if($letraCadena[0]=='A')
                                        <td>
                                            Activo
                                        </td>
                                    @else
                                        <td>
                                            Reflexivo
                                        </td>
                                    @endif
                                    <td>{{$sumasCadena[0]}}</td>
                                </tr>
                                <tr>
                                    @if($letraCadena[1]=='A')
                                        <td>
                                            Sensorial
                                        </td>
                                    @else
                                        <td>
                                            Intuitivo
                                        </td>
                                    @endif
                                    <td>{{$sumasCadena[1]}}</td>
                                </tr>
                                <tr>
                                    @if($letraCadena[2]=='A')
                                        <td>
                                            Visual
                                        </td>
                                    @else
                                        <td>
                                            Verbal
                                        </td>
                                    @endif
                                    <td>{{$sumasCadena[2]}}</td>
                                </tr>
                                <tr>
                                    @if($letraCadena[3]=='A')
                                        <td>
                                            Secuencial
                                        </td>
                                    @else
                                        <td>
                                            Global
                                        </td>
                                    @endif
                                    <td>{{$sumasCadena[3]}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
