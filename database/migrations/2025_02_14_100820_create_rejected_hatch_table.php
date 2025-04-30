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
        Schema::create('rejected_hatch', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_deleted')->default(false);

            $table->string('ps_no');
            $table->integer('set_eggs_qty');
            $table->json("incubator_no");
            $table->json("hatcher_no");

            $table->json("rejected_hatch_data");

            $table->date("production_date_from");
            $table->date("production_date_to");
            $table->date("hatch_date");
            $table->date("qc_date");
            
            $table->integer("rejected_total");
            $table->decimal('rejected_total_percentage', 4, 1);
            // $table->decimal('rejected_total_percentage', 6, 2);


            $table->unsignedBigInteger('encoded_by')->nullable();
            $table->unsignedBigInteger('modified_by')->nullable();
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
        Schema::dropIfExists('egg_rejected_hatch');
    }
};
