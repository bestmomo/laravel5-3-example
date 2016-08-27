<?php

namespace App\Services;

class PannelAdmin
{

    /**
     * @var array
     */
    protected $infos;

    /**
     * Pannel color
     * @var string
     */
    public $color;

    /**
     * Pannel icon
     * @var string
     */    
    public $icon;

    /**
     * Pannel model
     * @var string
     */
    public $model;

    /**
     * Pannel number
     * @var string
     */
    public $nbr;

    /**
     * Pannel name
     * @var string
     */
    public $name;

    /**
     * Pannel url
     * @var string
     */
    public $url;

    /**
     * Pannel total
     * @var string
     */
    public $total;

   /**
     * Create a new Admin instance.
     *
     * @param  Array $infos
     * @return \App\Services\PannelAdmin
     */
    public function __construct(Array $infos)
    {
        $this->color = $infos['color'];
        $this->icon = $infos['icon'];
        $this->model = new $infos['model'];
        $this->name = $infos['name'];
        $this->url = $infos['url'];
        $this->total = $infos['total'];

        return $this->compute();
    }

    /**
     * Compute the pannel
     *
     * @return \App\Services\PannelAdmin
     */
    protected function compute()
    {
        $this->name = trans($this->name);
        $this->total = trans($this->total);
        
        $this->nbr = (object)([
            'total' => $this->model->count(),
            'new' => $this->model->whereSeen(0)->count()
        ]);

        return $this;
    }
}

