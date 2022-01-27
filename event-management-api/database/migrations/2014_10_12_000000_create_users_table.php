<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('utype')->default('user');
            $table->string('full_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('api_token')->nullable();
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('bio')->nullable();
            $table->string('device_type')->nullable();
            $table->string('device_token')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('is_blocked')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        // Insert some stuff
        DB::table('users')->insert(
            array(
                'utype' => 'admin',
                'full_name' => 'Super Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make("admin12345")
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
