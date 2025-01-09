4
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpUpdateTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "
        CREATE PROCEDURE update_transaction(IN transaction_data JSON)
        BEGIN
        DECLARE transaction_id INT;
        DECLARE transaction_clientid INT;
        DECLARE transaction_amount DECIMAL(8,2);
        DECLARE transaction_date DATE;

        SET transaction_id = JSON_UNQUOTE(JSON_EXTRACT(transaction_data, '$.id'));
        SET transaction_clientid = JSON_UNQUOTE(JSON_EXTRACT(transaction_data, '$.clientID'));
        SET transaction_amount = JSON_UNQUOTE(JSON_EXTRACT(transaction_data, '$.amount'));
        SET transaction_date = JSON_UNQUOTE(JSON_EXTRACT(transaction_data, '$.date'));

        UPDATE transactions 
        SET client_id = transaction_clientid, 
        amount = transaction_amount, 
        date = transaction_date
        WHERE id = transaction_id;
        END
        ";
        DB::unprepared("DROP PROCEDURE IF EXISTS update_transaction");
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
