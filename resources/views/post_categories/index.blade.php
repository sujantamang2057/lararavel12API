@extends('layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Index POstCatgeory</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right">
                        {{ __('common::crud.create') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @if (Session::has('success'))
            <div class="success"></div>

            {{ Session::get('success') }}
        @elseif(Session::has('warning'))
            <div class="warning"></div>
            {{ Session::get('warning') }}
        @endif
        <div class="clearfix"></div>

        <div class="card">
        </div>
    </div>
@endsection
