<h1 class="cover-heading">{{ trans('front/errors.error-' . $number) }}</h1>
<p class="lead">{{ trans('front/errors.error-' . $number . '-info') }}</p>
@if($number != '503')
	<p class="lead">
		<a href="{!! url('/') !!}" class="btn btn-lg btn-default">{{ trans('front/errors.button') }}</a>
	</p>
@endif
