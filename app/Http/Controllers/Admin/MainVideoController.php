<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainVideoController extends Controller
{
    /**
     * Страница редактирования видео.
     */
    public function edit()
    {
        $directory = public_path('video');

        $currentPoster = $this->findAsset(
            $directory,
            'poster',
            ['jpg', 'jpeg', 'png', 'webp']
        );

        $currentVideo = $this->findAsset(
            $directory,
            'video',
            ['mp4', 'webm', 'ogg']
        );

        $currentVideoPreview = $this->findAsset(
            $directory,
            'video-prev',
            ['mp4', 'webm', 'ogg']
        );

        return view('admin.video', [
            'currentPoster' => $currentPoster,
            'currentVideo' => $currentVideo,
            'currentVideoPreview' => $currentVideoPreview,
        ]);
    }

    /**
     * Сохранение видеофайлов.
     */
    public function update(Request $request)
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

            'poster.mimes' => [
                'Превью должно быть в формате JPG, PNG или WEBP.',
            ],

            'poster.max' => [
                'Размер изображения не должен превышать 5 МБ.',
            ],

            'video.mimes' => [
                'Основное видео должно быть в формате MP4, WEBM или OGG.',
            ],

            'video_prev.mimes' => [
                'Превью-видео должно быть в формате MP4, WEBM или OGG.',
            ],
        ]);

        $directory = public_path('video');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $this->replaceFile(
            request: $request,
            requestName: 'poster',
            directory: $directory,
            fileName: 'poster',
            extensions: ['jpg', 'jpeg', 'png', 'webp']
        );

        $this->replaceFile(
            request: $request,
            requestName: 'video',
            directory: $directory,
            fileName: 'video',
            extensions: ['mp4', 'webm', 'ogg']
        );

        $this->replaceFile(
            request: $request,
            requestName: 'video_prev',
            directory: $directory,
            fileName: 'video-prev',
            extensions: ['mp4', 'webm', 'ogg']
        );

        return redirect()
            ->route('admin.video')
            ->with('success', 'Видео-блок успешно обновлён.');
    }

    /**
     * Поиск существующего файла.
     */
    private function findAsset(
        string $directory,
        string $fileName,
        array $extensions
    ): ?string {
        foreach ($extensions as $extension) {
            $file = $directory . '/' . $fileName . '.' . $extension;

            if (file_exists($file)) {
                return asset(
                    'video/' . $fileName . '.' . $extension
                );
            }
        }

        return null;
    }

    /**
     * Удаление старого файла и сохранение нового.
     */
    private function replaceFile(
        Request $request,
        string $requestName,
        string $directory,
        string $fileName,
        array $extensions
    ): void {
        if (!$request->hasFile($requestName)) {
            return;
        }

        foreach ($extensions as $extension) {
            $oldFile = $directory . '/'
                . $fileName
                . '.'
                . $extension;

            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        $file = $request->file($requestName);

        $extension = strtolower(
            $file->getClientOriginalExtension()
        );

        $file->move(
            $directory,
            $fileName . '.' . $extension
        );
    }
}
