@include('errors.form_error_list')
    {!! Form::model($profil, ['method' => 'patch', 'class' => 'form-horizontal', 'action' => ['ProfilController@update', $profil->id]]) !!}
        @include('admin.profil.form', ['submitButton' => 'Simpan', 'ketForm' => 'Edit Data'])
    {!! Form::close() !!}