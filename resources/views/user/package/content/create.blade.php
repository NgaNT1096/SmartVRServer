@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.content.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.content.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('tile'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

                    <div class="form-group">
                        <label>Theme:</label>
                        {!! Form::select('theme[]', $themes, old('theme'), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
                    </div>
                    <div class="form-group">
                        <label>Type Content</label>
                        <div class="dropdown">
                            <select id="type_data" class="btn btn-default dropdown-toggle"  name="type_data" type="button" data-toggle="dropdown">
                                <option value="video"> Video </option>
                                <option value="image"> Image 360</option>
                                <option value="assetbundel"> AssetBundel </option>
                            </select>
                        </div>   
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <textarea id="description" class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Upload Video</label>
                        <input id="link" type="file" name="link" accept="">
                    </div>
                    <div class="form-group">
                        <label>Price:</label>
                        <input id="price" class="form-control" name="price" placeholder="Please Enter Price" />
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop