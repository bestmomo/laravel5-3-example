<div class="form-group" style="width:200px;">
    @if($label)
        {!! Form::label($name, $label, ['class' => 'control-label']) !!}
    @endif
    {!! Form::select($name, $list, $selected, ['class' => 'form-control']) !!}
</div>