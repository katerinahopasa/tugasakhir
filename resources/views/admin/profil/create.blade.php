@extends('layouts.app')

@section('content')

@include('errors.form_error_list')
    {!! Form::open(['url' => 'profil', 'class' => 'form-horizontal']) !!}
        @include('admin.akun.form', ['submitButton' => 'Tambah', 'ketForm' => 'Tambah Data'])
    {!! Form::close() !!}

@endsection
