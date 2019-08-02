<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSeveralTablesAddDeletedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            alter table posts
	            add deleted_at timestamp null;

            alter table searches
	            add deleted_at timestamp null;

            alter table users
	            add deleted_at timestamp null;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("
            alter table posts drop column deleted_at;
            alter table searches drop column deleted_at;
            alter table users drop column deleted_at;
        ");
    }
}
