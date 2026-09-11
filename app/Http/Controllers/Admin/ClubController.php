<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\ClubSliderImage;
use App\Src\Functions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ClubController extends Controller
{
    /**
     * Страница админки клуба.
     */
    public function index()
    {
        $slides = ClubSliderImage::query()
            ->orderBy('sort')
            ->orderBy('id')
            ->get();

        $addresses = Address::with([
            'features' => function ($query) {
                $query
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },
        ])
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.club', compact(
            'slides',
            'addresses'
        ));
    }

    /**
     * Добавление нового слайда.
     */
    public function storeSlide(Request $request)
    {
        $validated = $request->validate([
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
            'alt' => [
                'nullable',
                'string',
                'max:255',
            ],
            'sort' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        $file = $request->file('image');

        $extension = strtolower(
            $file->getClientOriginalExtension()
        );

        $originalName = pathinfo(
            $file->getClientOriginalName(),
            PATHINFO_FILENAME
        );

        $filename = time() . '_' . Str::slug($originalName);

        if (!$filename || $filename === (string) time() . '_') {
            $filename = time() . '_slider';
        }

        $directory = public_path('images/club/slider');

        $this->createDirectory($directory);

        $filenameWithExtension = $filename . '.' . $extension;

        $file->move(
            $directory,
            $filenameWithExtension
        );

        $fullPath = $directory . DIRECTORY_SEPARATOR .
            $filenameWithExtension;

        Functions::createWebp($fullPath);

        ClubSliderImage::create([
            'filename' => $filename,
            'alt' => $validated['alt'] ?? null,
            'sort' => $validated['sort'] ?? 0,
            'is_active' => true,
        ]);

        return back()->with(
            'success',
            'Слайд успешно добавлен.'
        );
    }

    /**
     * Обновление данных слайда.
     */
    public function updateSlide(Request $request, $id)
    {
        $slide = ClubSliderImage::findOrFail($id);

        $validated = $request->validate([
            'alt' => [
                'nullable',
                'string',
                'max:255',
            ],
            'sort' => [
                'nullable',
                'integer',
                'min:0',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $slide->update([
            'alt' => $validated['alt'] ?? null,
            'sort' => $validated['sort'] ?? $slide->sort,
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with(
            'success',
            'Слайд обновлён.'
        );
    }

    /**
     * Удаление слайда.
     */
    public function destroySlide($id)
    {
        $slide = ClubSliderImage::findOrFail($id);

        $directory = public_path('images/club/slider');

        $this->deleteFilesByName(
            $directory,
            $slide->filename
        );

        $slide->delete();

        return back()->with(
            'success',
            'Слайд удалён.'
        );
    }

    /**
     * Обновление адреса, контактов, изображений
     * и преимуществ.
     */
    public function updateAddress(
        Request $request,
        Address $address
    ) {
        $validated = $request->validate([
            'title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'address_link' => [
                'nullable',
                'url',
                'max:1000',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],
            'phone_link' => [
                'nullable',
                'string',
                'max:100',
            ],
            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'image_1' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],
            'image_1_alt' => [
                'nullable',
                'string',
                'max:255',
            ],

            'image_2' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],
            'image_2_alt' => [
                'nullable',
                'string',
                'max:255',
            ],

            'features' => [
                'nullable',
                'array',
            ],
            'features.*.id' => [
                'required',
                'integer',
            ],
            'features.*.title' => [
                'required',
                'string',
                'max:255',
            ],
            'features.*.description' => [
                'required',
                'string',
            ],
            'features.*.sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
            'features.*.is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $address->fill([
            'title' => $validated['title'] ?? null,
            'name' => $validated['name'] ?? null,
            'address' => $validated['address'] ?? null,
            'address_link' => $validated['address_link'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'phone_link' => $validated['phone_link'] ?? null,
            'image_1_alt' => $validated['image_1_alt'] ?? null,
            'image_2_alt' => $validated['image_2_alt'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        /*
         * В image_1 и image_2 после выполнения метода
         * попадёт только имя файла без пути и расширения.
         *
         * Например:
         * location_1_abc123
         * location_2_def456
         */
        if ($request->hasFile('image_1')) {
            $address->image_1 = $this->saveLocationImage(
                $request->file('image_1'),
                $address->image_1,
                'location_1'
            );
        }

        if ($request->hasFile('image_2')) {
            $address->image_2 = $this->saveLocationImage(
                $request->file('image_2'),
                $address->image_2,
                'location_2'
            );
        }

        $address->save();

        foreach ($validated['features'] ?? [] as $featureData) {
            $feature = $address->features()
                ->whereKey($featureData['id'])
                ->first();

            if (!$feature) {
                continue;
            }

            $feature->update([
                'title' => $featureData['title'],
                'description' => $featureData['description'],
                'sort_order' => $featureData['sort_order'] ?? 0,
                'is_active' => !empty(
                $featureData['is_active']
                ),
            ]);
        }

        return back()->with(
            'success',
            'Данные адреса успешно сохранены.'
        );
    }

    /**
     * Сохранение изображения адреса.
     *
     * В БД сохраняется только имя без расширения:
     *
     * location_1_abc123
     *
     * Физические файлы:
     *
     * public/images/location/location_1_abc123.jpg
     * public/images/location/location_1_abc123.webp
     */
    private function saveLocationImage(
        $file,
        ?string $oldImageName,
        string $prefix
    ): string {
        $directory = public_path('images/location');

        $this->createDirectory($directory);

        if ($oldImageName) {
            $this->deleteLocationImage($oldImageName);
        }

        $extension = strtolower(
            $file->getClientOriginalExtension()
        );

        /*
         * Генерируем имя без расширения.
         */
        $filename = $prefix . '_' . Str::uuid();

        $filenameWithExtension = $filename . '.' . $extension;

        $file->move(
            $directory,
            $filenameWithExtension
        );

        $fullPath = $directory . DIRECTORY_SEPARATOR .
            $filenameWithExtension;

        /*
         * Создаём WebP рядом с оригиналом.
         */
        Functions::createWebp($fullPath);

        /*
         * В БД возвращается только basename:
         *
         * location_1_abc123
         */
        return $filename;
    }

    /**
     * Удаление изображения адреса.
     *
     * Метод принимает как новое имя:
     *
     * location_1_abc123
     *
     * так и старый формат:
     *
     * images/location/location_1_abc123.jpg
     */
    private function deleteLocationImage(
        string $imageName
    ): void {
        $directory = public_path('images/location');

        $imageName = str_replace(
            '\\',
            '/',
            $imageName
        );

        /*
         * Убираем путь и оставляем только имя файла.
         */
        $imageName = basename($imageName);

        /*
         * Убираем расширение, если оно есть.
         */
        $imageName = pathinfo(
            $imageName,
            PATHINFO_FILENAME
        );

        $this->deleteFilesByName(
            $directory,
            $imageName
        );
    }

    /**
     * Удаление файлов с одинаковым именем
     * и разными расширениями.
     */
    private function deleteFilesByName(
        string $directory,
        string $filename
    ): void {
        foreach ([
                     'jpg',
                     'jpeg',
                     'png',
                     'webp',
                 ] as $extension) {
            $filePath = $directory .
                DIRECTORY_SEPARATOR .
                $filename . '.' . $extension;

            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
    }

    /**
     * Создание директории, если её нет.
     */
    private function createDirectory(
        string $directory
    ): void {
        if (!File::exists($directory)) {
            File::makeDirectory(
                $directory,
                0755,
                true
            );
        }
    }
}
