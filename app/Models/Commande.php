<?php

namespace App\Models;

use App\Enum\PaiementEnum;
use App\Enum\StatusEnum;
use App\Traits\ModelRoutingBySlugTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory, ModelRoutingBySlugTrait;
    protected $fillable = [
        'statut',
        'prix',
        'paiement',
        'date_commande',
        'date_livraison',
        'note',
        'student_id',
        'slug'
    ];

    protected $casts = [
        'statut' => StatusEnum::class,
        'paiement' => PaiementEnum::class,
        'date_commande' => 'datetime',
        'date_livraison' => 'datetime',
        'note'=>'integer'
    ];

    public $timestamps = false;

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
