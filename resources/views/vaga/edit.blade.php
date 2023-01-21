<!DOCTYPE html>
@extends('layout')

@section('content')

        <div class="row">
            <div class="col-lg-12 margin-tb">
                    <div clas="pull-left">
                        <h2>Editar Vaga</h2>
                    </div>
                    <div class="pull=right">
                        <a class="btn btn-primary"
                            href="{{ route('vaga.index') }}"> voltar</a>
                    </div>
                </div>
            </div>

        @if ($errors->any())
            <div class="alert alert-danger";
                <strong Whoops!</strong> Ocorrem Erros!<br><br>
                <ul>
                    @foreach (@errors->all() as $error)
                        <li>{{$error}}</11>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('vaga.update', $vaga->id) }}" method="POST">
            @csrf 
            @method("PUT")
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="campo-titulo"
                                class="form-label">Título:</label>
                        <input type="text" id="campo-titulo" name="titulo"
                                class="form-control" placeholder="Título"
                                value="{{ $vaga->titulo }}">
                    </div>
                </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="campo-descricao"
                                class="form-label">Descrição:</label>
                        <input type="text" id="campo-descricao" name="descricao"
                                class="form-control" placeholder="Descrição"
                                value="{{ $vaga->descricao }}">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="campo-status" class="form-label">Status:</label>
                        <input type="text" id="campo-status" name="status"
                        class="form-control" placeholder="Status"
                        value="{{ $vaga->status }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">
                        Salvar</button>
                </div>
            </div>

        </form>

@endsection