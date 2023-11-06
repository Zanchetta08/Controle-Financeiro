@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" class="d-inline-flex">
                <h3 class="d-flex justify-content-center">Renda total:</h3>
                    <h4 class="d-flex justify-content-center">R$ {{ Auth::user()->renda }}</h4>
                    <button type="button" class="btn btn-primary d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#exampleModal">Alterar renda</button>

                <!-- Modal -->
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
                                <div>
                                    <label for="renda">Renda em reais:</label><br>
                                    <input type="number" id="quantity" class="form-control" name="renda">
                                </div>
                            
                                <input type="submit" class="btn btn-primary" value="Inserir renda">
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#categoriaModal">+ Nova Categoria</button>
                <!-- Modal -->
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
                                <div>
                                    <label for="nomecategoria">Nome Categoria:</label><br>
                                    <input type="text" id="nomecategoria" class="form-control" name="nomecategoria">
                                </div>
                                <div>
                                    <label for="valorcategoria">Valor Máximo da Categoria:</label><br>
                                    <input type="text" id="valorcategoria" class="form-control" name="valorcategoria">
                                </div>
                                <div>
                                    <label for="valoreconomia">Valor da Meta de Economia:</label><br>
                                    <input type="text" id="valoreconomia" class="form-control" name="valoreconomia">
                                </div>
                                <input  type="submit" class="btn btn-primary" value="Criar Categoria">
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#despesaModal">+ Nova Despesa</button>
            <!-- Modal -->
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
                            <div>
                                <label for="nomeDespesa">Nome Despesa:</label><br>
                                <input type="text" id="nomeDespesa" class="form-control" name="nomeDespesa">
                            </div>
                            <div>
                                <label for="valorDespesa">Valor Da Despesa:</label><br>
                                <input type="text" id="valorDespesa" class="form-control" name="valorDespesa">
                            </div>
                            @foreach($categorias as $categoria)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="categoria" id="flexRadioDefault1" value="{{ $categoria->id }}">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        {{ $categoria->nome }}
                                    </label>
                                </div>
                            @endforeach
                            <input  type="submit" class="btn btn-primary" value="Criar Despesa">
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        <div>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Despesa</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Editar/Deletar Categoria</th>
                    <th scope="col">Deletar Despesa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($despesas as $despesa)
                        <tr>
                            <td>{{ $despesa->nome }}</td>
                            <td>R${{ $despesa->valor }}</td>
                            <td>{{ $despesa->categoria->nome }}</td>
                            <td>
                                <a href="/categorias/edit/{{ $despesa->categoria->id }}" class="btn btn-primary">Editar</a>
                                <form action="/categorias/{{ $despesa->categoria->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><ion-icon name="trash-outline"></ion-icon> Deletar</button>
                                </form> 
                            </td>
                            <td>
                                <form action="/despesas/{{ $despesa->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><ion-icon name="trash-outline"></ion-icon> Deletar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h3 class="d-flex justify-content-center">Alertas</h3>
            @foreach($somaValoresPorCategoria as $somaValor)
                <p class="d-flex justify-content-center text-danger"><strong>A categoria {{ $somaValor['nome']}} está com um valor acumulado de 80% ou mais! Valor total até agora: R${{ $somaValor['somaValores'] }}</strong></p>
            @endforeach
            @foreach($naoAtingiu as $nao)
                <p class="d-flex justify-content-center text-danger"><strong>A categoria {{ $nao['nome']}} não conseguiu atingir sua meta de economia, passando em: R${{ $nao['passou'] }}</strong></p>
            @endforeach
        </div>
    </div>
</div>
@endsection