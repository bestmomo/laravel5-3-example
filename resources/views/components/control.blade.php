<div class="form-group {{ $columns == 0 ? '': 'col-lg-' . $columns }} {{ $errors->has($name) ? 'has-error' : '' }}">
    @if($label)
        {!! Form::label($name, $label, ['class' => 'control-label']) !!}
    @endif
    @if($pop)
        <a href="#" tabindex="0" class="badge pull-right" data-toggle="popover" data-trigger="focus" title="' . $pop[0] .'" data-content="' . $pop[1] . '"><span>?</span></a>
    @endif
    @if($type == 'textarea')
        {!! Form::textarea($name, $value, ['class' => 'form-control', 'placeholder' => $placeholder]) !!} 
    @else
        {!! Form::input($type, $name, $value, ['class' => 'form-control', 'placeholder' => $placeholder]) !!} 
    @endif
    {!! $errors->first($name, '<small class="help-block">:message</small>') !!}           
</div>
