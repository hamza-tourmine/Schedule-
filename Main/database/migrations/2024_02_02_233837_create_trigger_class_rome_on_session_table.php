
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
    {  DB::unprepared('CREATE TRIGGER observeClassRoomOnSessionTable
            BEFORE INSERT ON sissions
            FOR EACH ROW
            BEGIN
                DECLARE NumberClassRoom INT;

                SELECT COUNT(class_room_id) INTO NumberClassRoom
                FROM sissions
                WHERE establishment_id = NEW.establishment_id
                    AND main_emploi_id = NEW.main_emploi_id
                    AND day = NEW.day
                    AND day_part = NEW.day_part
                    AND dure_sission = NEW.dure_sission
                    AND class_room_id = NEW.class_room_id;
                IF NumberClassRoom > 0 THEN
                    SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "La salle  que vous avez sélectionnée a été réservée";
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
        DB::unprepared('DROP TRIGGER IF EXISTS observeClassRoomOnSessionTable');
    }
};

