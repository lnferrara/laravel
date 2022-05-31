<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtenemos listado de categorias
        $categorias = Categoria::paginate(5);
        return view('adminCategorias', ['categorias'=>$categorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agregarCategoria');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validarForm($request);
       $Categoria = new Categoria();
       $Categoria->catNombre = $catNombre = $request->catNombre;
       $Categoria->save();
       return redirect('/adminCategorias')->with(['mensaje'=>"La categoria $catNombre fue ingresada con éxito."]);
    }

private function validarForm(Request $request)
{   
    $request->validate(
    ['catNombre' => 'required|min:2|max:60|unique:App\Models\Categoria'],
    ['catNombre.required'=> "El campo Nombre de la categoria es obligatorio.",
    'catNombre.min'=> "El campo Nombre de la categoria debe contener al menos 2 carácteres.",
    'catNombre.max'=> "El campo Nombre de la categoria no puede superar los 60 carácteres.",
    'catNombre.unique'=> "La categoria ingresada ya existe."]
    
);

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);
        return view('modificarCategoria', ['categoria' =>$categoria]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
