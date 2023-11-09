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

    @foreach($categorias as $categoria)
        <div class="form-check">
            <input class="form-check-input" type="radio" name="categoria" id="categoria{{ $categoria->id }}" value="{{ $categoria->id }}" @if($despesa->categoria && $despesa->categoria->id == $categoria->id) checked @endif>
            <label class="form-check-label" for="categoria{{ $categoria->id }}">
                {{ $categoria->nome }}
            </label>
        </div>
    @endforeach
</div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    </div>
@endsection
