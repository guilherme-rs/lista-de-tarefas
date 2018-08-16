@extends('layouts.welcome')
@section('titulo', 'Cadastro de Tarefas')
@section('conteudo')
    <div class="container">
        <div class="col-xs-8">
			@if(isset($error))
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					{{ $error }}
				</div>
			@endif
            <h1> Cadastro de Tarefas </h1>
            <form method="post" action="{{ route('tarefas.store') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="nome_tarefa">Nome da Tarefa: </label>
                    <input type="text" class="form-control" id="nome_tarefa" name="nome_tarefa">
                </div>
                <div class="form-group">
                    <label for="custo">Custo: </label>
                    <input type="number" step="any"  min="1" class="form-control" id="custo" name="custo">
                </div>
                <div class="form-group">
                    <label for="dt_limite">Data Limite: </label>
                    <input type="date" class="form-control" id="dt_limite" name="dt_limite">
                </div>
                <button type="submit" class="btn btn-default"> Cadastrar </button>
            </form>
        </div>
    </div>
@endsection