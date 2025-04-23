@extends('layouts.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit PostCategory</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            {{ html()->modelForm($postCategory, 'POST', 'cmsadmin.postCategories.store')->open() }}
            {!! Form::model($postCategory, [
                'route' => ['post_categories.update', $postCategory->id],
                'method' => 'patch',
            ]) !!}
            <div class="card-body">
                <div class="row">
                    @include('post_categories.fields')
                </div>
            </div>
            <div class="card-footer">
                {{ html()->submit(__('common::crud.save'))->class('btn btn-primary') }}
                <a href="{{ route('postCategories.index') }}" class="btn btn-default">{{ __('common::crud.cancel') }}</a>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
@endsection
