@extends('back.template')

@section('main')

    @include('back.partials.entete', ['title' => trans('back/users.dashboard'), 'icon' => 'user', 'fil' => link_to('user/sort', trans('back/users.Users')) . ' / ' . trans('back/users.edition')])

    <div class="col-sm-12">
        {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
            {!! Form::controlBootstrap('text', 0, 'username', $errors, trans('back/users.name')) !!}
            {!! Form::controlBootstrap('email', 0, 'email', $errors, trans('back/users.email')) !!}
            {!! Form::selectBootstrap('role', $select, $user->role_id, trans('back/users.role')) !!}
            {!! Form::checkboxHorizontalBootstrap('confirmed', trans('back/users.confirmed'), $user->confirmed) !!}
            {!! Form::submitBootstrap(trans('front/form.send')) !!}
        {!! Form::close() !!}
    </div>

@endsection