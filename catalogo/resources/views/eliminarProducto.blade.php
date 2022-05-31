@extends('layouts.plantilla')

@section('contenido')

<h1>Baja de un producto</h1>

<div class="row alert bg-light border-danger col-8 mx-auto p-2">
    <div class="col">
        <img src="/productos/{{$producto->prdImagen}}" class="img-thumbnail">
    </div>
    <div class="col text-danger align-self-center">
        <form action="/eliminarProducto" method="post">
            @method('delete')
            @csrf
            <h2>{{$producto->prdNombre}}</h2>
            Categoría: {{$producto->getCategoria->catNombre}} <br>
            Marca: {{$producto->getMarca->mkNombre}} <br>
            Presentación: {{$producto->prdPresentacion}} <br>
            Precio: $ {{$producto->prdPrecio}}

            <input type="hidden" name="idProducto" value={{$producto->idProducto}}>
            <button class="btn btn-danger btn-block my-3">Confirmar baja</button>
            <a href="/adminProductos" class="btn btn-outline-secondary btn-block">
                Volver a panel
            </a>

        </form>
    </div>

    <script>
        
                Swal.fire(
                    'Advertencia',
                    'Si pulsa el botón confirmar baja se eliminará el producto seleccionado',
                    'warning'
                )
               
    </script>


    @endsection