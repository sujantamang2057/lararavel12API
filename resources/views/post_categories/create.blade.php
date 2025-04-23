@extends('layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create PostCategory</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            {{-- Use POST method for store --}}
            {{ html()->form('POST', route('cmsadmin.postCategories.store'))->open() }}
            <div class="card-body">
                <div class="row">
                    @include('post_categories.fields')
                </div>
            </div>

            <div class="card-footer">
                {{ html()->submit(__('common::crud.save'))->class('btn btn-primary') }}
                <a href="{{ route('cmsadmin.postCategories.index') }}" class="btn btn-default">{{ __('common::crud.cancel') }}</a>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
@endsection
