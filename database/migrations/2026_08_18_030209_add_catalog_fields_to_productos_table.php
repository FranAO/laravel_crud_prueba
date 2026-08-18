<?php

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
        if (! Schema::hasColumn('productos', 'nombre')) {
            Schema::table('productos', function (Blueprint $table) {
                $table->string('nombre');
                $table->text('descripcion')->nullable();
                $table->decimal('precio', 8, 2);
                $table->integer('stock');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // The fields are part of the base products schema for new installations.
    }
};
