@extends('layouts.app')

@section('template_title')
    Sale
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                <div class="col-sm-12">
                    <form class="d-flex my-2" action="{{ route('sales.index') }}" method="GET">
                        <div class="mr-2">
                            <input type="text" class="form-control" name="search" placeholder="Buscar por nombre o fecha">
                        </div>
                        <div>
                            <input type="submit" class="btn btn-primary ms-2" value="Buscar">
                        </div>
                    </form>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Ventas') }}
                            </span>



                             <div class="float-right">
                                <a href="{{ route('sales.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
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
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
                                            <th>Nombre</th>
                                            <th>Fecha</th>
                                            <th>Id Persona</th>
                                            <th>Id Cotización</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        @foreach ($sales as $sale)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $sale->name }}</td>
                                                <td>{{ $sale->date }}</td>
                                                <td>{{ $sale->people_id }}</td>
                                                <td>{{ $sale->quotes_id }}</td>

                                                <td>
                                                    <form action="{{ route('sales.destroy',$sale->id) }}" method="POST">
                                                        <a class="btn btn-sm btn-primary " href="{{ route('sales.show',$sale->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                        <a class="btn btn-sm btn-success" href="{{ route('sales.edit',$sale->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                        
                                        

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $sales->links() !!}
            </div>
        </div>
    </div>
@endsection
