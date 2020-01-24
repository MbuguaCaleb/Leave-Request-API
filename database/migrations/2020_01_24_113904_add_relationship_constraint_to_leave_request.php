<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipConstraintToLeaveRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leave_request', function (Blueprint $table) {
            //

            $table->renameColumn('user', 'user_id');
            $table->unsignedInteger('user_id')->change();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_request', function (Blueprint $table) {
            //
        });
    }
}
