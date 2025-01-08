<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpDeleteClient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure="
        CREATE PROCEDURE delete_client(IN clientId INT)
        BEGIN
        DELETE FROM clients WHERE id=clientId;
        END;
        ";

        DB::unprepared("DROP PROCEDURE IF EXISTS delete_client");
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
