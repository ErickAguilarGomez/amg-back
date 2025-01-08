<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpUpdateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure="
        CREATE PROCEDURE update_user(
        IN identificador INT,
        IN nombre VARCHAR (250),
        IN correo VARCHAR (250),
        IN telefono VARCHAR (250)
        )
        BEGIN
            UPDATE clients set
            name=nombre,
            email=correo,
            phone=telefono
            WHERE id=identificador;
        END;
        ";

        DB::statement("DROP PROCEDURE IF EXISTS update_user");
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
