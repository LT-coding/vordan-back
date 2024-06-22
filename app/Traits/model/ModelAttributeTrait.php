<?php

namespace App\Traits\model;

trait ModelAttributeTrait
{
    public function logo(): string|false
    {
        if ($this->getLogoAttributeTrait) {
            return config('app.url') . '/' . $this->logo;
        }
        return false;
    }
}
