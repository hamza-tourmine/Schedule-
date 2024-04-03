<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

        public function up()
    {

        DB::unprepared('CREATE TRIGGER ObserveSessionGroup
    BEFORE INSERT ON sissions
    FOR EACH ROW
    BEGIN
        DECLARE NumberFormateur INT;
        SELECT COUNT(user_id) INTO NumberGroupe
        FROM sissions
        WHERE establishment_id = NEW.establishment_id
            AND main_emploi_id = NEW.main_emploi_id
            AND day = NEW.day
            AND day_part = NEW.day_part
            AND dure_sission = NEW.dure_sission
            AND user_id = NEW.user_id;
        IF NumberGroupe > 0 THEN
            SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "Le groupe  que vous avez sélectionné a été réservé";
        END IF;
    END
');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS ObserveSessionGroup');
    }
};
