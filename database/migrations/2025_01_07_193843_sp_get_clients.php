<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpGetClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "
        CREATE PROCEDURE get_clients_data()
        BEGIN 
            SELECT 
            clients.id ,
            clients.name,
            clients.email,
            clients.phone,
            JSON_ARRAYAGG(
            JSON_OBJECT(
                'id', transactions.id,
                'clientID',transactions.client_id,
                'amount', transactions.amount,
                'date', transactions.date
            )) AS transtactions
            FROM clients
            LEFT JOIN 
                transactions ON clients.id = transactions.client_id
            GROUP BY clients.id;
        END;
        ";

        DB::unprepared('DROP PROCEDURE IF EXISTS get_clients_data');
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
