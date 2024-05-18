<?php

use App\Enum\PaiementEnum;
use App\Enum\StatusEnum;
use App\Models\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->enum('statut', StatusEnum::values());
            $table->string('prix');
            $table->enum('paiement', PaiementEnum::values());
            $table->timestamp('date_commande');
            $table->timestamp('date_livraison')->nullable();
            $table->integer('note');
            $table->foreignIdFor(Student::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
