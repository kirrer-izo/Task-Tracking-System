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
        if(!Schema::hasTable('tasks')){

            Schema::create('tasks', function (Blueprint $table) {
                $table->id();
    
                $table->text('task');
                $table->unsignedBigInteger('created_by');
                $table->unsignedBigInteger('assigned_to');
                $table->enum('status',['Pending','Completed'])->default('Pending');
                
                $table->foreign('created_by')->references('id')->on('users')->where('role','Assigner')->onDelete('cascade');
                $table->foreign('assigned_to')->references('id')->on('users')->where('role','IT technician')->onDelete('cascade');

               

                $table->text('review')->nullable();
             


                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
