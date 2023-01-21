<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaga;
use Illuminate\Support\Facades\Auth;
class VagaController extends Controller
{

    public function index()
    {
        if(Auth::check()){

            $quantidadeDeItensAExibir = 5;
            $listaDeVagas = Vaga::latest()->paginate($quantidadeDeItensAExibir);
            
            return view('vaga/index',compact('listaDeVagas'))->with('i', (request()->input('page', 1) - 1) * $quantidadeDeItensAExibir );

        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
        return view('vaga/create');

        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descricao' => 'required|min:3',
            'status' => 'required',
            'arquivo' => 'required',
        ]);

        $input = $request->all();
  
        if ($arquivo = $request->file('arquivo')) {
            $destinationPath = 'arquivo/';
            $profilearquivo = date('YmdHis') . "." . $arquivo->getClientOriginalExtension();
            $arquivo->move($destinationPath, $profilearquivo);
            $input['arquivo'] = "$profilearquivo";
        }

        $vaga = Vaga::create($input);
        return redirect('/vaga')
                ->with('success', 'Vaga salvo com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vaga $vaga)
    {
        if(Auth::check()){
        return view('vaga/show', compact('vaga'));
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vaga $vaga)
    {
        if(Auth::check()){
        return view('vaga.edit',compact('vaga'));
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vaga $vaga)
    {
        $request->validate(
            [
                'titulo' => 'required|max:255',
                'descricao' => 'required|min:3',
                'status' => 'required'
            ]
        );

        $storeData =  $request->all();
  
        if ($arquivo = $request->file('arquivo')) {
            $destinationPath = 'arquivo/';
            $profilearquivo = date('YmdHis') . "." . $arquivo->getClientOriginalExtension();
            $arquivo->move($destinationPath, $profilearquivo);
            $storeData['arquivo'] = "$profilearquivo";
        }else{
            unset($storeData['arquivo']);
        }

        $vaga->update($storeData); //Método Herdado

        return redirect('/vaga')->with('success','Vaga Editada com Sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vaga $vaga)
    {
        if(Auth::check()){
        $vaga->delete();
        return redirect('/vaga')->with('success','Vaga Apagada com Sucesso');
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
