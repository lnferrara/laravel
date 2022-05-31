@extends('layouts.plantilla')

@section('contenido')

<h1>Panel de administración de productos</h1>

@if ( session('mensaje') )
<div class="alert alert-success">
    {{ session('mensaje') }}
</div>

@elseif ( session('alerta') )
<div class="alert alert-warning">
    {{ session('alerta') }}
</div>
@elseif(session('danger'))
<div class="alert alert-danger">
    {{ session('danger') }}
</div>
@endif 

<table class="table table-borderless table-striped table-hover">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Marca</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Presentación</th>
            <th>Imagen</th>
            <th colspan="2">
                <a href="/agregarProducto" class="btn btn-outline-secondary">
                    Agregar
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $producto)


        <tr>
            <td>{{$producto->prdNombre}}</td>
            <td>{{$producto->getMarca->mkNombre}}</td>
            <td>{{$producto->getCategoria->catNombre}}</td>
            <td>$ {{$producto->prdPrecio}}</td>
            <td>{{$producto->prdPresentacion}}</td>
            <td><img src="/productos/{{$producto->prdImagen}}" alt="{{$producto->prdImagen}}" class="img-thumbnail"> </td>
            <td>
                <a href="/modificarProducto/{{$producto->idProducto}}" class="btn btn-outline-secondary">
                    Modificar
                </a>
            </td>
            <td>
                <a href="/eliminarProducto/{{$producto->idProducto}}" class="btn btn-outline-secondary">
                    Eliminar
                </a>
            </td>
        </tr>

        @endforeach

    </tbody>
</table>

{{$productos->links()}}

@endsection