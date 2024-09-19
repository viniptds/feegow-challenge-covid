<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('worker_vaccines', function (Blueprint $table) {
            $table->id();
            $table->dateTime('applied_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreignId('worker_id')->references('id')->on('workers')->onDelete('cascade');
            $table->foreignId('vaccine_id')->references('id')->on('vaccines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('worker_vaccines', function (Blueprint $table) {
            $table->dropForeign('worker_id');
            $table->dropForeign('vaccine_id');
        });
        
        Schema::dropIfExists('worker_vaccines');
    }
};
