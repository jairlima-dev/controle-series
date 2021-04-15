@extends('layout')

@section('cabecalho')
Adicionar Série
@endsection

@section('conteudo')

@include('errors')

<form method="post">
    @csrf
    <div class="row">
        <div class="col-8">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome">
            </div>
        </div>
        <div class="col-2">
            <label for="qtd_temporadas">Qtd. temporadas</label>
            <input type="number" class="form-control" name="qtd_temporadas" id="qtd_temporadas">
        </div>
        <div class="col-2">
            <label for="ep_por_temporada">Ep. por temporada</label>
            <input type="number" class="form-control" name="ep_por_temporada" id="ep_por_temporada">
        </div>
    </div>

    <button class="btn btn-primary">Salvar</button>
</form>
@endsection
