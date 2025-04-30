<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('egg_temperature', function (Blueprint $table) {
            $table->id();
            $table->boolean("is_deleted")->default(false);

            $table->date("temp_check_date");
            $table->date("setting_date");
            $table->date("hatch_date");

            $table->integer("temp_check_qty");
            $table->integer("ovrl_above_temp_qty");
            $table->decimal("ovrl_above_temp_prcnt", 4, 1);
            $table->integer("ovrl_below_temp_qty");
            $table->decimal("ovrl_below_temp_prcnt", 4, 1);

            $table->json("egg_temperature_data");

            $table->unsignedBigInteger("encoded_by")->nullable();
            $table->unsignedBigInteger("modified_by")->nullable();
            $table->timestamps();

            $table->foreign('encoded_by')->references('id')->on('users');
            $table->foreign('modified_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egg_temperature');
    }
};
