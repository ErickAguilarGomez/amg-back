<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpGetClientByid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure="
        CREATE PROCEDURE get_user_byid(IN Clientid INT)
        BEGIN
        SELECT * FROM clients WHERE id=Clientid;
        END;
        ";

        DB::unprepared("DROP PROCEDURE IF EXISTS get_user_byid");
        DB::unprepared($procedure);
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
