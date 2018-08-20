<?php

namespace App\Http\Controllers;

use App\Tarefa;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class TarefasController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $tarefas = Tarefa::orderBy('ordem', 'asc')->get();
        return view('tarefas.index',['tarefas' => $tarefas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('tarefas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
		$ultima_ordem = DB::table('tarefas')->latest()->first();
		
        $tarefa = new Tarefa();
        $tarefa->nome_tarefa = Input::get('nome_tarefa');
        $tarefa->custos = Input::get('custo');
        $tarefa->data_limite = Input::get('dt_limite');

        if($ultima_ordem === null){
            $tarefa->ordem = 1;
        }else{
            $tarefa->ordem = ($ultima_ordem -> ordem)+1;
        }

        try{
            $tarefa->save();
        }catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return view('tarefas.create', ['error' => 'Tarefa já existente']);
            }
        }

        return redirect()->route('tarefas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $tarefa = Tarefa::find($id);
		
		return view('tarefas.edit',[
            'id' => $tarefa->id,
            'nome_tarefa' => $tarefa->nome_tarefa,
            'custos' => $tarefa->custos,
            'dt_limite' => $tarefa->data_limite
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $tarefa = Tarefa::find($id);
        $tarefa->nome_tarefa = Input::get('nome_tarefa');
        $tarefa->custos = Input::get('custo');
        $tarefa->data_limite = Input::get('dt_limite');

        try{
            $tarefa->save();
        }catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return view('tarefas.edit', [
                    'error' => 'Tarefa já existente',
                    'id' => $tarefa->id,
                    'nome_tarefa' => $tarefa->nome_tarefa,
                    'custos' => $tarefa->custos,
                    'dt_limite' => $tarefa->data_limite
                ]);
            }
        }
        return redirect()->route('tarefas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $tarefa = Tarefa::find($id);
        $tarefa->delete();

		return redirect()->back()->with('success','Member deleted');
		
        //return redirect()->route('tarefas.index');
    }
	
	public function reorder(){
		//return response()->view('tarefas.index')->setStatusCode(200);
				
		return DB::table('tarefas')->where('id', '=', $itemId)->update('ordem' => $ordem);
	}
}
