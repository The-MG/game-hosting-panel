<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeploysTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('deploys', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('billing_period');
			$table->unsignedInteger('cost_per_period');

            $table->unsignedInteger('cpu');
            $table->unsignedInteger('memory');
            $table->unsignedInteger('disk');
            $table->unsignedInteger('io');
            $table->unsignedInteger('databases');
            $table->unsignedInteger('backups');

			$table->uuid('transaction_id')->nullable();
			$table->foreign('transaction_id')->references('id')->on('transactions');

			$table->unsignedBigInteger('server_id')->nullable();
			$table->foreign('server_id')->references('id')->on('servers');

			$table->dateTime('termination_requested_at')->nullable();
			$table->string('termination_reason')->nullable();
            $table->dateTime('terminated_at')->nullable();

			$table->unsignedBigInteger('terminated_by')->nullable();
			$table->foreign('terminated_by')->references('id')->on('users');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('deploys');
	}
}
