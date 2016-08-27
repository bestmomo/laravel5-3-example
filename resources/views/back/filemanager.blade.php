@extends('back.template')

@section('head')

    <style>
        #page-wrapper { background-color: #222; }
        .page-header { color: #ddd; }
    </style>

@endsection

@section('main')

    @include('back.partials.entete', ['title' => trans('back/medias.dashboard'), 'icon' => 'file-image-o', 'fil' => trans('back/medias.medias')])

    <div class="embed-responsive embed-responsive-16by9">
      <iframe class="embed-responsive-item" src="{!! url('elfinder') !!}"></iframe>
    </div>

@endsection
