<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpDeleteTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure="
        CREATE PROCEDURE delete_transaction(IN transaction_id INT)
        BEGIN
            DELETE FROM transactions WHERE id=transaction_id;
        END;
        ";

        DB::unprepared("DROP PROCEDURE IF EXISTS delete_transaction");
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
