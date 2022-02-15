<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitation_user', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->string('subscriber_name');

            $table->unsignedBigInteger('invitation_id');
            $table->foreign('invitation_id')->references('id')->on('invitations')->onDelete('cascade')->onUpdate('cascade');

            $table->string('menu');
            $table->integer('owner_id');
            $table->decimal('amount');
            $table->string('currency');
            $table->string('payment_method')->nullable();
            $table->boolean('payment_status')->default(false);
            $table->string('reference_number')->nullable();

            // Souscripteur accepté ?
            $table->boolean('activeUSer')->default(false);
            
            // Facture payée ?
            $table->boolean('invoice_paid')->default(false);

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
        Schema::dropIfExists('invitation_user');
    }
}
