<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Src\Functions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('admin.students.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'name' => ['required'],
            'birth_date' => ['nullable', 'date'],
            'photo' => ['nullable', 'mimes:jpg'],

        ];

        $messages = [
            'name.required' => 'Укажите Имя',
            'birth_date.date' => 'Не верный формат даты',
            'photo.mimes' => 'Изображение должно быть в формате jpg'
        ];

        $request->validate($rules, $messages);
        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('images/students');
        }

        $student = Student::create($data);
        Functions::createWebp($student->photo);

        Cache::forget('ratingClassic');
        Cache::forget('ratingRapid');

        return redirect()->route('admin.students')->with('success', 'Ученик добавлен');
    }

    /**
     * @param  int  $id
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::find($id);
        return view('admin.students.show', ['student' => $student]);
    }

    /**
     * @param  int  $id
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::find($id);
        return view('admin.students.edit', ['student' => $student]);
    }

    /**
     * @param  int  $id
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $rules = [
            'name' => ['required'],
            'birth_date' => ['nullable', 'date'],
            'photo' => ['mimes:jpg'],
        ];

        $messages = [
            'name.required' => 'Укажите Имя',
            'birth_date.date' => 'Не верный формат даты',
            'photo.mimes' => 'Изображение должно быть в формате jpg'
        ];

        $student = Student::find($id);
        $request->validate($rules, $messages);
        $data = $request->all();

        if ($request->hasFile('photo')) {
            if (File::exists($student->photo) && $student->photo !== 'images/students/default-photo.jpg') {
                File::delete($student->photo);

                $dir = pathinfo($student->photo, PATHINFO_DIRNAME);
                $name = pathinfo($student->photo, PATHINFO_FILENAME);
                $dest = "{$dir}/{$name}.webp";

                if(File::exists($dest) && $dest !== 'images/students/default-photo.webp') {
                    File::delete($dest);
                }
            }
            $data['photo'] = $request->file('photo')->store('images/students');
        }

        $student->update($data);
        Functions::createWebp($student->photo);

        Cache::forget('ratingClassic');
        Cache::forget('ratingRapid');

        return redirect()->route('admin.students')->with('success', 'Информация по ученику обновлена');
    }

    /**
     * @param  int  $id
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Student::destroy($id);

        Cache::forget('ratingClassic');
        Cache::forget('ratingRapid');

        return redirect()->route('admin.students')->with('success',  'Ученик удален');
    }

    public function trashed()
    {
        $students = Student::onlyTrashed()->get();
        return view('admin.students.trashed', ['students' => $students]);
    }

    /**
     * @param  int  $id
     * Полное удаление ученика.
     */
    public function destroyForever($id)
    {
        $student = Student::onlyTrashed()->find($id);
        if (File::exists($student->photo) && $student->photo !== 'images/students/default-photo.jpg') {
            File::delete($student->photo);

            $dir = pathinfo($student->photo, PATHINFO_DIRNAME);
            $name = pathinfo($student->photo, PATHINFO_FILENAME);
            $dest = "{$dir}/{$name}.webp";

            if (File::exists($dest) && $dest !== 'images/students/default-photo.webp') {
                File::delete($dest);
            }
        }

        Student::onlyTrashed()->find($id)->forceDelete();

        return redirect()->route('admin.students')->with('success',  'Ученик удален навсегда');
    }

    /**
     * @param  int  $id
     * Восстановление ученика.
     */
    public function restore($id)
    {
        Student::onlyTrashed()->find($id)->restore();

        Cache::forget('ratingClassic');
        Cache::forget('ratingRapid');

        return redirect()->route('admin.students')->with('success',  'Ученик восстановлен');
    }

    public function ratingUpdate()
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
                    $student->rating_classic = 1000;
                    $student->rating_classic_change_class = null;
                    $student->save();
                }
            }
        }

        //рейтинг по Рапиду
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
                    $student->rating_rapid = 1000;
                    $student->rating_rapid_change_class = null;
                    $student->save();
                }
            }
        }

        //рейтинг по Блицу
        /*if (($fileBlitz = fopen("https://ratings.ruchess.ru/api/smaster_blitz.csv", "r")) !== false) {
            $r = 0;
            $ratingArray = [];
            while (($row = fgetcsv($fileBlitz, 0, ';')) !== false ) {
                $r++;
                array_push($ratingArray , ['fshrId' => $row[0], 'rating' => $row[4],]);
            };
            fclose($fileBlitz);

            foreach ($students as $student) {
                if($student->fshr_id) {

                    for($i=0;$i<count($ratingArray);$i++) {
                        if($ratingArray[$i]['fshrId'] == $student->fshr_id && (int)$ratingArray[$i]['rating'] > 0) {
                            $newRatingBlitz = $ratingArray[$i]['rating'];

                            $ratingBlitzChange = $newRatingBlitz - $student->rating_blitz;
                            $student->rating_blitz_change = $ratingBlitzChange;

                            if ($newRatingBlitz > $student->rating_blitz) {
                                $student->rating_blitz_change_class = 'up';
                            } elseif ($newRatingBlitz < $student->rating_blitz) {
                                $student->rating_blitz_change_class = 'down';
                            } else {
                                $student->rating_blitz_change_class = null;
                            };

                            $student->rating_blitz = (int)$newRatingBlitz;
                            $student->save();
                        }
                    }
                } else {
                    $student->rating_blitz = 1000;
                    $student->rating_blitz_change_class = null;
                    $student->save();
                }
            }
        }*/

        //Cache::forget('ratingClassic');
        Cache::forget('ratingRapid');

        return redirect()->route('admin.students')->with('success', 'Рейтинг Обновлен');
    }
}
