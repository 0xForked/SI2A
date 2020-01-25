<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref_no');
            $table->string('letter_no')->nullable();
            $table->text('note')->nullable();
            $table->bigInteger('brutto')->default(0);
            $table->bigInteger('disc')->default(0);
            $table->bigInteger('netto')->default(0);
            $table->bigInteger('tax')->default(0);
            $table->bigInteger('total')->default(0);
            $table->bigInteger('pay')->default(0);
            $table->bigInteger('recipient_id')->unsigned()->index()->nullable();
            $table->bigInteger('customer_id')->unsigned()->index()->nullable();
            $table->enum('type', [
                'PURCHASE',
                'SELLING'
            ])->default('PURCHASE');
            $table->enum('status', [
                'UNCOMPLETED', // belum selesai - sudah dibuat dan ada item oredernya, tinggal proses bayar
                'COMPLETE' // sudah selesai sampai proses pembayaran
            ])->default('UNCOMPLETED');
            $table->text('funding')->nullable();
            $table->text('assign_by')->nullable(); // json_encode name and nip
            $table->timestamps();

            $table->foreign('recipient_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('customers');
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
    }
}
