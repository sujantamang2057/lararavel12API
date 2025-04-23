@extends('layouts.master')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Create {{ modelName }}</h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="card">
        {!! Form::open(['route' => '{{ routePrefix }}{{ modelCamelPlural }}.store']) !!}
        <div class="card-body">
            <div class="row">
                @include('{{ viewPrefix }}{{ modelSnakePlural }}.fields')            </div>
            </div>
        </div>
        <div class="card-footer">
            {!! Form::submit(__('common::crud.save'), ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('{{ routePrefix }}{{ modelCamelPlural }}.index') }}" class="btn btn-default">{{__('common::crud.cancel')}}</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
