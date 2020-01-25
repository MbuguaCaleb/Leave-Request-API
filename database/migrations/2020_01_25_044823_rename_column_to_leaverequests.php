<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnToLeaverequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leaverequests', function (Blueprint $table) {
            //
            Schema::table('leaverequests', function (Blueprint $table) {
                $table->renameColumn('decline_reason', 'admin_feedback');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leaverequests', function (Blueprint $table) {
            //
        });
    }
}
