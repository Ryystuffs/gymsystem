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
        Schema::table('user_memberships', function (Blueprint $table) {
            $table->dropForeign(['membership_plan_id']);

            // Make sure the column can accept null
            $table->foreignId('membership_plan_id')->nullable()->change();

            // Re-add the new foreign key rule
            $table->foreign('membership_plan_id')->references('id')->on('membership_plans')->onDelete('set null');

            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_memberships', function (Blueprint $table) {
            //
        });
    }
};
