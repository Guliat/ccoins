<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBitcoinPriceBitcoinQantityToTrades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trades', function (Blueprint $table) {
            $table->decimal('bitcoin_quantity', 16, 8)->nullable()->after('close_at');
            $table->decimal('bitcoin_price', 13, 6)->nullable()->after('bitcoin_quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trades', function (Blueprint $table) {
            $table->dropColumn('bitcoin_quantity');
            $table->dropColumn('bitcoin_price');
        });
    }
}
