<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpCreateClient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure="
        CREATE PROCEDURE create_client(
        IN nombre VARCHAR(250),
        IN correo VARCHAR(250),
        IN celular VARCHAR(250)
        )
        BEGIN
        INSERT INTO clients (name,email,phone)
        VALUES(nombre,correo,celular);
        END;
        ";
        DB::unprepared("DROP PROCEDURE IF EXISTS create_client");
        DB::unprepared($procedure);
        //
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
