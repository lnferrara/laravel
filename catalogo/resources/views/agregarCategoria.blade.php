@extends('layouts.plantilla')

    @section('contenido')

        <h1>Alta de una categoría</h1>

        <div class="alert bg-light border border-white shadow round col-8 mx-auto p-4">

            <form action="/agregarCategoria" method="post">
                @csrf
                <div class="form-group">
                    <label for="mkNombre">Nombre de la categoría</label>
                    <input type="text" name="catNombre"
                           class="form-control" id="catNombre" value="{{old('catNombre')}}">
                </div>
                <button class="btn btn-dark mr-3">Agregar Categoría</button>
                <a href="/adminCategorias" class="btn btn-outline-secondary">
                    Volver a panel
                </a>
            </form>
        </div>
        @include('layouts.errorValidacion')


    @endsection