<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSafetyUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement( 'DROP VIEW IF EXISTS safety_users' );
        DB::statement( "CREATE VIEW safety_users AS SELECT
            s.id, s.disaster_id, s.user_id, u.name, u.email, s.myself, u.phone, s.updated_at
            FROM safeties AS s INNER JOIN users AS u ON (s.user_id = u.id)
          " );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement( 'DROP VIEW IF EXISTS safety_users' );
    }
}
