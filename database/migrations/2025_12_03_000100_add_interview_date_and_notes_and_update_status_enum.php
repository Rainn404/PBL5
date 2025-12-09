<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            if (!Schema::hasColumn('pendaftaran', 'interview_date')) {
                $table->dateTime('interview_date')->nullable()->after('validated_at');
            }
            if (!Schema::hasColumn('pendaftaran', 'notes')) {
                $table->text('notes')->nullable()->after('interview_date');
            }
        });

        // NOTE: We intentionally do NOT alter the `status_pendaftaran` column type/enum here.
        // Changing enum values is DB-specific (MySQL/Postgres) and can be destructive.
        // If you need to change allowed status values in the DB, do it manually for your
        // database engine or create a careful migration that handles your specific driver.
    }

    public function down()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            if (Schema::hasColumn('pendaftaran', 'notes')) {
                $table->dropColumn('notes');
            }
            if (Schema::hasColumn('pendaftaran', 'interview_date')) {
                $table->dropColumn('interview_date');
            }
        });

        // Revert enum change only for MySQL
        $driver = DB::getDriverName();
        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE `pendaftaran` MODIFY `status_pendaftaran` ENUM('pending','diterima','ditolak') NOT NULL DEFAULT 'pending'");
        }
    }
};
