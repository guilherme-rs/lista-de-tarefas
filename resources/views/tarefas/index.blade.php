@extends('layouts.welcome')
@section('titulo', 'Pagina de Tarefas')
@section('conteudo')
    <h1> Tarefas </h1>      
    <table class="table table-hover">
        <thead>
            <th> ID </th>
            <th> Nome da Tarefa </th>
            <th> Custos(R$) </th>
            <th> Data Limite </th>
            <th> Opções </th>
        </thead>
        <tbody id="tablebody">
            @forelse($tarefas as $item)
                @if($item -> custos >= 1000)
                    <tr style="background-color: yellow">
                @else
                    <tr>
                @endif
                    <td> {{ $item -> id }} </td>
                    <td> {{ $item -> nome_tarefa }} </td>
                    <td> {{ $item -> custos }} </td>
                    <td> {{ $item -> data_limite }} </td>
                    <td class="opcoes">
                        <a href="{{ route('tarefas.edit', ['id' => $item->id]) }}" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil"></span> Editar
                        </a>
                   </td>
				   <td>
                        <form class="delete" method="post" action="{{ route('tarefas.destroy',['id' => $item->id]) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" data-toggle="confirmation" type="button"> 
								<span class="glyphicon glyphicon-trash"></span> Excluir 
							</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" align="center"> Nenhuma tarefa cadastrada. </td>
                </tr>
            @endforelse
        </tbody>
    </table>
	<a href="{{ route('tarefas.create') }}" class="btn btn-secondary">
        <span class="glyphicon glyphicon-plus"><strong> Adicionar </strong></span>
    </a>
	<script>
		$("#tablebody").sortable({
			items: "tr",
			cursor: 'move',
			opacity: 0.6			
		});
	</script>
@endsection