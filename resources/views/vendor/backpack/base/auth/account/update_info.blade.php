@extends('backpack::layout')

@section('after_styles')
    <style media="screen">
        .backpack-profile-form .required::after {
            content: ' *';
            color: red;
        }
    </style>
@endsection

@section('header')
    <section class="content-header">

        <h1>
            {{ __('My Account') }}
        </h1>

        <ol class="breadcrumb">

            <li>
                <a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a>
            </li>

            <li>
                <a href="{{ route('backpack.account.info') }}">{{ __('My Account') }}</a>
            </li>

            <li class="active">
                {{ __('Update Account Info') }}
            </li>

        </ol>

    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('backpack::auth.account.sidemenu')
        </div>
        <div class="col-md-6">

            <form class="form" action="{{ route('backpack.account.info') }}" method="post">

                {!! csrf_field() !!}

                <div class="box">

                    <div class="box-body backpack-profile-form">

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->count())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            @php
                                $label = __('Name');
                                $field = 'name';
                            @endphp
                            <label class="required">{{ $label }}</label>
                            <input required class="form-control" type="text" name="{{ $field }}"
                                   value="{{ old($field) ? old($field) : $user->$field }}">
                        </div>

                        <div class="form-group">
                            @php
                                $label = __('Email');
                                $field = backpack_authentication_column();
                            @endphp
                            <label class="required">{{ $label }}</label>
                            <input required class="form-control"
                                   type="{{ backpack_authentication_column()=='email'?'email':'text' }}"
                                   name="{{ $field }}" value="{{ old($field) ? old($field) : $user->$field }}">
                        </div>

                        <div class="form-group">
                            @php
                                $label = __('Company');
                                $field = 'company';
                            @endphp
                            <label class="required">{{ $label }}</label>
                            <input required class="form-control" type="text" name="{{ $field }}"
                                   value="{{ old($field) ? old($field) : $user->$field }}">
                        </div>

                        <div class="form-group">
                            @php
                                $label = __('Tel');
                                $field = 'tel';
                            @endphp
                            <label class="">{{ $label }}</label>
                            <input required class="form-control" type="tel" name="{{ $field }}"
                                   value="{{ old($field) ? old($field) : $user->$field }}">
                        </div>


                    </div>

                    <div class="box-footer">

                        <button type="submit" class="btn btn-success"><span class="ladda-label"><i
                                    class="fa fa-save"></i> {{ trans('backpack::base.save') }}</span></button>
                        <a href="{{ backpack_url() }}" class="btn btn-default"><span
                                class="ladda-label">{{ trans('backpack::base.cancel') }}</span></a>

                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection
