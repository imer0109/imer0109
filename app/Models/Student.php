<?php

namespace App\Models;

use App\Traits\ModelRoutingBySlugTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, ModelRoutingBySlugTrait;
    protected $table='students';
    protected $fillable=[
        'name',
        'course',
        'email',
        'phone',
        'slug'
    ];

    public $timestamps = false;
    
    public function commandes()
    {
       return  $this->hasMany(Commande::class);
    }

}
