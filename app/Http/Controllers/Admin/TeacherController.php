<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Teacher;
use App\Models\TeacherAchievement;
use App\Models\TourAdvantage;
use App\Src\Functions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::orderBy('order', 'asc')->get();
        return view('admin.teachers.index', ['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'name' => ['required'],
            'rank' => ['required'],
            'order' => ['required'],
            'image' => ['required', 'mimes:jpg'],
        ];

        $messages = [
            'name.required' => 'Укажите Имя',
            'rank.required' => 'Укажите Звание',
            'order.required' => 'Укажите Порядок сортировки',
            'image.required' => 'Добавьте Изображение jpg',
            'image.mimes' => 'Изображение должно быть в формате jpg',
        ];

        $request->validate($rules, $messages);
        $data = $request->all();

        if(isset($data['is_camp_teacher'])){
            $data['is_camp_teacher'] = 1;
        } else {
            $data['is_camp_teacher'] = 0;
        }

        try {
            DB::beginTransaction();

            if($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('images/teachers');
            }

            if($request->hasFile('camp_image')) {
                $data['camp_image'] = $request->file('camp_image')->store('images/teachers');
            }

            $teacher = Teacher::create($data);
            Functions::createWebp($teacher->image);

            if (isset($teacher->camp_image)) {
                Functions::createWebp($teacher->camp_image);
            }


            if(isset($data['achievement']) and count($data['achievement']) > 0) {
                $achievements = [];
                foreach ($data['achievement'] as $achievement) {
                    $achievements[] = new TeacherAchievement([
                        'title' => $achievement['title'] ?? '',
                        'order' => $achievement['order'] ?? 0,
                        'is_camp_achievement' => $achievement['is_camp_achievement'] ?? 0,
                    ]);
                }
                $teacher->achievements()->saveMany($achievements);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }



        return redirect()->route('admin.teachers')->with('success', 'Преподаватель добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::find($id);
        return view('admin.teachers.edit', ['teacher' => $teacher]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $rules = [
            'name' => ['required'],
            'rank' => ['required'],
            'order' => ['required'],
        ];

        $messages = [
            'name.required' => 'Укажите Имя',
            'rank.required' => 'Укажите Звание',
            'order.required' => 'Укажите Порядок сортировки',
        ];



        $request->validate($rules, $messages);
        $teacher = Teacher::find($id);
        $data = $request->all();

        //dd($data);

        if(isset($data['is_camp_teacher'])){
            $data['is_camp_teacher'] = 1;
        } else {
            $data['is_camp_teacher'] = 0;
        }

        if($request->hasFile('image')) {

            if (File::exists($teacher->image) && $teacher->image !== 'images/news/default-news.jpg') {
                File::delete($teacher->image);

                $dir = pathinfo($teacher->image, PATHINFO_DIRNAME);
                $name = pathinfo($teacher->image, PATHINFO_FILENAME);
                $dest = "{$dir}/{$name}.webp";

                if (File::exists($dest) && $dest !== 'images/news/default-news.webp') {
                    File::delete($dest);
                }
            }

            //dd($request->file('image'));
            $data['image'] = $request->file('image')->store('images/news');
        }

        if($request->hasFile('camp_image')) {
            if (File::exists($teacher->camp_image) && $teacher->camp_image !== 'images/news/default-news.jpg') {
                File::delete($teacher->camp_image);

                $dir = pathinfo($teacher->camp_image, PATHINFO_DIRNAME);
                $name = pathinfo($teacher->camp_image, PATHINFO_FILENAME);
                $dest = "{$dir}/{$name}.webp";

                if (File::exists($dest) && $dest !== 'images/news/default-news.webp') {
                    File::delete($dest);
                }
            }
            $data['camp_image'] = $request->file('camp_image')->store('images/news');
        }

            $teacher->update($data);

            Functions::createWebp($teacher->image);

            if(isset($teacher->camp_image)) {
                Functions::createWebp($teacher->camp_image);
            }

        $currentTeacherAchievements = TeacherAchievement::where('teacher_id', $id)->get();

        $newTeacherAchievements = array_filter($request->achievement, function($teacherAchievement){
            return !isset($teacherAchievement['id']);
        });

        $idsTeacherAchievements = array_map(function ($teacherAchievement){
            return $teacherAchievement['id'];
        }, array_filter($request->achievement, function($teacherAchievement){
            return isset($teacherAchievement['id']);
        }));

        $removedTeacherAchievements = $currentTeacherAchievements->filter(function($teacherAchievement) use($idsTeacherAchievements) {
            return !in_array($teacherAchievement->id, $idsTeacherAchievements);
        });

        $remainAchievements = $currentTeacherAchievements->filter(function($teacherAchievement) use($idsTeacherAchievements) {
            return in_array($teacherAchievement->id, $idsTeacherAchievements);
        });

        $remainIdsAchievements = $remainAchievements->map(function ($teacherAchievement) {
            return $teacherAchievement->id;
        } )->toArray();

        $remainTeacherAchievements = array_filter($request->achievement, function ($teacherAchievement) use($remainIdsAchievements) {
            return in_array($teacherAchievement['id'], $remainIdsAchievements);
        });

        $remainAchievements = $remainAchievements->mapWithKeys(function ($teacherAchievement, $key) {
            return [$teacherAchievement->id => $teacherAchievement];
        });

        if(count($removedTeacherAchievements)) {
            foreach ($removedTeacherAchievements as $removedTeacherAchievement) {
                TeacherAchievement::destroy($removedTeacherAchievement->id);
            }
        }

        if(count($newTeacherAchievements)) {
            foreach ($newTeacherAchievements as $newTeacherAchievement) {
                $newTeacherAchievement['teacher_id'] = $teacher->id;
                TeacherAchievement::create($newTeacherAchievement);
            }
        }

        //dd($remainTeacherAchievements);

        if(count($remainTeacherAchievements)) {
            foreach ($remainTeacherAchievements as $remainTeacherAchievement) {
                if(isset($remainTeacherAchievement['is_camp_achievement'])) {

                    $remainTeacherAchievement['is_camp_achievement'] = 1;
                } else {
                    $remainTeacherAchievement['is_camp_achievement'] = 0;
                }
                $remainAchievements[$remainTeacherAchievement['id']]->update($remainTeacherAchievement);
            }
        }

            return redirect()->route('admin.teachers')->with('success', 'Данные преподавателя обновлены');
        }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::find($id);
        if (File::exists($teacher->image) && $teacher->image !== 'images/news/default-news.jpg') {
            File::delete($teacher->image);

            $dir = pathinfo($teacher->image, PATHINFO_DIRNAME);
            $name = pathinfo($teacher->image, PATHINFO_FILENAME);
            $dest = "{$dir}/{$name}.webp";

            if (File::exists($dest) && $dest !== 'images/news/default-news.webp') {
                File::delete($dest);
            }
        }

        if (File::exists($teacher->camp_image) && $teacher->camp_image !== 'images/news/default-news.jpg') {
            File::delete($teacher->camp_image);

            $dir = pathinfo($teacher->camp_image, PATHINFO_DIRNAME);
            $name = pathinfo($teacher->camp_image, PATHINFO_FILENAME);
            $dest = "{$dir}/{$name}.webp";

            if (File::exists($dest) && $dest !== 'images/news/default-news.webp') {
                File::delete($dest);
            }
        }

        Teacher::destroy($id);
        return redirect()->route('admin.teachers')->with('success', 'Преподаватель удалена');
    }
}
