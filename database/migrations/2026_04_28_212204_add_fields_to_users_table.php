<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 20)->nullable()->after('email');
            $table->text('about')->nullable()->after('phone');
            $table->string('avatar')->nullable()->after('about');
            $table->text('bio')->nullable()->after('avatar');
            $table->string('address')->nullable()->after('bio');
            $table->string('city')->nullable()->after('address');
            $table->string('country')->nullable()->after('city');
            $table->enum('role', ['user', 'admin'])->default('user')->after('country');
            $table->boolean('is_active')->default(true)->after('role');
            $table->boolean('is_admin')->default(false)->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'about', 'avatar', 'bio',
                'address', 'city', 'country',
                'role', 'is_active', 'is_admin',
            ]);
        });
    }
};
