<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('DROP VIEW IF EXISTS vs_estado');
        DB::statement('CREATE VIEW vs_estado AS SELECT id, nombre,nomenclatura FROM encabezados_dets WHERE encabezados_id = 3');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
