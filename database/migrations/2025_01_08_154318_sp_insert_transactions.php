<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpInsertTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "
        CREATE PROCEDURE insert_transactions(IN transactions_array json)
        BEGIN

	    DECLARE transaction_clientid INT;
	    DECLARE transaction_amount DECIMAL(8,2);
	    DECLARE transactions_date DATE;
	    DECLARE transactions_lenght INT;
	    DECLARE i INT DEFAULT 0;
	    SET transactions_lenght=JSON_LENGTH(transactions_array);
	
	    REPEAT

		SET transaction_clientid=JSON_UNQUOTE(JSON_EXTRACT(transactions_array, CONCAT('$[', i, '].clientID')));
		SET transaction_amount=JSON_UNQUOTE(JSON_EXTRACT(transactions_array, CONCAT('$[', i, '].amount')));
		SET transactions_date=JSON_UNQUOTE(JSON_EXTRACT(transactions_array, CONCAT('$[', i, '].date')));

		INSERT INTO transactions (client_id,amount,date) 
		VALUES (transaction_clientid,transaction_amount,transactions_date);
		SET i=i+1;
	    UNTIL  i>=transactions_lenght
        
	    END REPEAT;
	
        END;
        ";
        DB::unprepared("DROP PROCEDURE IF EXISTS insert_transactions");
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
