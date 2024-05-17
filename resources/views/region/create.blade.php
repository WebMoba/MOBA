@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Region
@endsection

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Menu'])
    <section class="content container-fluid">
    <div class="container"> <!-- Agregar contenedor -->
            <div class="row justify-content-center"> 
            <div class="col-md-8">


                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Region</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('regions.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('region.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    @include('layouts.footers.auth.footer')
@endsection