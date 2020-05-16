<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProjectsIdsToPayouts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {  if (!Schema::hasColumn('payouts', 'projects_ids')) {
        Schema::table(
            'payouts',
            function (Blueprint $table) {
                $table->text('projects_ids')->nullable();
            }
        );
    }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'payouts',
            function (Blueprint $table) {
                $table->dropColumn('projects_ids');
            }
        );
    }
}
