<?php

namespace App\Presenters;

use Carbon\Carbon;

trait DatePresenter
{
    /**
     * Format created_at attribute
     *
     * @param \Carbon\Carbon  $date
     * @return string
     */
    public function getCreatedAtAttribute($date)
    {
        return $this->getDateTimeFormated($date);
    }

    /**
     * Format updated_at attribute
     *
     * @param \Carbon\Carbon  $date
     * @return string
     */
    public function getUpdatedAtAttribute($date)
    {
        return $this->getDateTimeFormated($date);
    }

    /**
     * Format date
     *
     * @param \Carbon\Carbon  $date
     * @return string
     */
    protected function getDateTimeFormated($date)
    {
        return Carbon::parse($date)->format(config('app.locale') != 'en' ? 'd/m/Y H:i:s' : 'm/d/Y H:i:s');
    }
}
