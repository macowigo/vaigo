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
        Schema::create('oders', function (Blueprint $table) {
            $table->string('oderid')->unique();
            $table->string('center')->nullable();
            $table->string('customer');
            $table->string('order_type');
            $table->string('trans')->nullable();
            $table->string('delv_location');
            $table->string('delv_names')->nullable();
            $table->string('delv_phone');
            $table->string('py_type');
            $table->integer('value');
            $table->integer('item_value')->nullable();
            $table->string('ord_details');
            $table->timestamp('created_time')->useCurrent();
            $table->string('delivery_type')->nullable();
            $table->string('pick_up');
            $table->string('desination');
            $table->string('parcel_size');
            $table->string('oder_status');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oders');
    }
};
