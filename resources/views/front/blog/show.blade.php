@extends('front.template')

@section('head')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! HTML::style('ckeditor/plugins/codesnippet/lib/highlight/styles/monokai.css') !!}

@stop

@section('main')
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="text-center">{{ $post->title }}
                <br>
                <small>{{ $post->user->username }} {{ trans('front/blog.on') }} {!! $post->created_at . ($post->created_at != $post->updated_at ? trans('front/blog.updated') . $post->updated_at : '') !!}</small>
                </h2>
                <hr>
                {!! $post->summary !!}<br>
                {!! $post->content !!}
                <hr>
                @if($post->tags->count())
                    <div class="text-center">
                        <small>{{ trans('front/blog.tags') }}</small> 
                        @foreach($post->tags as $tag)
                            {!! link_to('blog/tag?tag=' . $tag->id, $tag->tag, ['class' => 'btn btn-default btn-xs']) !!}
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <div class="col-lg-12">
                    <hr>
                    <h3 class="text-center">{{ trans('front/blog.comments') }}</h3>
                    <hr>

                    @if($comments->count())
                        @foreach($comments as $comment)
                            <div class="commentitem">
                                <h3>
                                    <small>{{ $comment->user->username . ' ' . trans('front/blog.on') . ' ' . $comment->created_at }}</small>
                                    @if($user && $user->username == $comment->user->username) 
                                        <a id="deletecomment{!! $comment->id !!}" href="#" class="deletecomment"><span class="fa fa-fw fa-trash pull-right" data-toggle="tooltip" data-placement="left" title="{{ trans('front/blog.delete') }}"></span></a>
                                        <a id="comment{!! $comment->id !!}" href="#" class="editcomment"><span class="fa fa-fw fa-pencil pull-right" data-toggle="tooltip" data-placement="left" title="{{ trans('front/blog.edit') }}"></span></a>
                                    @endif
                                </h3>
                                <div id="content{!! $comment->id !!}">{!! $comment->content !!}</div>
                                <hr>
                            </div>
                        @endforeach
                    @endif  

                    <div class="row" id="formcreate"> 
                        @if(session()->has('warning'))
                            @include('partials/error', ['type' => 'warning', 'message' => session('warning')])
                        @endif  
                        @if(session('statut') != 'visitor')
                            {!! Form::open(['url' => 'comment']) !!}    
                                {!! Form::hidden('post_id', $post->id) !!}
                                {!! Form::controlBootstrap('textarea', 12, 'comments', $errors, trans('front/blog.comment')) !!}
                                {!! Form::submitBootstrap(trans('front/form.send'), 'col-lg-12') !!}
                            {!! Form::close() !!}
                        @else
                            <div class="text-center"><i class="text-center">{{ trans('front/blog.info-comment') }}</i></div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@stop

@section('scripts')

    {!! HTML::script('ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js') !!}

    @if(session('statut') != 'visitor')
        {!! HTML::script('ckeditor/ckeditor.js') !!}
        {!! HTML::script('js/sweetalert.min.js') !!}
    @endif

    <script>      

        @if(session('statut') != 'visitor')
            
            $(function() {

                function ckeditorReplace(element) {
                    CKEDITOR.replace(element, {
                        language: '{{ config('app.locale') }}',
                        height: 200,
                        toolbarGroups: [
                            { name: 'basicstyles', groups: [ 'basicstyles'] }, 
                            { name: 'links' },
                            { name: 'insert' }
                        ],
                        removeButtons: 'Table,SpecialChar,HorizontalRule,Anchor'
                    });                
                }

                ckeditorReplace('comments');

                function buttons(i) {
                    return "<input id='val" + i +"' class='btn btn-default' type='submit' value='{{ trans('front/blog.valid') }}'><input id='btn" + i + "' class='btn btn-default btnannuler' type='button' value='{{ trans('front/blog.undo') }}'></div>";
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('a.editcomment span').tooltip();
                $('a.deletecomment span').tooltip();

                // Set comment edition
                $('a.editcomment').click(function(e) {   
                    e.preventDefault();
                    $(this).hide();
                    var i = $(this).attr('id').substring(7);
                    var existing = $('#content' + i).html();
                    var url = $('#formcreate').find('form').attr('action');
                    jQuery.data(document.body, 'comment' + i, existing);
                    var html = "<div class='row'><form id='form" + i + "' method='POST' action='" + url + '/' + i + "' accept-charset='UTF-8' class='formajax'><div class='form-group col-lg-12 '><label for='comments' class='control-label'>{{ trans('front/blog.change') }}</label><textarea id='cont" + i +"' class='form-control' name='comments" + i + "' cols='50' rows='10' id='comments" + i + "'>" + existing + "</textarea><small class='help-block'></small></div><div class='form-group col-lg-12'>" + buttons(i) + "</div>";
                    $('#content' + i).html(html);
                    ckeditorReplace('comments' + i);
                });

                // Escape edition
                $(document).on('click', '.btnannuler', function() {    
                    var i = $(this).attr('id').substring(3);
                    $('#comment' + i).show();
                    $('#content' + i).html(jQuery.data(document.body, 'comment' + i));
                });

                // Validation comment
                $(document).on('submit', '.formajax', function(e) {  
                    e.preventDefault();
                    var i = $(this).attr('id').substring(4);
                    $('#val' + i).parent().html('<i class="fa fa-refresh fa-spin fa-2x"></i>').addClass('text-center');
                    $.ajax({
                        method: 'put',
                        url: $(this).attr('action'),
                        data: $(this).serialize()
                    })
                    .done(function(data) {
                        $('#comment' + data.id).show();
                        $('#content' + data.id).html(data.content); 
                    })
                    .fail(function(data) {
                        var errors = data.responseJSON;
                        $.each(errors, function(index, value) {
                            $('textarea[name="' + index + '"]' + ' ~ small').text(value);
                            $('textarea[name="' + index + '"]').parent().addClass('has-error');
                            $('.fa-spin').parent().html(buttons(index.slice(-1))).removeClass('text-center');
                        });
                    });
                });

                // Delete comment
                $('a.deletecomment').click(function(e) {   
                    e.preventDefault(); 
                    var that = $(this);
                    swal({
                        title: "{!! trans('front/blog.confirm') !!}",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{!! trans('front/site.yes') !!}",
                        cancelButtonText: "{!! trans('front/site.no') !!}"
                    }, function(isConfirm) {
                        if (isConfirm) {
                            var i = that.attr('id').substring(13);
                            that.replaceWith('<i class="fa fa-refresh fa-spin pull-right"></i>');
                            $.ajax({
                                method: 'delete',
                                url: '{!! url('comment') !!}' + '/' + i
                            })
                            .done(function(data) {
                                $('#comment' + data.id).parents('.commentitem').remove();
                            })
                            .fail(function() {
                                alert('{!! trans('front/blog.fail-delete') !!}');
                            }); 
                        }                
                    });
                });

            });

        @endif

        hljs.initHighlightingOnLoad();

    </script>

@stop
