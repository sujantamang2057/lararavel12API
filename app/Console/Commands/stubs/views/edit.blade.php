@extends('layouts.master')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Edit {{ modelName }}</h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="card">
        {!! Form::model(${{ modelCamel }}, [
            'route' => ['{{ routePrefix }}{{ modelNamePluralSnake }}.update', ${{ modelCamel }}->id],
            'method' => 'patch',
        ]) !!}
        <div class="card-body">
            <div class="row">
                @include('{{ viewPrefix }}{{ modelSnakePlural }}.fields')            
            </div>
        </div>
        <div class="card-footer">
            {!! Form::submit(__('common::crud.update'), ['class' => 'btn btn-success']) !!}
            <a href="{{ route('{{ routePrefix }}{{ modelCamelPlural }}.index') }}" class="btn btn-default">{{__('common::crud.cancel')}}</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
