@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h4>Editar maestro</h4>
            </div>
            <div class="card-body">
                <maestro-editar :maestro_editar="{{$maestro}}"></maestro-editar>
            </div>
        </div>
    </div>
@endsection
