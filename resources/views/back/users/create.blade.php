@extends('back.template')

@section('main')

    @include('back.partials.entete', ['title' => trans('back/users.dashboard'), 'icon' => 'user', 'fil' => link_to('user/sort', trans('back/users.Users')) . ' / ' . trans('back/users.creation')])

    <div class="col-sm-12">
        {!! Form::open(['url' => 'user', 'method' => 'post', 'class' => 'form-horizontal panel']) !!}   
            {!! Form::controlBootstrap('text', 0, 'username', $errors, trans('back/users.name')) !!}
            {!! Form::controlBootstrap('email', 0, 'email', $errors, trans('back/users.email')) !!}
            {!! Form::controlBootstrap('password', 0, 'password', $errors, trans('back/users.password')) !!}
            {!! Form::controlBootstrap('password', 0, 'password_confirmation', $errors, trans('back/users.confirm-password')) !!}
            {!! Form::selectBootstrap('role', $select, null, trans('back/users.role')) !!}
            {!! Form::submitBootstrap(trans('front/form.send')) !!}
        {!! Form::close() !!}
    </div>

@endsection