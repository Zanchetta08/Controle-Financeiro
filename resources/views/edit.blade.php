@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" class="d-inline-flex">
                <div>
                    <h3 class="d-flex justify-content-center">Edite a Categoria:</h3>
                    <form action="/categorias/update/{{ $categoria->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label>Nome Categoria:</label><br>
                            <input type="text" class="form-control" name="editnomecategoria" value="{{ $categoria->nome }}">
                        </div>
                        <div>
                            <label>Valor Máximo da Categoria:</label><br>
                            <input type="text" class="form-control" name="editvalorcategoria" value="{{ $categoria->value }}">
                        </div>
                            <input  type="submit" class="btn btn-primary" value="Editar Categoria">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection