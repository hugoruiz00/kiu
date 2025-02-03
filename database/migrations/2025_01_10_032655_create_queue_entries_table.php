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
        Schema::create('queue_entries', function (Blueprint $table) {
            $table->id();
            $table->timestamp('position');
            $table->string('code', 20);
            $table->integer('estimated_service_time');
            $table->string('status', 50);
            $table->foreignId('business_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('queue_client_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queue_entries');
    }
};
