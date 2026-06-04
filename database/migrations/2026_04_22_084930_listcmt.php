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
        Schema::create('cmt', function (Blueprint $table) {
            $table -> bigIncrements('id');
            $table -> string('cmt');
            $table -> integer('id_user');
            $table -> integer('id_blog');
            $table -> string('name_user');
            $table -> unsignedInteger('level')->default(0);
            $table -> timestamps();
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cmt', function (Blueprint $table) {
            //
        });
    }
};
