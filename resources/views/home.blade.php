@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gerenciador de Despesas</h1>

    <h2>Categorias</h2>
    <form action="/categories" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nome da Categoria" required>
        <input type="number" name="value" placeholder="Valor da Categoria" required>
        <button type="submit">Adicionar Categoria</button>
    </form>

    <h2>Despesas</h2>
    <table id="expenses">
        <tr>
            <th>Categoria</th>
            <th>Valor</th>
            <th>Ações</th>
        </tr>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->value }}</td>
                <td>
                <a href="/categories/{{ $category->id }}" class="btn btn-primary">Editar</a>
                    <form action="/categories/{{ $category->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Apagar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
