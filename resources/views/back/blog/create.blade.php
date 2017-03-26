@extends('back.blog.template')

@section('entete')
    @include('back.partials.entete', ['title' => trans('back/blog.dashboard'), 'icon' => 'pencil', 'fil' => link_to('blog', trans('back/blog.posts')) . ' / ' . trans('back/blog.creation')])	
@endsection

@section('form')
    {!! Form::open(['url' => 'blog', 'method' => 'post', 'class' => 'form-horizontal panel']) !!}	
@endsection
