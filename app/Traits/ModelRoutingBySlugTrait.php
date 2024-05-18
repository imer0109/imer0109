<?php

namespace App\Traits;

trait ModelRoutingBySlugTrait {

    public static function bootModelRoutingBySlugTrait() : void {
        static::creating(function($model) {
            $model->slug = uniqid();
        });
    }

    public function getRouteKeyName() : string {
        return 'slug';
    }
}