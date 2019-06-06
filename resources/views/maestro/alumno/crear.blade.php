@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Alta alumno</h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    <h4>Error(es)!</h4>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endif
                    <form action="{{@route('maestro.store-alumno')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_grupo" value="{{$id_grupo}}">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Nombre:</label>
                                <input type="text" name="nombre" placeholder="Nombre:" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Apellido:</label>
                                <input type="text" name="apellido" placeholder="Apellido:" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Email:</label>
                                <input type="email" name="email" placeholder="Email:" id="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Contraseña:</label>
                                <input type="password" class="form-control" name="password" placeholder="Contraseña:"
                                       id="">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Foto del alumno:</label>
                                <input type="file" name="foto" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Número de lista:</label>
                                <input type="number" class="form-control" min="1" name="numero_lista"
                                       placeholder="Nº de lista:" id="">
                            </div>
                        </div>
                        <br>
                        <div class="row" style="margin-bottom: 10px">
                            <div class="col-md-12">
                                <button class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
