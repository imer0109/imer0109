<?php

namespace App\Enum;

enum PaiementEnum: string {
   
    case SEMOA = "Semoa";
    case CASH = "Cash";
    case PAYPAL = "PaypPal";

    static function values () {
        return ['PaypPal', 'Semoa', 'Cash'];
    }
}
