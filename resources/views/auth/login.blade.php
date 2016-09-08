@extends('front.template')

@section('main')
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                @if(session()->has('error'))
                    @include('partials/error', ['type' => 'danger', 'message' => session('error')])
                @endif	
                <hr>	
                <h2 class="intro-text text-center">{{ trans('front/login.connection') }}</h2>
                <hr>
                <p>{{ trans('front/login.text') }}</p>				

                {!! Form::open(['url' => 'login']) !!}	

                    <div class="row">

                        {!! Form::controlBootstrap('text', 6, 'log', $errors, trans('front/login.log')) !!}
                        {!! Form::controlBootstrap('password', 6, 'password', $errors, trans('front/login.password')) !!}
                        {!! Form::submitBootstrap(trans('front/form.send'), 'col-lg-12') !!}
                        {!! Form::checkboxBootstrap('memory', trans('front/login.remind')) !!}
                        {!! Form::text('address', '', ['class' => 'hpet']) !!}		  
                        <div class="col-lg-12">					
                            {!! link_to('password/reset', trans('front/login.forget')) !!}
                        </div>

                    </div>

                {!! Form::close() !!}

                <div class="text-center">
                    <hr>
                    <h2 class="intro-text text-center">{{ trans('front/login.register') }}</h2>
                    <hr>	
                    <p>{{ trans('front/login.register-info') }}</p>
                    {!! link_to('register', trans('front/login.registering'), ['class' => 'btn btn-default']) !!}
                </div>

            </div>
        </div>
    </div>
@endsection

