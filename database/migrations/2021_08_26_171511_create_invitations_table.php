<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->string('menu');
            $table->string('type_of_cuisine');
            $table->text('description')->nullable();
            $table->string('country');
            $table->string('city');
            $table->string('currency');
            $table->integer('tax');
            $table->string('place');
            $table->string('postal_code')->nullable();
            // Date et heure de l'invitation
            $table->date('date');
            $table->time('heure')->nullable();
            // Prix fixé par l'hôte
            $table->decimal('price');
            // Montant total à payer par le guest
            $table->decimal('amountToBePaidByGuest');
            // Montant à remettre à l'hôte
            $table->decimal('amountToBePaidToTheHost');
            // Revenus tva
            $table->decimal('taxIncome');
            // Nos revenus
            $table->decimal('income');
            // Nombre de couverts
            $table->integer('number_of_guests');
            $table->string('image')->nullable();            
            // La date limite de l'invitation $table->date('limit');
            // L'état actif de l'invitation (pour savoir si elle a été acceptée par les administrateurs ou non)
            $table->boolean('active')->default(false);
            // L'état de l'invitation (complète ou pas pour le nombre de couverts prévus)
            $table->boolean('complete')->default(false);
            // Autoriser un invité à payer directement après sa souscription
            $table->boolean('direct_payment')->default(false);
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitations');
    }
}
