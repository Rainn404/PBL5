<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            if (!Schema::hasColumn('pendaftaran', 'validated_at')) {
                $table->timestamp('validated_at')->nullable()->after('divalidasi_oleh');
            }
        });
    }

    public function down()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            if (Schema::hasColumn('pendaftaran', 'validated_at')) {
                $table->dropColumn('validated_at');
            }
        });
    }
};
