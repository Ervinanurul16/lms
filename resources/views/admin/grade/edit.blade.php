@extends('layouts.master')

@section('title')
    {{ __('section-title.class_edit') }}
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
@stop

@section('content')
<div class="row clearfix">
    <div class="col-lg-8 col-12">
        <div class="card">
            <div class="header">
                <h2><strong>{{ __('section-title.class_edit') }}</strong></h2>
            </div>
            <div class="body">
                <form action="{{\LaravelLocalization::localizeURL('admin/grades/'.$grade->id)}}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="row clearfix">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <input type="text" placeholder="{{ __('form-label.class_name') }}" name="name" value="{{$grade->name}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="form-group">
                                <select name="grade_level" class="select2">
                                    <option value="10" @if($grade->grade_level == 10) selected @endif>{{ __('label.level') }} 1 ({{ __('label.class') }} 10)</option>
                                    <option value="11" @if($grade->grade_level == 11) selected @endif>{{ __('label.level') }} 2 ({{ __('label.class') }} 11)</option>
                                    <option value="12" @if($grade->grade_level == 12) selected @endif>{{ __('label.level') }} 3 ({{ __('label.class') }} 12)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-raised btn-round waves-effect">{{ __('button-label.update') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection