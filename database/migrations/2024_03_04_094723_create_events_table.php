    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('events', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description');
                $table->dateTime('date_time');
                $table->string('location');
                $table->foreignId('category_id')->constrained();
                $table->integer('available_seats');
                $table->boolean('approved')->default(true);
                $table->foreignId('user_id')->constrained()->nullable();
                $table->enum('reservation_type', ['manual', 'automatic'])->default('manual');
                $table->string('image');
                $table->integer('price');

                $table->timestamps();
            });
            
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('events');
        }
    };
