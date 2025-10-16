<?php

namespace App\Console\Commands;

ini_set('memory_limit', '512M');

use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class UpdateRapidCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-rapid-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $students = Student::withTrashed()->get();

        if (($fileRapid = fopen("https://ratings.ruchess.ru/api/smaster_rapid.csv", "r")) !== false) {
            $r = 0;
            $ratingArray = [];
            while (($row = fgetcsv($fileRapid, 0, ';')) !== false ) {
                $r++;
                array_push($ratingArray , ['fshrId' => $row[0], 'rating' => $row[4],]);
            };
            fclose($fileRapid);

            foreach ($students as $student) {
                if($student->fshr_id) {

                    for($i=0;$i<count($ratingArray);$i++) {
                        if($ratingArray[$i]['fshrId'] == $student->fshr_id && (int)$ratingArray[$i]['rating'] > 0) {
                            $newRatingRapid = $ratingArray[$i]['rating'];

                            $ratingRapidChange = $newRatingRapid - $student->rating_rapid;
                            $student->rating_rapid_change = $ratingRapidChange;

                            if ($newRatingRapid > $student->rating_rapid) {
                                $student->rating_rapid_change_class = 'up';
                            } elseif ($newRatingRapid < $student->rating_rapid) {
                                $student->rating_rapid_change_class = 'down';
                            } else {
                                $student->rating_rapid_change_class = null;
                            };

                            $student->rating_rapid = (int)$newRatingRapid;
                            $student->save();
                        }
                    }
                } else {
                    $student->rating_rapid = 0;
                    $student->rating_rapid_change_class = null;
                    $student->save();
                }
            }
        }

        Cache::forget('ratingRapid');
    }
}
