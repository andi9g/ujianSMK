<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Ujian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian', function (Blueprint $table) {
            $table->bigIncrements('idujian');
            $table->String("namaujian");
            $table->char("tahunawal", 4);
            $table->char("tahunakhir", 4);
            $table->timestamps();
        });

        Schema::create('soal', function (Blueprint $table) {
            $table->bigIncrements('idsoal');
            $table->integer('idujian');
            $table->string('mapel');
            $table->dateTime("tanggal");
            $table->longText('links');
            $table->string('jurusan');
            $table->string('password');
            $table->timestamps();
        });
        
        Schema::create('urutan', function (Blueprint $table) {
            $table->bigIncrements('idurutan');
            $table->char("nisn", 10);
            $table->integer("idujian");
            $table->integer("idruangan");
            $table->string("nomorurut");
            $table->timestamps();
        });
        Schema::create('ruangan', function (Blueprint $table) {
            $table->bigIncrements('idruangan');
            $table->String("namaruangan");
            $table->timestamps();
        });

        for ($i=1; $i < 10; $i++) { 
            DB::table('ruangan')->insert([
                "namaruangan" => $i,
            ]);
        }
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
