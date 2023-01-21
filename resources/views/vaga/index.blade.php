<!DOCTYPE html>
@extends('layout')

@section('content')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Status</th>
            <th width="280px">Ações</th>
        </tr>

        @foreach ($listaDeVagas as $vaga)
            <tr>
                <td>{{ $vaga->id }}</td>
                <td>{{ $vaga->titulo }}</td>
                <td>{{ $vaga->descricao }}</td>
                <td>{{ $vaga->status }}</td>
                <td>

                    <a
                        clss="btn btn-info"
                        href="{{ route('vaga.show', $vaga->id) }}"
                    >Visualizar</a>

                    <a
                        clss="btn btn-primary"
                        href="{{ route('vaga.edit', $vaga->id) }}"
                    >Editar</a>

                    <form action="{{ route('vaga.destroy', $vaga->id) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        class="btn btn-danger">Apagar</button>
                    </form>

                </td>   
            </tr>
        @endforeach
    </table>

        <a
            clss="btn btn-info"
            href="{{ route('vaga.create', $vaga->id) }}"
            >Adicionar nova vaga</a>

    {!! $listaDeVagas->links() !!}
    
@endsection