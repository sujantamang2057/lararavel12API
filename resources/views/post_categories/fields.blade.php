<!-- Category Name Field -->
<div class="form-group col-sm-6 required">
    {{ html()->label('category_name', 'post_category') }}
    {{ html()->input('category_name')->class('form-control')->required() }}
    {{ html()->reset('Reset') }}
    {{ html()->tel('677878', 'Reset') }}
    {{ html()->textarea('remarks') }}
    {{ html()->file('file') }}

</div>
