<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('currency_name', 100)->nullable();
            $table->string('iso_code', 3)->nullable();
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('currencies')->insert(
            array(
                [
                    'currency_name' => 'US dollar',
                    'iso_code' => 'USD',
                ],
                [
                    'currency_name' => 'European Euro',
                    'iso_code' => 'EUR',
                ],
                [
                    'currency_name' => 'Japanese yen',
                    'iso_code' => 'JPY',
                ],
                [
                    'currency_name' => 'Pound sterling',
                    'iso_code' => 'GBP',
                ],
                [
                    'currency_name' => 'Australian dollar',
                    'iso_code' => 'AUD',
                ],
                [
                    'currency_name' => 'Canadian dollar',
                    'iso_code' => 'CAD',
                ],
                [
                    'currency_name' => 'Chinese Yuan Renminbi',
                    'iso_code' => 'CNY',
                ],
                [
                    'currency_name' => 'South Korean won',
                    'iso_code' => 'KRW',
                ],
                [
                    'currency_name' => 'Russian ruble',
                    'iso_code' => 'RUB',
                ],
                [
                    'currency_name' => 'Brazilian real',
                    'iso_code' => 'BRL',
                ],
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
};
