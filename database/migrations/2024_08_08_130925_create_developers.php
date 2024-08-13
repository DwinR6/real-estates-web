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
        Schema::create('developers', function (Blueprint $table) {
            $table->id('developer_id');
            $table->string('name');
            $table->string('short_name');
            $table->string('large_name');
            $table->string('description');
            $table->string('logo')->comment('path to the logo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('developers', function (Blueprint $table) {
            $table->dropColumn('developer_id');
            $table->dropColumn('name');
            $table->dropTimestamps();
        });
    }
};
