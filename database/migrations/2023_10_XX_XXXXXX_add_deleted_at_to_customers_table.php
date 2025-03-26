<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToCustomersTable extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Add the soft delete column
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Remove the soft delete column
            $table->dropSoftDeletes();
        });
    }
}
