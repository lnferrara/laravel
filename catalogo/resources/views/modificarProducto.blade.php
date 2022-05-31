@extends('layouts.plantilla')

@section('contenido')


<h1>Modificación de un producto</h1>

<div class="alert bg-light border border-white shadow round col-8 mx-auto p-4">

    <form action="/modificarProducto" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        Nombre: <br>
        <input type="text" name="prdNombre" class="form-control" value="{{old('prdNombre', $producto->prdNombre)}}">
        <br>
        Precio: <br>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">$</div>
            </div>
            <input type="number" name="prdPrecio" class="form-control" step="0.01" value="{{old('prdPrecio',$producto->prdPrecio)}}" >
        </div>
        <br>
        Marca: <br>
        <select name="idMarca" class="form-control">
            <option value="">Seleccione una marca</option>
            @foreach ($marcas as $marca)
            <option {{(old('idMarca', $producto->idMarca)==$marca->idMarca? "selected":"")}}   value="{{$marca->idMarca}}">{{$marca->mkNombre}}</option>

            @endforeach
        </select>
        <br>
        Categoría: <br>
        <select name="idCategoria" class="form-control">
            <option value="">Seleccione una Categoría</option>
            @foreach ($categorias as $categoria)
            <option {{(old('idCategoria', $producto->idCategoria)==$categoria->idCategoria? "selected":"")}}   value="{{$categoria->idCategoria}}">{{$categoria->catNombre}}</option>

            @endforeach
        </select>
        <br>
        Presentacion: <br>
        <textarea name="prdPresentacion" class="form-control" >{{old('prdPresentacion',$producto->prdPresentacion)}}</textarea>
        <br>
        Stock: <br>
        <input type="number" name="prdStock" class="form-control" min="0" value="{{old('prdStock',$producto->prdStock)}}">
        <br>
        Imagen actual: <br>
        <figure class="d-flex justify-content-center">
            <img src="/productos/{{$producto->prdImagen}}"  class="img-thumbnail" alt="">
        </figure>

        <input type="hidden" name="imgActual" value="{{$producto->prdImagen}}">
        Modificar imagen (opcional):
        <div class="custom-file mt-1 mb-4">
            <input type="file" name="prdImagen" class="custom-file-input" id="customFileLang" lang="es">
            <label class="custom-file-label" for="customFileLang" data-browse="Buscar en disco">Seleccionar Archivo:
            </label>
        </div>
        <input type="hidden" name="idProducto" value="{{$producto->idProducto}}">

        <br>
        <button class="btn btn-dark mb-3">Modificar Producto</button>
        <a href="/adminProductos" class="btn btn-outline-secondary mb-3">Volver al panel de Productos</a>
    </form>

</div>

@include('layouts.errorValidacion')

@endsection