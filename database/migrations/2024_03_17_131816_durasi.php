<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Durasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('durasi', function (Blueprint $table) {
            $table->bigIncrements('iddurasi');
            $table->integer("nilai");
            $table->enum("durasi", ["minutes", "hours"]);
            $table->timestamps();
        });
        DB::table("durasi")->insert([
            "nilai" => 15,
            "durasi" => "minutes",
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
