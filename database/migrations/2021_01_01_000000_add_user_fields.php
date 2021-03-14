<?php

use Illuminate\Database\Migrations\Migration;

class AddUserFields extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            if ( ! Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique()->after('id');
            }
            if ( ! Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('email');
            }
            if (Schema::hasColumn('users', 'email')) {
                $table->dropUnique('users_email_unique');
                $table->string('email')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            if (Schema::hasColumn('users', 'username')) {
                $table->dropColumn('username');
            }
            if (Schema::hasColumn('users', 'avatar')) {
                $table->dropColumn('avatar');
            }
            if (Schema::hasColumn('users', 'email')) {
                $table->string('email')->unique()->change();
            }
        });
    }
}
