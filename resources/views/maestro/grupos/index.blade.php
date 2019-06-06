@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h4>Grupos</h4>
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
                @endif
                <grupo :maestro="{{$maestro}}"></grupo>
            </div>
        </div>
    </div>
@endsection
