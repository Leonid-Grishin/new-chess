<?php

namespace App\Console\Commands;

ini_set('memory_limit', '512M');

use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class UpdateClassicCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-classic-command';

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

        //рейтинг по Классике
        if (($fileClassic = fopen("https://ratings.ruchess.ru/api/smaster_standard.csv", "r")) !== false) {
            $r = 0;
            $ratingArray = [];
            while (($row = fgetcsv($fileClassic, 0, ';')) !== false ) {
                $r++;
                array_push($ratingArray , ['fshrId' => $row[0], 'rating' => $row[4],]);
            };
            fclose($fileClassic);

            foreach ($students as $student) {
                if($student->fshr_id) {

                    for($i=0;$i<count($ratingArray);$i++) {
                        if($ratingArray[$i]['fshrId'] == $student->fshr_id && (int)$ratingArray[$i]['rating'] > 0) {
                            $newRatingClassic = $ratingArray[$i]['rating'];

                            $ratingClassicChange = $newRatingClassic - $student->rating_classic;
                            $student->rating_classic_change = $ratingClassicChange;

                            if ($newRatingClassic > $student->rating_classic) {
                                $student->rating_classic_change_class = 'up';
                            } elseif ($newRatingClassic < $student->rating_classic) {
                                $student->rating_classic_change_class = 'down';
                            } else {
                                $student->rating_classic_change_class = null;
                            };

                            $student->rating_classic = (int)$newRatingClassic;
                            $student->save();
                        }
                    }
                } else {
                    $student->rating_classic = 0;
                    $student->rating_classic_change_class = null;
                    $student->save();
                }
            }
        }
        Cache::forget('ratingClassic');
    }
}
