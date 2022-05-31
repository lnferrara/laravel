@extends('layouts.plantilla')

    @section('contenido')

        <h1>Modificación de una categoría</h1>

        <div class="alert bg-light border border-white shadow round col-8 mx-auto p-4">

            <form action="/modificarCategoria" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="catNombre">Nombre de la categoría</label>
                    <input type="text" name="catNombre"
                           class="form-control" id="catNombre" value="{{old('catNombre', $categoria->catNombre)}}">
                           <input type="hidden" name="idCategoria" value="{{$categoria->idCategoria}}">
                </div>
                <button class="btn btn-dark mr-3">Modificar Categoría</button>
                <a href="/adminCategorias" class="btn btn-outline-secondary">
                    Volver a panel
                </a>
            </form>
        </div>
        @include('layouts.errorValidacion')


    @endsection