@extends('layouts.app')

@if (Session::has('msj'))
    {{ Session::get('msj') }}
@endif

@section('template_title')
    Team Work
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Equipo de trabajo') }}
                            </span>

                            <form action="{{ route('team-works.index') }}" method="get" class="d-flex align-items-center">
                                <div class="col-auto mr-2">
                                    <input type="text" class="form-control" name="search" id="search"
                                        placeholder="Buscar...">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
                                </div>
                            </form>
                            <div class="float-right">
                                <a href="{{ route('pdf.teamwork') }}" class="btn btn-danger btn-sm float-right">
                                    <i class="fa fa-file-pdf"></i> {{ __('PDF') }}
                                </a>

                                <a href="{{ route('excel.teamwork') }}" class="btn btn-success btn-sm float-right">
                                    <i class="fa fa-file-excel"></i> {{ __('Excel') }}
                                </a>
                            </div>
                            <div class="float-right">
                                <a href="{{ route('team-works.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Crear equipo de trabajo') }}
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
                                        <th>Id</th>
                                        <th>Especialidad</th>
                                        <th>Trabajo asignado</th>
                                        <th>Fecha asignada</th>
                                        <th>Proyecto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teamWorks as $teamWork)
                                        <tr>
                                            <td>{{ $teamWork->id }}</td>
                                            <td>{{ $teamWork->specialty }}</td>
                                            <td>{{ $teamWork->assigned_work }}</td>
                                            <td>{{ $teamWork->assigned_date }}</td>
                                            <td>{{ $teamWork->project->name }}</td>
                                            <td>
                                                <form action="{{ route('team-works.destroy', $teamWork->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('team-works.show', $teamWork->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('team-works.edit', $teamWork->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('¿Está seguro de que desea cambiar el estado de este equipo de trabajo?')"
                                                        class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i>
                                                        {{ __('Cambiar estado') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $teamWorks->links() !!}
            </div>
        </div>
    </div>
@endsection
