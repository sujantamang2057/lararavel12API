@extends('layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>@@{{ __('models/{{ $config->modelNames->camelPlural }}.plural')}}</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right" href="@{{ route('{!! config->prefixes->getRoutePrefixWith('.
    ') !!}{!! $config->modelNames->camelPlural !!}.create') }}">
                        {{ __('common::crud.create') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @@include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            {!! $table !!}
        </div>
    </div>

    @@endsection
