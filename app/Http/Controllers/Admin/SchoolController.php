<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use App\Models\SchoolGoal;
use App\Models\SchoolSlider;
use App\Models\StudentGroup;
use App\Models\StudentGroupItem;
use App\Src\Functions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SchoolController extends Controller
{
    /**
     * Страница «Школа» в админке.
     */
    public function index()
    {
        $promos = Promo::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $schoolSliders = SchoolSlider::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $schoolGoal = SchoolGoal::first();

        $studentGroups = StudentGroup::with([
            'items' => function ($query) {
                $query
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },
        ])
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view(
            'admin.school',
            compact(
                'promos',
                'schoolSliders',
                'schoolGoal',
                'studentGroups'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Промо-блоки
    |--------------------------------------------------------------------------
    */

    public function storePromo(Request $request)
    {
        $validated = $request->validate([
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],
            'image_alt' => [
                'nullable',
                'string',
                'max:255',
            ],
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        $imageName = $this->saveImage(
            $request->file('image'),
            'promos',
            'promo'
        );

        Promo::create([
            'image' => $imageName,
            'image_alt' => $validated['image_alt'] ?? null,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return back()->with(
            'success',
            'Промо-блок успешно добавлен.'
        );
    }

    public function updatePromo(
        Request $request,
        Promo $promo
    ) {
        $validated = $request->validate([
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],
            'image_alt' => [
                'nullable',
                'string',
                'max:255',
            ],
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        $promo->fill([
            'image_alt' => $validated['image_alt'] ?? null,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $promo->image = $this->saveImage(
                $request->file('image'),
                'promos',
                'promo',
                $promo->image
            );
        }

        $promo->save();

        return back()->with(
            'success',
            'Промо-блок успешно обновлён.'
        );
    }

    public function destroyPromo(Promo $promo)
    {
        if ($promo->image) {
            $this->deleteImage(
                $promo->image,
                'promos'
            );
        }

        $promo->delete();

        return back()->with(
            'success',
            'Промо-блок удалён.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Слайдер школы
    |--------------------------------------------------------------------------
    */

    public function storeSchoolSlider(Request $request)
    {
        $validated = $this->validateSchoolSlider(
            $request,
            true
        );

        $imageName = $this->saveImage(
            $request->file('image'),
            'school/gallery',
            'school_slider'
        );

        $imageBigName = $this->saveImage(
            $request->file('image_big'),
            'school/gallery',
            'school_slider_big'
        );

        SchoolSlider::create([
            'image' => $imageName,
            'image_big' => $imageBigName,
            'image_alt' => $validated['image_alt'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return back()->with(
            'success',
            'Слайд школы успешно добавлен.'
        );
    }

    public function updateSchoolSlider(
        Request $request,
        SchoolSlider $schoolSlider
    ) {
        $validated = $this->validateSchoolSlider($request);

        $schoolSlider->fill([
            'image_alt' => $validated['image_alt'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $schoolSlider->image = $this->saveImage(
                $request->file('image'),
                'school/gallery',
                'school_slider',
                $schoolSlider->image
            );
        }

        if ($request->hasFile('image_big')) {
            $schoolSlider->image_big = $this->saveImage(
                $request->file('image_big'),
                'school/gallery',
                'school_slider_big',
                $schoolSlider->image_big
            );
        }

        $schoolSlider->save();

        return back()->with(
            'success',
            'Слайд школы успешно обновлён.'
        );
    }

    public function destroySchoolSlider(
        SchoolSlider $schoolSlider
    ) {
        if ($schoolSlider->image) {
            $this->deleteImage(
                $schoolSlider->image,
                'school/gallery'
            );
        }

        if ($schoolSlider->image_big) {
            $this->deleteImage(
                $schoolSlider->image_big,
                'school/gallery'
            );
        }

        $schoolSlider->delete();

        return back()->with(
            'success',
            'Слайд школы удалён.'
        );
    }

    private function validateSchoolSlider(
        Request $request,
        bool $imageRequired = false
    ): array {
        return $request->validate([
            'image' => [
                $imageRequired ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],
            'image_big' => [
                $imageRequired ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],
            'image_alt' => [
                'nullable',
                'string',
                'max:255',
            ],
            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Цель школы
    |--------------------------------------------------------------------------
    */

    public function updateSchoolGoal(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'text' => [
                'nullable',
                'string',
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],
            'image_alt' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        $schoolGoal = SchoolGoal::first();

        if (!$schoolGoal) {
            $schoolGoal = new SchoolGoal();
        }

        $schoolGoal->fill([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'text' => $validated['text'] ?? null,
            'image_alt' => $validated['image_alt'] ?? null,
        ]);

        if ($request->hasFile('image')) {
            $schoolGoal->image = $this->saveImage(
                $request->file('image'),
                'school',
                'school_goal',
                $schoolGoal->image
            );
        }

        $schoolGoal->save();

        return back()->with(
            'success',
            'Блок «Цель школы» успешно обновлён.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Группы учащихся
    |--------------------------------------------------------------------------
    */

    /**
     * Добавление группы учащихся.
     *
     * Изображение сохраняется в:
     *
     * public/images/school
     *
     * В базе хранится только имя файла без расширения.
     */
    public function storeStudentGroup(Request $request)
    {
        $validated = $request->validate([
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],
            'image_alt' => [
                'nullable',
                'string',
                'max:255',
            ],
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
            'items' => [
                'nullable',
                'array',
            ],
            'items.*.text' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'items.*.sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        DB::transaction(function () use (
            $request,
            $validated
        ) {
            $imageName = $this->saveImage(
                $request->file('image'),
                'school',
                'student_group'
            );

            $studentGroup = StudentGroup::create([
                'image' => $imageName,
                'image_alt' => $validated['image_alt'] ?? null,
                'title' => $validated['title'],
                'sort_order' => $validated['sort_order'] ?? 0,
            ]);

            $this->saveStudentGroupItems(
                $studentGroup,
                $validated['items'] ?? []
            );
        });

        return back()->with(
            'success',
            'Группа учащихся успешно добавлена.'
        );
    }

    /**
     * Обновление группы учащихся.
     */
    public function updateStudentGroup(
        Request $request,
        StudentGroup $studentGroup
    ) {
        $validated = $request->validate([
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],
            'image_alt' => [
                'nullable',
                'string',
                'max:255',
            ],
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
            'items' => [
                'nullable',
                'array',
            ],
            'items.*.id' => [
                'nullable',
                'integer',
                'exists:student_group_items,id',
            ],
            'items.*.text' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'items.*.sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        DB::transaction(function () use (
            $request,
            $validated,
            $studentGroup
        ) {
            $studentGroup->fill([
                'image_alt' => $validated['image_alt'] ?? null,
                'title' => $validated['title'],
                'sort_order' => $validated['sort_order'] ?? 0,
            ]);

            if ($request->hasFile('image')) {
                $studentGroup->image = $this->saveImage(
                    $request->file('image'),
                    'school',
                    'student_group',
                    $studentGroup->image
                );
            }

            $studentGroup->save();

            $this->saveStudentGroupItems(
                $studentGroup,
                $validated['items'] ?? []
            );
        });

        return back()->with(
            'success',
            'Группа учащихся успешно обновлена.'
        );
    }

    /**
     * Удаление группы учащихся.
     */
    public function destroyStudentGroup(
        StudentGroup $studentGroup
    ) {
        DB::transaction(function () use ($studentGroup) {
            if ($studentGroup->image) {
                $this->deleteImage(
                    $studentGroup->image,
                    'school'
                );
            }

            $studentGroup->delete();
        });

        return back()->with(
            'success',
            'Группа учащихся удалена.'
        );
    }

    /**
     * Сохранение пунктов группы.
     *
     * Существующие пункты обновляются.
     * Отсутствующие в запросе удаляются.
     * Новые пункты создаются.
     */
    private function saveStudentGroupItems(
        StudentGroup $studentGroup,
        array $items
    ): void {
        $savedItemIds = [];

        foreach ($items as $itemData) {
            $text = trim($itemData['text'] ?? '');

            if ($text === '') {
                continue;
            }

            $itemId = $itemData['id'] ?? null;

            if ($itemId) {
                $item = StudentGroupItem::query()
                    ->where('student_group_id', $studentGroup->id)
                    ->where('id', $itemId)
                    ->first();

                if (!$item) {
                    continue;
                }

                $item->update([
                    'text' => $text,
                    'sort_order' => $itemData['sort_order'] ?? 0,
                ]);

                $savedItemIds[] = $item->id;
            } else {
                $item = $studentGroup->items()->create([
                    'text' => $text,
                    'sort_order' => $itemData['sort_order'] ?? 0,
                ]);

                $savedItemIds[] = $item->id;
            }
        }

        $studentGroup->items()
            ->whereNotIn('id', $savedItemIds)
            ->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | Работа с изображениями
    |--------------------------------------------------------------------------
    */

    /**
     * Сохраняет оригинал и WebP-версию.
     *
     * Например, для группы:
     *
     * public/images/school/student_group_uuid.jpg
     * public/images/school/student_group_uuid.webp
     *
     * В БД сохраняется:
     *
     * student_group_uuid
     */
    private function saveImage(
        $file,
        string $directoryName,
        string $prefix,
        ?string $oldImageName = null
    ): string {
        $directory = public_path(
            'images/' . $directoryName
        );

        if (!File::exists($directory)) {
            File::makeDirectory(
                $directory,
                0755,
                true
            );
        }

        if ($oldImageName) {
            $this->deleteImage(
                $oldImageName,
                $directoryName
            );
        }

        $extension = strtolower(
            $file->getClientOriginalExtension()
        );

        $filename = $prefix . '_' . Str::uuid();

        $originalFilename = $filename . '.' . $extension;

        $file->move(
            $directory,
            $originalFilename
        );

        $originalPath = $directory .
            DIRECTORY_SEPARATOR .
            $originalFilename;

        Functions::createWebp($originalPath);

        $webpPath = $directory .
            DIRECTORY_SEPARATOR .
            $filename .
            '.webp';

        if (!File::exists($webpPath)) {
            throw new \RuntimeException(
                'WebP-версия изображения не была создана.'
            );
        }

        return $filename;
    }

    /**
     * Удаляет оригинал и WebP-версию.
     */
    private function deleteImage(
        string $imageName,
        string $directoryName
    ): void {
        $directory = public_path(
            'images/' . $directoryName
        );

        $imageName = basename($imageName);

        $imageName = pathinfo(
            $imageName,
            PATHINFO_FILENAME
        );

        $extensions = [
            'jpg',
            'jpeg',
            'png',
            'webp',
        ];

        foreach ($extensions as $extension) {
            $filePath = $directory .
                DIRECTORY_SEPARATOR .
                $imageName .
                '.' .
                $extension;

            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
    }
}
