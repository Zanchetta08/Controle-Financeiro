@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Editar Despesa</h3>

        <form action="/despesas/update/{{ $despesa->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nome">Nome da Despesa</label>
                <input type="text" id="nome" name="nome" value="{{ $despesa->nome }}">
            </div>

            <div class="form-group">
                <label for="valor">Valor da Despesa</label>
                <input type="text" id="valor" name="valor" value="{{ $despesa->valor }}">
            </div>

            <div class="form-group">
                <label for="categoria">Categoria da Despesa</label>
                <input type="text" id="categoria" name="categoria" value="{{ $despesa->categoria->nome }}">
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    </div>
@endsection
