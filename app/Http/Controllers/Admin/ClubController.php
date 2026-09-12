<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\ClubOnlineBlock;
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

        $onlineBlock = ClubOnlineBlock::with([
            'items' => function ($query) {
                $query
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },
        ])->first();

        return view('admin.club', compact(
            'slides',
            'addresses',
            'onlineBlock'
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

        if (
            !$filename ||
            $filename === (string) time() . '_'
        ) {
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
    public function updateSlide(
        Request $request,
                $id
    ) {
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
     * Обновление блока «Доступно онлайн обучение».
     */
    public function updateOnlineBlock(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'image_alt' => [
                'nullable',
                'string',
                'max:255',
            ],

            /*
             * Принимаем только JPG/JPEG.
             * На диске сохраняем как .jpg и .webp.
             */
            'image' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg',
                'max:10240',
            ],

            'items' => [
                'nullable',
                'array',
            ],

            'items.*.id' => [
                'required',
                'integer',
            ],

            'items.*.text' => [
                'required',
                'string',
                'max:1000',
            ],

            'items.*.sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'items.*.is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $onlineBlock = ClubOnlineBlock::query()
            ->with('items')
            ->first();

        if (!$onlineBlock) {
            $onlineBlock = new ClubOnlineBlock();
        }

        $onlineBlock->fill([
            'title' => $validated['title'] ?? null,
            'image_alt' => $validated['image_alt'] ?? null,
        ]);

        if ($request->hasFile('image')) {
            $onlineBlock->image = $this->saveOnlineImage(
                $request->file('image'),
                $onlineBlock->image
            );
        }

        $onlineBlock->save();

        foreach ($validated['items'] ?? [] as $itemData) {
            $item = $onlineBlock->items()
                ->whereKey($itemData['id'])
                ->first();

            /*
             * Обновляем только пункт,
             * принадлежащий текущему блоку.
             */
            if (!$item) {
                continue;
            }

            $item->update([
                'text' => $itemData['text'],
                'sort_order' => $itemData['sort_order'] ?? 0,
                'is_active' => !empty(
                $itemData['is_active']
                ),
            ]);
        }

        return back()->with(
            'success',
            'Блок онлайн-обучения успешно сохранён.'
        );
    }

    /**
     * Сохранение изображения адреса.
     *
     * В базе данных сохраняется:
     *
     * location_1_uuid
     *
     * Физические файлы:
     *
     * public/images/location/location_1_uuid.jpg
     * public/images/location/location_1_uuid.webp
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

        $filename = $prefix . '_' . Str::uuid();

        $filenameWithExtension = $filename . '.' . $extension;

        $file->move(
            $directory,
            $filenameWithExtension
        );

        $fullPath = $directory . DIRECTORY_SEPARATOR .
            $filenameWithExtension;

        Functions::createWebp($fullPath);

        return $filename;
    }

    /**
     * Сохранение изображения онлайн-блока.
     *
     * В базе данных сохраняется:
     *
     * online_uuid
     *
     * Физические файлы:
     *
     * public/images/online/online_uuid.jpg
     * public/images/online/online_uuid.webp
     */
    private function saveOnlineImage(
        $file,
        ?string $oldImageName
    ): string {
        $directory = public_path('images/online');

        $this->createDirectory($directory);

        if ($oldImageName) {
            $this->deleteOnlineImage($oldImageName);
        }

        $filename = 'online_' . Str::uuid();

        /*
         * Валидация разрешает только jpg/jpeg.
         * Поэтому сохраняем изображение с единым именем .jpg.
         */
        $filenameWithExtension = $filename . '.jpg';

        $file->move(
            $directory,
            $filenameWithExtension
        );

        $fullPath = $directory . DIRECTORY_SEPARATOR .
            $filenameWithExtension;

        /*
         * Создаётся файл:
         *
         * public/images/online/online_uuid.webp
         */
        Functions::createWebp($fullPath);

        /*
         * В БД сохраняется только имя без расширения.
         */
        return $filename;
    }

    /**
     * Удаление изображения адреса.
     *
     * Поддерживает:
     *
     * location_1_uuid
     * location_1_uuid.jpg
     * images/location/location_1_uuid.jpg
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

        $imageName = basename($imageName);

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
     * Удаление изображения онлайн-блока.
     *
     * Поддерживает:
     *
     * online_uuid
     * online_uuid.jpg
     * images/online/online_uuid.jpg
     */
    private function deleteOnlineImage(
        string $imageName
    ): void {
        $directory = public_path('images/online');

        $imageName = str_replace(
            '\\',
            '/',
            $imageName
        );

        $imageName = basename($imageName);

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
        $filename = pathinfo(
            basename($filename),
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
        if (!File::isDirectory($directory)) {
            File::makeDirectory(
                $directory,
                0755,
                true
            );
        }
    }
}
