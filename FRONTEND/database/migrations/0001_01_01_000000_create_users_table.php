<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sedes', function (Blueprint $table) {
            $table->id('id_sede');
            $table->string('nombre_sede', 200);
            $table->string('departamento', 255);
            $table->string('ciudad', 255);
            $table->timestamps();
        });

        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('tipo_documento', 300);
            $table->integer('numero_documento');
            $table->string('nombre', 500);
            $table->string('apellido', 600);
            $table->foreignId('sede_id')->constrained('sedes', 'id_sede')->onDelete('cascade');
            $table->string('telefono', 20);
            $table->text('contra');  // Este campo parece ser la contraseña
            $table->string('rol', 1000);
            $table->text('novedad'); // Para los cambios o actualizaciones hechas por un usuario
            $table->timestamps(); // Incluye campos created_at y updated_at
        });

        Schema::create('equipos', function (Blueprint $table) {
            $table->id('id_equipo');
            $table->string('marca', 50);
            $table->string('descripcion');
            $table->text('codigoBarras')->unique();
            $table->foreignId('usuario_id')->constrained('usuarios', 'id_usuario')->onDelete('cascade');
            $table->string('novedad');
            $table->timestamps();
        });

        Schema::create('movimientos', function (Blueprint $table) {
            $table->id('id_movimiento');
            $table->foreignId('equipo_id')->constrained('equipos', 'id_equipo')->onDelete('cascade');
            $table->boolean('tipo'); // Aquí asumimos que tipo es booleano (entrada/salida)
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('sid')->primary();
            $table->foreignId('user_id')->nullable()->index()->constrained('usuarios', 'id_usuario')->onDelete('cascade');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload'); // Esta columna es la que Laravel necesita
            $table->integer('last_activity')->index();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
        Schema::dropIfExists('equipos');
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('sedes');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
    }
};
