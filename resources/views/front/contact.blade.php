@extends('front.template')

@section('main')
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>    
                <h2 class="intro-text text-center">{{ trans('front/contact.title') }}</h2>
                <hr>
                <p>{{ trans('front/contact.text') }}</p>                
                {!! Form::open(['url' => 'contact']) !!}  
                    <div class="row">
                        {!! Form::controlBootstrap('text', 6, 'name', $errors, trans('front/contact.name')) !!}
                        {!! Form::controlBootstrap('email', 6, 'email', $errors, trans('front/contact.email')) !!}
                        {!! Form::controlBootstrap('textarea', 12, 'message', $errors, trans('front/contact.message')) !!}
                        {!! Form::text('address', '', ['class' => 'hpet']) !!}      
                        {!! Form::submitBootstrap(trans('front/form.send'), 'col-lg-12') !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection