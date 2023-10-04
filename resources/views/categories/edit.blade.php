@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar Categoria</h2>
        <form method="POST" action="{{ route('categories.update', $category) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
            </div>
            <div class="form-group">
                <label for="value">Valor:</label>
                <input type="number" name="value" id="value" class="form-control" value="{{ $category->value }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar Categoria</button>
        </form>
    </div>
@endsection
