@extends('back.template')

@section('head')

    <style type="text/css">

        .badge {
            padding: 1px 8px 1px;
            background-color: #aaa !important;
        }

    </style>

@endsection

@section('main')

    @include('back.partials.entete', ['title' => trans('back/users.dashboard') . link_to_route('user.create', trans('back/users.add'), [], ['class' => 'btn btn-info pull-right']), 'icon' => 'user', 'fil' => trans('back/users.users')])

    @if(session()->has('ok'))
        @include('partials/error', ['type' => 'success', 'message' => session('ok')])
    @endif

    <div id="tri" class="btn-group btn-group-sm">
        <a href="{!! url('user/sort') !!}" role="button" class="btn btn-default {{ classActiveOnlyPath('user') }}">{{ trans('back/users.all') }} 
            <span class="badge">{{  $counts['total'] }}</span>
        </a>
        @foreach ($roles as $role)
            <a href="{!! url('user/sort/' . $role->slug) !!}" role="button" class="btn btn-default {{ classActiveOnlySegment(3, $role->slug) }}">{{ $role->title . 's' }} 
                <span class="badge">{{ $counts[$role->slug] }}</span>
            </a>
        @endforeach
    </div>

    <div class="pull-right link">{!! $users->links() !!}</div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ trans('back/users.name') }}</th>
                    <th>{{ trans('back/users.role') }}</th>
                    <th>{{ trans('back/users.seen') }}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @include('back.users.table')
            </tbody>
        </table>
    </div>

    <div class="pull-right link">{!! $users->links() !!}</div>

@endsection

@section('scripts')

    <script>

        $(function() {
            // Seen gestion
            $(document).on('change', ':checkbox', function() {
                $(this).parents('tr').toggleClass('warning');
                $(this).hide().parent().append('<i class="fa fa-refresh fa-spin"></i>');
                $.ajax({
                    url: '{!! url('userseen') !!}' + '/' + this.value,
                    type: 'PUT',
                    data: "seen=" + this.checked
                })
                .done(function() {
                    $('.fa-spin').remove();
                    $('input[type="checkbox"]:hidden').show();
                })
                .fail(function() {
                    $('.fa-spin').remove();
                    var chk = $('input[type="checkbox"]:hidden');
                    chk.show().prop('checked', chk.is(':checked') ? null:'checked').parents('tr').toggleClass('warning');
                    alert('{{ trans('back/users.fail') }}');
                });
            });
        });

    </script>

@endsection