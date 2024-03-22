@extends('layouts.app')

@section('template_title')
    Categorias
@endsection

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Categorias') }}
                            </span>
                            <a href="{{ route('pdf.categories-products-service') }}" class="btn btn-info btn-sm float-right">
                                <i class="fa fa-file-pdf"></i> {{ __('Generar PDF') }}
                            </a>
                            <form action="{{ route('categories-products-service.index') }}" method="GET"
                                class="d-flex align-items-center">
                                <div class="col-auto mr-2">
                                    <input type="text" class="form-control " id="search" name="search" ></div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
                                    </div>
                            </form>

                            <div class="float-right">
                                <a href="{{ route('categories-products-service.create') }}"
                                    class="btn btn-primary btn-sm float-right" data-placement="left">
                                    {{ __('Crear Categoria') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>

                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Estado</th>
                                            <th>Cantidad</th>
                                            <th>Popularidad</th>
                                            <th>Tipo</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categoriesProductsServices as $categoriesProductsService)
                                            <tr>
                                                <td>{{ ++$i }}</td>

                                                <td>{{ $categoriesProductsService->name }}</td>
                                                <td>{{ $categoriesProductsService->description }}</td>
                                                <td>{{ $categoriesProductsService->status }}</td>
                                                <td>{{ $categoriesProductsService->quantity }}</td>
                                                <td>{{ $categoriesProductsService->popular }}</td>
                                                <td>{{ $categoriesProductsService->type }}</td>

                                                <td>
                                                    <form
                                                        action="{{ route('categories-products-service.destroy', $categoriesProductsService->id) }}"
                                                        method="POST">
                                                        <a class="btn btn-sm btn-primary "
                                                            href="{{ route('categories-products-service.show', $categoriesProductsService->id) }}"><i
                                                                class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('categories-products-service.edit', $categoriesProductsService->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm ('¿Esta seguro que de que desea Eliminar la Categoria?')"><i
                                                                class="fa fa-fw fa-trash"></i>
                                                            {{ __('Eliminar') }}</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {!! $categoriesProductsServices->links() !!}
                </div>
            </div>
        </div>
    @endsection