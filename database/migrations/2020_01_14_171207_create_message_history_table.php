<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\InputType;
use App\Enums\DeliveryType;

class CreateMessageHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::connection('mongodb')
            ->create('message_history', function (Blueprint $collection) {
                $collection->increments('_id');
                $collection->integer('message_id');
                $collection->string('subject', 256);
                $collection->text('content');
                $collection->dateTime('start_date');
                $collection->dateTime('expiration_date');
                $collection->integer('user_id')->unsigned();
                $collection->timestamps();
                $collection->softDeletes();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->table('message_history', function(Blueprint $collection) {
            $collection->drop();
        });
    }
}
