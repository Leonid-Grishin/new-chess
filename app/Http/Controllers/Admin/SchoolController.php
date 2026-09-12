<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
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

        return view(
            'admin.school',
            compact('promos')
        );
    }

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

        $imageName = $this->savePromoImage(
            $request->file('image')
        );

        Promo::create([
            /*
             * Сохраняется только имя без пути
             * и расширения:
             *
             * promo_abc123
             */
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
            $promo->image = $this->savePromoImage(
                $request->file('image'),
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
            $this->deletePromoImage(
                $promo->image
            );
        }

        $promo->delete();

        return back()->with(
            'success',
            'Промо-блок удалён.'
        );
    }

    /**
     * Сохранение изображения промо-блока.
     *
     * Оригинал сохраняется в:
     *
     * public/images/promos
     *
     * WebP создаётся рядом с оригиналом
     * с помощью Functions::createWebp().
     *
     * В базу возвращается только имя без:
     * - пути;
     * - расширения.
     */
    private function savePromoImage(
        $file,
        ?string $oldImageName = null
    ): string {
        $directory = public_path('images/promos');

        if (!File::exists($directory)) {
            File::makeDirectory(
                $directory,
                0755,
                true
            );
        }

        if ($oldImageName) {
            $this->deletePromoImage($oldImageName);
        }

        $extension = strtolower(
            $file->getClientOriginalExtension()
        );

        $filename = 'promo_' . Str::uuid();

        $filenameWithExtension =
            $filename . '.' . $extension;

        /*
         * Сначала сохраняем оригинал:
         *
         * public/images/promos/promo_xxx.png
         */
        $file->move(
            $directory,
            $filenameWithExtension
        );

        $originalPath = $directory .
            DIRECTORY_SEPARATOR .
            $filenameWithExtension;

        /*
         * Затем создаём WebP:
         *
         * public/images/promos/promo_xxx.webp
         */
        Functions::createWebp($originalPath);

        /*
         * Проверяем, что оригинал сохранился.
         */
        if (!File::exists($originalPath)) {
            throw new \RuntimeException(
                'Оригинальное изображение не найдено после сохранения: ' .
                $originalPath
            );
        }

        /*
         * В базу сохраняем только имя:
         *
         * promo_xxx
         */
        return $filename;
    }

    /**
     * Удаление изображения промо-блока
     * и WebP-версии.
     *
     * Метод поддерживает значения:
     *
     * promo_abc123
     *
     * и старый формат:
     *
     * images/promos/promo_abc123.jpg
     */
    private function deletePromoImage(
        string $imageName
    ): void {
        $directory = public_path('images/promos');

        /*
         * Нормализуем разделители.
         */
        $imageName = str_replace(
            '\\',
            '/',
            $imageName
        );

        /*
         * Убираем возможный путь.
         */
        $imageName = basename($imageName);

        /*
         * Убираем расширение,
         * если оно было сохранено в старой записи.
         */
        $imageName = pathinfo(
            $imageName,
            PATHINFO_FILENAME
        );

        foreach ([
                     'jpg',
                     'jpeg',
                     'png',
                     'webp',
                 ] as $extension) {
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
