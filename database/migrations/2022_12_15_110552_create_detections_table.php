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
        Schema::create('detections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('discount');
            $table->enum('payment', ['cash', 'visa'])->nullable();
            $table->integer('patient_id');
            $table->integer('doctor_id');
            $table->integer('branch_id');
            $table->string('roshet');
            $table->string('analysis');
            $table->string('rumores');
            $table->string('detection');
            $table->string('consultation');
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
