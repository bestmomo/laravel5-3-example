@extends('back.blog.template')

@section('entete')
    @include('back.partials.entete', ['title' => trans('back/blog.dashboard'), 'icon' => 'pencil', 'fil' => link_to('blog', trans('back/blog.posts')) . ' / ' . trans('back/blog.edition')])	
@endsection

@section('form')
    {!! Form::model($post, ['route' => ['blog.update', $post->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
@endsection
