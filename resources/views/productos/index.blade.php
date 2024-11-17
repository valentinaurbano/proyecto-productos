@extends('layouts.layout')

@section('title', 'Listado de productos')

@section('content')

    <!-- Barra de navegación con botón de cerrar sesión -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('producto.index') }}">Productos</a>
            <div class="d-flex">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Encabezado -->
    <div class="row text-center">
        <h1>Productos</h1>
    </div>

    <!-- Botón para crear productos -->
    <div class="row justify-content-end mb-3">
        <div class="col-2">
            <a class="btn btn-success" href="{{ route('producto.create') }}">Crear producto</a>
        </div>
    </div>

    <!-- Tabla de productos -->
    <div class="row justify-content-center">
        <div class="col-10">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->descripcion }}</td>
                            <td>{{ $producto->precio }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a class="btn btn-primary btn-sm" href="{{ route('producto.edit', $producto->id) }}">
                                        Editar
                                    </a>
                                    <form action="{{ route('producto.delete', $producto->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Seguro que desea eliminar el registro?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
