<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /*
      'full_name', 'email','user_name','mobile_number','status_id',
      'verified_flag','created_at','last_login_date','shipping_address1',
      'shipping_address2','shipping_city','shipping_country'
      */

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('mobile_number');
            $table->boolean('is_staff')->default(false);
          
            //token
            $table->uuid('token')->unique();
            $table->dateTime('token_updated_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
