<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->string('token');
            $table->enum('transaction_type', ['d','c']);
            $table->enum('transaction_status', [0,1]);
            $table->string('merchant_code');
            $table->double('amount');
            $table->string('transaction_currency');
            $table->double('transaction_amount');
            $table->string('auth_code');
            $table->timestamps();
        });

        // set auto increment number
        DB::unprepared('ALTER TABLE transactions AUTO_INCREMENT = 6600000');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
