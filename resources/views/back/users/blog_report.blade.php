@extends('back.template')

@section('main')

    <h1>{{ trans('back/admin.blog-report') }}</h1>

    @if(session()->has('ok'))
        @include('partials/error', ['type' => 'success', 'message' => session('ok')])
    @endif

    <div class="row col-lg-12">
      <div class="table-responsive">
        <table class="table">
          <thead>
              <tr>
                  <th>{{ trans('back/users.name') }}</th>
                  <th>{{ trans('back/users.posts-count') }}</th>
                  <th>{{ trans('back/users.latest-blog-title') }}</th>
                  <th>{{ trans('back/users.latest-blog-date') }}</th>
                  <th></th>
                  <th></th>
              </tr>
          </thead>
          <tbody>
            @foreach ($authors as $author)
              <tr>
                  <td class="text-primary">
                      <strong>{{ $author->username }}</strong>
                  </td>
                  <td>{{ $author->total_count }}</td>
                  <td>{{ $author->created_at }}</td>
                  <td>{{ $author->title }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

@endsection
