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
        Schema::create('product', function (Blueprint $table) {
            $table -> bigIncrements('id');
            $table -> unsignedInteger('id_user');
            $table -> string('name');
            $table -> unsignedInteger('price');
            $table -> unsignedInteger('id_category');
            $table -> unsignedInteger('id_brand');
            $table -> unsignedInteger('status')->default(0)->comment="(0,1)";
            $table -> unsignedInteger('sale')->default(0);
            $table -> string('company');
            $table -> string('avatar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            //
        });
    }
};
