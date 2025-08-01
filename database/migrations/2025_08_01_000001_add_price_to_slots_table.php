<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('slots', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->default(0);
        });
    }

    public function down()
    {
        Schema::table('slots', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
};
