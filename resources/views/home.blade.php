@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3 class="text-center">Renda total:</h3>
                <h4 class="text-center">R$ {{ Auth::user()->renda }}</h4>
                <button type="button" class="btn btn-primary d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#exampleModal">Alterar renda</button>
                <button type="button" class="btn btn-primary d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#categoriaModal">+ Nova Categoria</button>
                <button type="button" class="btn btn-primary d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#despesaModal">+ Nova Despesa</button>

                <!-- Modal para alterar renda -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Altere a renda</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/renda" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="renda">Renda em reais:</label>
                                        <input type="number" id="renda" class="form-control" name="renda">
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Inserir renda">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para adicionar nova categoria -->
                <div class="modal fade" id="categoriaModal" tabindex="-1" aria-labelledby="categoriaModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="categoriaModalLabel">Adicione uma Categoria</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/categorias" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nomecategoria">Nome Categoria:</label>
                                        <input type="text" id="nomecategoria" class="form-control" name="nomecategoria">
                                    </div>
                                    <div class="form-group">
                                        <label for="valorcategoria">Valor Máximo da Categoria:</label>
                                        <input type="text" id="valorcategoria" class="form-control" name="valorcategoria">
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Criar Categoria">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para adicionar nova despesa -->
            <div class="modal fade" id="despesaModal" tabindex="-1" aria-labelledby="despesaModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="despesaModalLabel">Adicione uma Despesa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/despesas" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="nomeDespesa">Nome Despesa:</label>
                                    <input type="text" id="nomeDespesa" class="form-control" name="nomeDespesa">
                                </div>
                                <div class="form-group">
                                    <label for="valorDespesa">Valor Da Despesa:</label>
                                    <input type="text" id="valorDespesa" class="form-control" name="valorDespesa">
                                </div>
                                @foreach($categorias as $categoria)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="categoria" id="categoria{{ $categoria->id }}" value="{{ $categoria->id }}">
                                        <label class="form-check-label" for="categoria{{ $categoria->id }}">
                                            {{ $categoria->nome }}
                                        </label>
                                    </div>
                                @endforeach
                                <input type="submit" class="btn btn-primary" value="Criar Despesa">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>
<div class="container">
    <div class="justify-content-center">
        <table class="table card">
            <thead>
                <tr>
                    <th scope="col">Despesas:</th>
                    <!--<th scope="col">Valor</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Detalhes</th>-->
                </tr>
            </thead>
            <tbody>
                <tr> <!-- Abra uma linha de tabela fora do loop -->
                    @foreach($despesas as $despesa)
                    <td> <!-- Abra uma célula de tabela para cada despesa -->
                        <div class="clickable-row" data-bs-toggle="modal" data-bs-target="#despesaModal{{ $despesa->id }}">
                            {{ $despesa->nome }}
                        </div>
                        <!--<td>R${{ $despesa->valor }}</td>
                        <td>{{ $despesa->categoria->nome }}</td>
                        <td>
                            <button type="button" class="btn btn-primary">
                                Ver Detalhes
                            </button>
                        </td>-->
                    </td>
                    @endforeach
                </tr> <!-- Feche a linha de tabela fora do loop -->
            </tbody>
        </table>
    </div>
</div>
<div>
    <h3 class="d-flex justify-content-center">Alertas</h3>
    @foreach($somaValoresPorCategoria as $somaValor)
        <p class="d-flex justify-content-center text-danger"><strong>A categoria {{ $somaValor['nome'] }} está com um valor acumulado de 80% ou mais! Valor total até agora: R${{ $somaValor['somaValores'] }}</strong></p>
    @endforeach
</div>


@foreach($despesas as $despesa)
    <!-- Modal para exibir detalhes da despesa -->
    <div class="modal fade" id="despesaModal{{ $despesa->id }}" tabindex="-1" aria-labelledby="despesaModalLabel{{ $despesa->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="despesaModalLabel{{ $despesa->id }}">Detalhes da Despesa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nome da Despesa:</strong> {{ $despesa->nome }}</p>
                    <p><strong>Valor da Despesa:</strong> R${{ $despesa->valor }}</p>
                    <p><strong>Categoria:</strong> {{ $despesa->categoria->nome }}</p>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-primary">Editar Despesa</button>
                    <form action="/despesas/{{ $despesa->id }}" method="POST">-->
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Deletar Despesa</button>
                    </form>
                    <a href="/categorias/edit/{{ $despesa->categoria->id }}" class="btn btn-primary">Editar Categoria</a>
                    <form action="/categorias/{{ $despesa->categoria->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><ion-icon name="trash-outline"></ion-icon> Deletar Categoria</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>
@endsection
