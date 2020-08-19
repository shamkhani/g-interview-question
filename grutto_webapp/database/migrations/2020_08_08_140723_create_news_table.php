<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->foreignId('category_id')->constrained('news_categories');
            $table->string('title', 255);
            $table->string('slug',255)->index();
            $table->text('short_description')->nullable();
            $table->text('description');
            $table->string('feature_image',100);
            $table->string('external_url',1024)->nullable();
            $table->timestamp('publish_date')->nullable();
            $table->enum('status',['published','draft'])->indx();
            $table->unsignedInteger('created_by')->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
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
        Schema::dropIfExists('news');
    }
}
