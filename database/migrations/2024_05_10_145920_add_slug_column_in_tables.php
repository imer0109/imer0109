<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    static array $tables = ['students', 'commandes', 'users'];

    public function up(): void
    {
        collect(static::$tables)->each(function (string $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->string('slug')->default(uniqid());
            });
        });
    }

    public function down(): void
    {
        collect(static::$tables)->each(function (string $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        });
    }
};
