<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserTransactionsSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->softDeletes();
        });

        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->unsignedInteger('account_type_id');
            $table->decimal('current_balance', 15, 2);
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('account_type_id')->references('id')->on('account_types');
        });

        Schema::create('expense_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('description');
            $table->softDeletes();
        });

        Schema::create('transaction_types', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('description');
            $table->softDeletes();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->unsignedInteger('expense_category_id')->nullable();
            $table->unsignedInteger('transaction_type_id');
            $table->unsignedBigInteger('added_by');
            $table->decimal('amount', 15, 2);
            $table->decimal('balance', 15, 2);
            $table->string('description');
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('expense_category_id')->references('id')->on('expense_categories');
            $table->foreign('added_by')->references('id')->on('users');
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('account_types');
        Schema::dropIfExists('expense_categories');
        Schema::dropIfExists('transaction_types');
    }
}
