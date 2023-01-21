<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaga;

class VagaController extends Controller
{
    public function index()
    {
        $quantidadeDeItensAExibir = 5;
        $listaDeVagas = Vaga::latest()->paginate($quantidadeDeItensAExibir);
        
        return view('vaga/index',compact('listaDeVagas'))->with('i', (request()->input('page', 1) - 1) * $quantidadeDeItensAExibir );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vaga/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->validate([
            'titulo' => 'required|max:255',
            'descricao' => 'required|min:3',
            'status' => 'required'
        ]);
        $vaga = Vaga::create($storeData);
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
        return view('vaga/show', compact('vaga'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vaga $vaga)
    {
        return view('vaga.edit',compact('vaga'));
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
        {
            $request->validate([
                'name' => 'required',
                'detail' => 'required'
            ]);
      
            $input = $request->all();
      
            if ($image = $request->file('image')) {
                $destinationPath = 'images/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['image'] = "$profileImage";
            }else{
                unset($input['image']);
            }
              
            $product->update($input);
        
            return redirect()->route('products.index')
                            ->with('success','Product updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vaga $vaga)
    {
        $vaga->delete();
        return redirect('/vaga')->with('success','Vaga Apagada com Sucesso');
    }
}
