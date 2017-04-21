@extends('back.template')

@section('main')

  @include('back.partials.entete', ['title' => trans('back/notifications.notifications'), 'icon' => 'bell', 'fil' => trans('back/notifications.new-notifications')])

  <div class="row col-lg-12">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>{!! trans('back/notifications.post') !!}</th>
            <th>{!! trans('back/notifications.date') !!}</th>
            <th>{!! trans('back/notifications.valid') !!}</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($user->unreadNotifications as $notification)
                <tr>
                  <td>{!! link_to('blog/' . $notification->data['slug'], $notification->data['title']) !!}</td>
                  <td>{{ formatDate($notification->created_at) }}</td> 
                  <td>{!! Form::checkbox(trans('valid'), null, userValid($notification->data['user_id']), ['disabled' => true]) !!}</td>
                  <td>
                    {!! Form::open(['method' => 'PUT', 'url' => 'notifications/' . $notification->id]) !!}
                      {!! Form::submit(trans('back/notifications.erase'), ['class' => 'btn btn-success btn-block']) !!}
                    {!! Form::close() !!}
                  </td>
                </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection

