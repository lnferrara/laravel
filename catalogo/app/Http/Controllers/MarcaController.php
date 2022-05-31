<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtenemos listado de marcas
        $marcas = Marca::paginate(5);
        return view('adminMarcas', ['marcas'=> $marcas]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agregarMarca');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   //capturamos datos
       /*  $mkNombre = $request->mkNombre; */
         //validación
        $this->ValidarForm( $request );
        //instanciamos objeto y le asignamos atributos
        $Marca = new Marca(); 
        $Marca->mkNombre = $mkNombre = $request->mkNombre;
        //guardar en tabla marcas
        $Marca ->save();
        //redireccionamos con msj de ok
        return redirect('/adminMarcas')->with(['mensaje' => "Marca: $mkNombre ingresada correctamente"]);
    }

    private function ValidarForm(Request $request)
    {
        $request->validate(
            ['mkNombre'=> 'required|min:2|max:60|unique:App\Models\Marca'],
            ['mkNombre.required'=>'El campo Nombre de la Marca es obligatorio',
            'mkNombre.min' => 'El campo debe tener 2 carácteres como minimo.',
            'mkNombre.max' => 'El campo debe tener 60 carácteres como máximo.',
            'mkNombre.unique' => 'El campo Nombre de la marca no puede repetirse.'
            ]
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
        $Marca = Marca::find($id);
        return view('modificarMarca', ['Marca'=>$Marca]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->ValidarForm($request);
        //obtenemos los datos que llegan por el form
        $Marca = Marca::find($request->idMarca);
        //modificamos el nombre
        $Marca->mkNombre = $mkNombre = $request->mkNombre;
        $Marca->save();
        return redirect('/adminMarcas')->with(['mensaje'=> "La marca $mkNombre fue ingresada correctamente"]);
    }

    
    
    private function productoPorMarca($idMarca)
    {
        $check = Producto::firstWhere('idMarca', $idMarca);
        return $check;
    }
    
    public function confirmarBaja($id)
    {
        //obtenemos los datos de una marca
        $Marca = Marca::find($id);

        //si no hay prod retornamos vista de confirmación
        if(!$this->productoPorMarca($id)){
            return view('eliminarMarca', ['Marca'=>$Marca]);
        }else{
            return redirect('/adminMarcas')->with(['alerta'=> "No se puede eliminar la marca $Marca->mkNombre porque tiene productos asociados."]);
        }

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //eliminamos
        $Marca = Marca::destroy($request->idMarca);
        return redirect('/adminMarcas')->with(['danger'=> "La marca $request->mkNombre ha sido eliminada."]);
    }
}
