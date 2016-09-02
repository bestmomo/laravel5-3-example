@extends('back.template')

@section('main')

    <h1>Reports</h1>

    @if(session()->has('ok'))
        @include('partials/error', ['type' => 'success', 'message' => session('ok')])
    @endif

    <div class="row col-lg-12">
      <div class="table-responsive">
        <table class="table">
          <thead>
              <tr>
                  <th>{{ trans('back/users.name') }}</th>
                  <th>{{ trans('back/users.total_count') }}</th>
                  <th>{{ trans('back/users.last_created_date') }}</th>
                  <th>{{ trans('back/users.last_created_title') }}</th>
                  <th></th>
                  <th></th>
              </tr>
          </thead>
          <tbody>
            @include('back.users.authors')
          </tbody>
        </table>
      </div>
    </div>

@endsection
