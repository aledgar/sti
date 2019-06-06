@extends('layouts.app')
<style>
    thead, td{
        text-align: center;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Reporte conomiento: {{$alumno->name.' '.$alumno->lastname}} </h4>
                </div>
                <div class="card-body">
                    <div class="col-md-6" style="margin: auto">
                            <h4>Respuestas correctas e incorrectas</h4>
                            <table class="table table-dark table-bordered">
                                <thead>
                                <th>Correctas 👍🏼</th>
                                <th>Incorrectas 👎🏼</th>
                                </thead>
                                <tbody>
                                    <td>{{$correctas}}</td>
                                    <td>{{$incorrectas}}</td>
                                </tbody>
                            </table>
                        </div>
                    <br>
                    <div class="col-md-6" style="margin: auto">
                        <h4>Respuestas correctas por nivel</h4>
                        <table class="table table-dark table-bordered">
                            <thead>
                                <th>Nivel basico 😋</th>
                                <th>Nivel intermedio 😌</th>
                                <th>Nivel avanzado 😎</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$pSeccion}}</td>
                                    <td>{{$sSeccion}}</td>
                                    <td>{{$tSeccion}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    {{--    <script src="{{@asset('js/chartjs.js')}}"></script>--}}
@endsection
