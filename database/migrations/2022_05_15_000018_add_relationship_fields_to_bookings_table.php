<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id')->nullable();
            $table->foreign('service_id', 'service_fk_6607068')->references('id')->on('services');
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->foreign('staff_id', 'staff_fk_6607069')->references('id')->on('users');
        });
    }
}
