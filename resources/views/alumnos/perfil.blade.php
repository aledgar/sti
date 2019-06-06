@extends('layouts.app')
@section('content')
    @extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Perfil</h4>
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
                        @if(\Illuminate\Support\Facades\Session::has('success'))
                            <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    {{\Illuminate\Support\Facades\Session::get('success')}}
                                </div>
                            </div>
                        </div>
                    @endif
                    <form action="{{@route('alumno-perfil.editar')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_alumno" value="{{$alumno->id}}">
                        <input type="hidden" name="id_usuario" value="{{$alumno->user->id}}">
                        {{--                        <input type="hidden" name="id_grupo" value="{{$id_grupo}}">--}}
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Nombre:</label>
                                <input type="text" value="{{$alumno->user->name}}" name="nombre" placeholder="Nombre:"
                                       class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Apellido:</label>
                                <input value="{{$alumno->user->lastname}}" type="text" name="apellido"
                                       placeholder="Apellido:" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Email:</label>
                                <input type="email" name="email" value="{{$alumno->user->email}}" placeholder="Email:"
                                       id="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Contraseña:</label>
                                <input type="password" value="123456789" class="form-control"
                                       name="password" placeholder="Contraseña:"
                                       id="">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Foto del alumno:</label>
                                <div>
                                    <img src="{{@asset('images/alumnos/'.$alumno->foto)}}" style="width: 40px; height: 40px;" alt="">
                                </div>
                                <input type="file" name="foto" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Número de lista:</label>
                                <input type="number" class="form-control" value="{{$alumno->numero_lista}}" min="1"
                                       name="numero_lista"
                                       placeholder="Nº de lista:" id="">
                            </div>
                        </div>
                        <br>
                        <div class="row" style="margin-bottom: 10px">
                            <div class="col-md-12">
                                <button class="btn btn-success">Editar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@endsection
