<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function portada()
    {
        $Producto = Producto::with(['getMarca', 'getCategoria'])->paginate(5);

        return view('portada', ['productos' => $Producto]);
    }

    public function index()
    {
        $Producto = Producto::with(['getMarca', 'getCategoria'])->paginate(5);

        return view('adminProductos', ['productos' => $Producto]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Marca::all();
        $categorias = Categoria::all();
        return view('agregarProducto', ['marcas' => $marcas, 'categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidarForm($request);
        $prdImagen = $this->subirImagen($request);
        $producto = new Producto();
        
        $producto->prdNombre = $request->prdNombre;
        $producto->prdPrecio = $request->prdPrecio;
        $producto->idMarca = $request->idMarca;
        $producto->idCategoria = $request->idCategoria;
        $producto->prdPresentacion = $request->prdPresentacion;
        $producto->prdStock = $request->prdStock;
        $producto->prdImagen = $prdImagen;
        
        $producto->save();

        return redirect('adminProductos')->with(['mensaje'=>"El producto $request->prdNombre agregado correctamente "]);
    }

    private function subirImagen(Request $request)
    {   //si no se envió imagen
        $prdImagen = 'noDisponible.jpg';
        
        
        //solo en modificar
        if( $request->has('imgActual')){
            $prdImagen = $request->imgActual;
        }

        if ($request->file('prdImagen')) {
            $extension = $request->file('prdImagen')->extension();
            $prdImagen = time() . '.' . $extension;
            //subir archivo
            $request->files('prdImagen')->move(public_path('productos/'), $prdImagen);
        }
        return $prdImagen;
    }




    private function ValidarForm(Request $request)
    {
        $request->validate(
            [
                'prdNombre' => 'required|min:2|max:60|unique:App\Models\Producto',
                'prdPrecio' => 'required|numeric|min:0|',
                'idMarca' => 'required',
                'idCategoria' => 'required',
                'prdPresentacion' => 'required|min:2|max:200',
                'prdStock' => 'required|integer|min:0',
                'prdPresentacion' => 'required|min:2|max:200',
                'prdImagen' => 'mimes:jpg,jpeg,svg,png,webp|max:2048'



            ],

            [
                'prdNombre.required' => 'El campo Nombre de la Marca es obligatorio',
                'prdNombre.min' => 'El campo debe tener 2 carácteres como minimo.',
                'prdNombre.max' => 'El campo debe tener 60 carácteres como máximo.',
                'prdNombre.unique' => 'El campo Nombre de la marca no puede repetirse.'
            ]
        );
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $producto = Producto::find($id);
        $marcas = Marca::all();
        $categorias = Categoria::all();
        return view('modificarProducto',
        [
            'producto'=>$producto , 
            'marcas' => $marcas , 
            'categorias'=>$categorias
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->ValidarForm($request);
        $prdImagen = $this->subirImagen($request);
        $producto = Producto::find($request->idProducto);
        
        $producto->prdNombre = $request->prdNombre;
        $producto->prdPrecio = $request->prdPrecio;
        $producto->idMarca = $request->idMarca;
        $producto->idCategoria = $request->idCategoria;
        $producto->prdPresentacion = $request->prdPresentacion;
        $producto->prdStock = $request->prdStock;
        $producto->prdImagen = $prdImagen;

        $producto->save();

        return redirect('adminProductos')->with(['mensaje'=>"El producto $request->prdNombre modificado con éxito."]);
    }


    public function confirmarBaja($id)
    {
        $producto = Producto::with(['getCategoria', 'getMarca'])->find($id);
        return view('eliminarProducto', ['producto' => $producto]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $producto = Producto::destroy($request->idProducto);
        return redirect('adminProductos')->with(['danger'=> "Producto eliminado con éxito."]);
    }
}
