<?php

namespace App\Services;

use Form;

class FormBuilder
{
    /**
     * Boot the Form Builder components.
     *
     * @return void
     */
     public static function boot()
    {
        Form::component('submitBootstrap', 'components.submit', [
            'value',
            'class' => '',
        ]);
        Form::component('destroyBootstrap', 'components.destroy', [
            'value',
            'message',
            'class' => '',
        ]);
        Form::component('controlBootstrap', 'components.control', [
            'type',
            'columns',
            'name',
            'errors',
            'label' => null,
            'value' => null,
            'pop' => null,
            'placeholder' => '',
        ]);
        Form::component('checkboxBootstrap', 'components.checkbox', [
            'name',
            'label',
        ]);
        Form::component('checkboxHorizontalBootstrap', 'components.checkboxHorizontal', [
            'name',
            'label',
            'value',
        ]);
        Form::component('selectBootstrap', 'components.select', [
            'name',
            'list' => [],
            'selected' => null,
            'label' => null,
        ]);    	
    }
}
