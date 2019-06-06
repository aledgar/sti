@extends('layouts.app')
<style>
    th, td, thead {
        text-align: center;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Alumnos</h4>
                </div>
                <div class="card-body">
                    @if(\Illuminate\Support\Facades\Session::has('success'))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    {{\Illuminate\Support\Facades\Session::get('success')}}
                                </div>
                            </div>
                        </div>
                        <br>
                    @endif
                    @if(\Illuminate\Support\Facades\Session::has('error'))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    {{\Illuminate\Support\Facades\Session::get('error')}}
                                </div>
                            </div>
                        </div>
                        <br>
                    @endif
                    <div style="display: flex; flex-direction: row-reverse">
                        <a href="{{@route('maestro.crear-alumno',['id'=>$id])}}" class="btn btn-success">Agregar
                            alumno</a>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            @if(sizeof($alumnos)==0)
                                <div class="alert alert-danger">
                                    <h4>No hay alumnos asignados a este grupo.</h4>
                                </div>
                            @else
                                <table class="table-hover table">
                                    <thead>
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>Nombre(s)</th>
                                    <th>Apellido(s)</th>
                                    <th>Email</th>
                                    <th>Nº de lista</th>
                                    <th colspan="4">Opciones</th>
                                    </thead>
                                    <tbody>
                                    @foreach($alumnos as $key => $alumno)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td><img src="{{ asset('images/alumnos/'.$alumno->foto) }}"
                                                     alt="{{$alumno->foto}}"
                                                     style="height: 50px; width: 50px; border-radius: 50%"></td>
                                            <td>{{$alumno->name}}</td>
                                            <td>{{$alumno->lastname}}</td>
                                            <td>{{$alumno->email}}</td>
                                            <td>{{$alumno->numero_lista}}</td>
                                            <td >
                                                <a class="btn btn-primary"
                                                   href="{{@route('maestro.show-alumno',['id'=>$alumno->id])}}">Editar</a>
                                            </td>
                                            <td>
                                                <form action="{{@route('maestro.alumnos-status')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{$alumno->id}}" name="id">
                                                    <input type="hidden" value="{{$alumno->id_grupo}}" name="id_grupo">
                                                    @if($alumno->deleted == 0)
                                                        <button type="submit" class="btn btn-danger">Desactivar</button>
                                                    @else
                                                        <button type="submit" class="btn btn-success">Activar</button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td>
                                                <a class="btn btn-dark" href="{{@route('maestro-felder',['id'=>$alumno->id])}}">Felder</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-secondary" href="{{@route('maestro-conocimientos',['id'=>$alumno->id])}}">Conocimiento</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
