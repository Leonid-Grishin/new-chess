<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use App\Models\SchoolSlider;
use App\Src\Functions;
use Illuminate\Http\Request;
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

        return view(
            'admin.school',
            compact('promos', 'schoolSliders')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Промо-блоки
    |--------------------------------------------------------------------------
    */

    /**
     * Добавление нового промо-блока.
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

    /**
     * Обновление промо-блока.
     */
    public function updatePromo(Request $request, Promo $promo)
    {
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

    /**
     * Удаление промо-блока.
     */
    public function destroyPromo(Promo $promo)
    {
        if ($promo->image) {
            $this->deleteImage($promo->image, 'promos');
        }

        $promo->delete();

        return back()->with(
            'success',
            'Промо-блок удалён.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Слайдеры школы
    |--------------------------------------------------------------------------
    */

    /**
     * Добавление слайда школы.
     */
    public function storeSchoolSlider(Request $request)
    {
        $validated = $this->validateSchoolSlider($request, true);

        $imageName = $this->saveImage(
            $request->file('image'),
            'school-sliders',
            'school_slider'
        );

        SchoolSlider::create([
            'image' => $imageName,
            'image_alt' => $validated['image_alt'] ?? null,
            'title' => $validated['title'] ?? null,
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return back()->with(
            'success',
            'Слайд школы успешно добавлен.'
        );
    }

    /**
     * Обновление слайда школы.
     */
    public function updateSchoolSlider(
        Request $request,
        SchoolSlider $schoolSlider
    ) {
        $validated = $this->validateSchoolSlider($request);

        $schoolSlider->fill([
            'image_alt' => $validated['image_alt'] ?? null,
            'title' => $validated['title'] ?? null,
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $schoolSlider->image = $this->saveImage(
                $request->file('image'),
                'school-sliders',
                'school_slider',
                $schoolSlider->image
            );
        }

        $schoolSlider->save();

        return back()->with(
            'success',
            'Слайд школы успешно обновлён.'
        );
    }

    /**
     * Удаление слайда школы.
     */
    public function destroySchoolSlider(SchoolSlider $schoolSlider)
    {
        if ($schoolSlider->image) {
            $this->deleteImage(
                $schoolSlider->image,
                'school-sliders'
            );
        }

        $schoolSlider->delete();

        return back()->with(
            'success',
            'Слайд школы удалён.'
        );
    }

    /**
     * Валидация данных слайда школы.
     */
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
            'image_alt' => [
                'nullable',
                'string',
                'max:255',
            ],
            'title' => [
                'nullable',
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
    }

    /**
     * Сохранение оригинала и WebP-версии изображения.
     * В БД возвращается только имя файла без расширения.
     */
    private function saveImage(
        $file,
        string $directoryName,
        string $prefix,
        ?string $oldImageName = null
    ): string {
        $directory = public_path('images/' . $directoryName);

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        if ($oldImageName) {
            $this->deleteImage($oldImageName, $directoryName);
        }

        $extension = strtolower(
            $file->getClientOriginalExtension()
        );

        $filename = $prefix . '_' . Str::uuid();
        $filenameWithExtension = $filename . '.' . $extension;

        $file->move($directory, $filenameWithExtension);

        $originalPath = $directory . DIRECTORY_SEPARATOR . $filenameWithExtension;

        Functions::createWebp($originalPath);

        if (!File::exists($originalPath)) {
            throw new \RuntimeException(
                'Оригинальное изображение не найдено после сохранения: ' .
                $originalPath
            );
        }

        return $filename;
    }

    /**
     * Удаление оригинала и WebP-версии изображения.
     */
    private function deleteImage(
        string $imageName,
        string $directoryName
    ): void {
        $directory = public_path('images/' . $directoryName);

        $imageName = str_replace('\\', '/', $imageName);
        $imageName = basename($imageName);
        $imageName = pathinfo($imageName, PATHINFO_FILENAME);

        foreach (['jpg', 'jpeg', 'png', 'webp'] as $extension) {
            $filePath = $directory . DIRECTORY_SEPARATOR .
                $imageName . '.' . $extension;

            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
    }
}
