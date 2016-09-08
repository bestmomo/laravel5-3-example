@extends('back.template')

@section('main')

  @include('back.partials.entete', ['title' => trans('back/roles.dashboard'), 'icon' => 'user', 'fil' => link_to('user/sort', trans('back/users.Users')) . ' / ' . trans('back/roles.roles')])

    <div class="col-sm-12">
        @if(session()->has('ok'))
            @include('partials/error', ['type' => 'success', 'message' => session('ok')])
        @endif
        {!! Form::open(['url' => 'roles', 'method' => 'post', 'class' => 'form-horizontal panel']) !!} 
            @foreach ($roles as $role) 
                {!! Form::controlBootstrap('text', 0, $role->slug, $errors, trans('back/roles.' . $role->slug), $role->title) !!}
            @endforeach
            {!! Form::submitBootstrap(trans('front/form.send')) !!}
        {!! Form::close() !!}
    </div>

@endsection