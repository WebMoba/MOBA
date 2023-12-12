@extends('layouts.app')

@section('template_title')
    Person
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Person') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('person.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
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

										<th>Id Card</th>
										<th>Addres</th>
										<th>Team Works Id</th>
										<th>Number Phones Id</th>
										<th>Towns Id</th>
										<th>Users Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($people as $person)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $person->id_card }}</td>
											<td>{{ $person->addres }}</td>
											<td>{{ $person->teamWork ? $person->teamWork->assigned_work : 'N/A'}}</td>
											<td>{{ $person->numberPhone ? $person->numberPhone->number : 'N/A'}}</td>
											<td>{{ $person->town ? $person->town->name : 'N/A'}}</td>
											<td>{{ $person->user ? $person->user->email: 'N/A' }}</td>

                                            <td>
                                                <form action="{{ route('person.destroy',$person->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('person.show',$person->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('person.edit',$person->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $people->links() !!}
            </div>
        </div>
    </div>
@endsection
