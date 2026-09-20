<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('church_members', function (Blueprint $table) {
            // Making them nullable so children don't require an email/phone
            $table->string('email')->nullable()->after('preferred_name');
            $table->string('phone_number')->nullable()->after('email');
        });
    }

    public function down()
    {
        Schema::table('church_members', function (Blueprint $table) {
            $table->dropColumn(['email', 'phone_number']);
        });
    }
};