<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id'); 
            $table->unsignedInteger('sender_id')->nullable(); // người gửi (optional)

            $table->string('type'); 
            $table->string('title')->nullable(); // tiêu đề ngắn gọn (tùy chọn)
            $table->text('message'); // nội dung thông báo

            $table->boolean('is_read')->default(false);
            $table->timestamps(); 

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
