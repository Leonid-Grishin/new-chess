<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Src\Functions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::orderBy('id', 'desc')->paginate(30);
        return view('admin.reviews.index', ['reviews' => $reviews]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'description' => 'required',
            'poster' => ['required', 'mimes:jpg'],
            'video' => ['required', 'mimes:mp4'],
        ];

        $messages = [
            'description.required' => 'Добавьте описание',
            'poster.required' => 'Добавьте обложку для видео',
            'poster.mimes' => 'Обложка для видео должна быть в формате jpg',
            'video.required' => 'Добавьте видео',
            'video.mimes' => 'Видео должно быть в формате mp4',
        ];

        $request->validate($rules, $messages);
        $data = $request->all();

        if($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('video');
        }
        if($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('video');
        }

        Review::create($data);
        //Functions::createWebp($review->poster);

        return redirect()->route('admin.reviews')->with('success', 'Отзыв добавлен');
    }

    /**
     * @param  int  $id
     * Display the specified resource.
     */
    public function show($id)
    {
        $review = Review::find($id);
        return view('admin.reviews.show', ['review' => $review]);
    }

    /**
     * @param  int  $id
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $review = Review::find($id);
        return view('admin.reviews.edit', ['review' => $review]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $rules = [
            'description' => 'required',
            'poster' => ['mimes:jpg'],
            'video' => ['mimes:mp4'],
        ];

        $messages = [
            'description.required' => 'Добавьте описание',
            'poster.mimes' => 'Обложка для видео должна быть в формате jpg',
            'video.mimes' => 'Видео должно быть в формате mp4',
        ];

        $review = Review::find($id);
        $request->validate($rules, $messages);
        $data = $request->all();

        if ($request->hasFile('poster')) {
            if (File::exists($review->poster)) {
                File::delete($review->poster);
            }

            $data['poster'] = $request->file('poster')->store('video');
        }

        if ($request->hasFile('video')) {
            if (File::exists($review->video)) {
                File::delete($review->video);
            }

            $data['video'] = $request->file('video')->store('video');
        }

        $review->update($data);

        return redirect()->route('admin.reviews')->with('success', 'Отзыв обновлен');
    }

    /**
     * @param  int  $id
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $review = Review::find($id);
        if (File::exists($review->poster)) {
            File::delete($review->poster);
        }

        if (File::exists($review->video)) {
            File::delete($review->video);
        }

        Review::destroy($id);
        return redirect()->route('admin.reviews')->with('success', 'Отзыв Удален');
    }
}
