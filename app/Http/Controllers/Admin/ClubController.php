<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClubSliderImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ClubController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $slides = ClubSliderImage::orderBy('sort')->orderBy('id')->get();

        return view('admin.club', compact('slides'));
    }

    /**
     * Загрузка нового слайда
     */
    public function storeSlide(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'alt'   => 'nullable|string|max:255',
            'sort'  => 'nullable|integer',
        ]);

        $file     = $request->file('image');
        $ext      = $file->getClientOriginalExtension();

        // Имя без расширения
        $filename = time() . '_' . \Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

        $destDir  = public_path('images/club/slider');
        $fullPath = $destDir . '/' . $filename . '.' . $ext;

        // Сохраняем оригинал (jpg/png)
        $file->move($destDir, $filename . '.' . $ext);

        // Конвертируем в webp
        \App\Src\Functions::createWebp($fullPath);

        ClubSliderImage::create([
            'filename'  => $filename, // только имя, без расширения
            'alt'       => $request->input('alt'),
            'sort'      => $request->input('sort', 0),
            'is_active' => true,
        ]);

        return back()->with('success', 'Слайд успешно добавлен.');
    }

    /**
     * Обновление alt и sort
     */
    public function updateSlide(Request $request, $id)
    {
        $slide = ClubSliderImage::findOrFail($id);

        $request->validate([
            'alt'       => 'nullable|string|max:255',
            'sort'      => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $slide->update([
            'alt'       => $request->input('alt'),
            'sort'      => $request->input('sort', $slide->sort),
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Слайд обновлён.');
    }

    /**
     * Удаление слайда
     */
    public function destroySlide($id)
    {
        $slide = ClubSliderImage::findOrFail($id);

        $destDir = public_path('images/club/slider');

        // Удаляем jpg
        $jpgPath = $destDir . '/' . $slide->filename . '.jpg';
        if (file_exists($jpgPath)) {
            unlink($jpgPath);
        }

        // Удаляем webp
        $webpPath = $destDir . '/' . $slide->filename . '.webp';
        if (file_exists($webpPath)) {
            unlink($webpPath);
        }

        $slide->delete();

        return back()->with('success', 'Слайд удалён.');
    }

    /**
     * Обновление видео-блока клуба
     */
    public function updateVideo(Request $request)
    {
        $request->validate([
            'poster' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'video' => [
                'nullable',
                'file',
                'mimes:mp4,webm,ogg',
            ],

            'video_prev' => [
                'nullable',
                'file',
                'mimes:mp4,webm,ogg',
            ],
        ], [
            'poster.image' => 'Превью должно быть изображением.',
            'poster.mimes' => 'Превью должно быть в формате JPG, PNG или WEBP.',
            'poster.max' => 'Размер изображения не должен превышать 5 МБ.',

            'video.mimes' => 'Видео должно быть в формате MP4, WEBM или OGG.',
            'video_prev.mimes' => 'Превью-видео должно быть в формате MP4, WEBM или OGG.',
        ]);

        $directory = public_path('video');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        /*
        |--------------------------------------------------------------------------
        | Poster
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('poster')) {
            foreach (['jpg', 'jpeg', 'png', 'webp'] as $extension) {
                $oldPoster = $directory . '/poster.' . $extension;

                if (file_exists($oldPoster)) {
                    unlink($oldPoster);
                }
            }

            $poster = $request->file('poster');
            $posterExtension = strtolower(
                $poster->getClientOriginalExtension()
            );

            $poster->move(
                $directory,
                'poster.' . $posterExtension
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Основное видео
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('video')) {
            foreach (['mp4', 'webm', 'ogg'] as $extension) {
                $oldVideo = $directory . '/video.' . $extension;

                if (file_exists($oldVideo)) {
                    unlink($oldVideo);
                }
            }

            $video = $request->file('video');
            $videoExtension = strtolower(
                $video->getClientOriginalExtension()
            );

            $video->move(
                $directory,
                'video.' . $videoExtension
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Видео-превью
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('video_prev')) {
            foreach (['mp4', 'webm', 'ogg'] as $extension) {
                $oldVideoPreview = $directory . '/video-prev.' . $extension;

                if (file_exists($oldVideoPreview)) {
                    unlink($oldVideoPreview);
                }
            }

            $videoPreview = $request->file('video_prev');
            $videoPreviewExtension = strtolower(
                $videoPreview->getClientOriginalExtension()
            );

            $videoPreview->move(
                $directory,
                'video-prev.' . $videoPreviewExtension
            );
        }

        return back()->with(
            'success',
            'Видео-блок успешно обновлён.'
        );
    }
}
