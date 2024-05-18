<?php

namespace App\Enum;

enum StatusEnum: string {
    case ENCOURS = "En cours";
    case ENATTENTE = "En attente";
    case LIVRE = "Livrée";
    case ANNULE = "Annulée";

    static function values () {
        return ['En cours', 'En attente', 'Livrée', 'Annulée'];
    }
}
