<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add role column to users
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('client')->after('username');
            }
        });

        // 2. Migrate existing user roles
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            $role = 'client';
            
            // Map position_id or type
            if (($user->type ?? '') === 'super_admin' || ($user->position_id ?? null) == 1 || ($user->username ?? '') === 'super_admin') {
                $role = 'superAdmin';
            } elseif (($user->type ?? '') === 'admin' || ($user->position_id ?? null) == 2 || ($user->username ?? '') === 'admin') {
                $role = 'admin';
            } elseif (($user->type ?? '') === 'manager' || ($user->position_id ?? null) == 3 || ($user->username ?? '') === 'manager') {
                $role = 'manager';
            }
            
            DB::table('users')->where('id', $user->id)->update(['role' => $role]);
        }

        // 3. Drop position_id and type columns from users
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'position_id')) {
                $table->dropColumn('position_id');
            }
            if (Schema::hasColumn('users', 'type')) {
                $table->dropColumn('type');
            }
        });

        // 4. Drop positions table
        Schema::dropIfExists('positions');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Recreate positions table
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // 2. Re-insert standard positions
        DB::table('positions')->insert([
            ['id' => 1, 'name' => 'superAdmin', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'manager', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 3. Re-add position_id and type columns to users
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'position_id')) {
                $table->unsignedBigInteger('position_id')->nullable()->after('password');
            }
            if (!Schema::hasColumn('users', 'type')) {
                $table->string('type')->default('client')->nullable()->after('balls');
            }
        });

        // 4. Restore data from role to position_id / type
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            $positionId = null;
            $type = 'client';
            
            if ($user->role === 'superAdmin') {
                $positionId = 1;
                $type = 'super_admin';
            } elseif ($user->role === 'admin') {
                $positionId = 2;
                $type = 'admin';
            } elseif ($user->role === 'manager') {
                $positionId = 3;
                $type = 'manager';
            }
            
            DB::table('users')->where('id', $user->id)->update([
                'position_id' => $positionId,
                'type' => $type
            ]);
        }

        // 5. Drop role column
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
};
