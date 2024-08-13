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
        Schema::create('project_developers', function (Blueprint $table) {
            $table->id('project_developer_id');
            $table->integer('project_id');
            $table->integer('developer_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_developers', function (Blueprint $table) {
            $table->dropColumn('project_developer_id');
            $table->dropColumn('project_id');
            $table->dropColumn('developer_id');
            $table->dropTimestamps();
        });
    }
};
