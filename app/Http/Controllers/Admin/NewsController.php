<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Src\Functions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{

    public function __construct(Request $request)
    {
        //dump($request->route()->getName());
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::orderBy('id', 'desc')->paginate(30);
        return view('admin.news.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'date' => ['required', 'date'],
            'title' => ['required'],
            'link' => ['required'],
            'image' => ['required', 'mimes:jpg'],
        ];

        $messages = [
            'date.required' => 'Укажите Дату',
            'date.date' => 'Не верный формат даты',
            'title.required' => 'Укажите Заголовок',
            'link.required' => 'Укажите Ссылку',
            'image.required' => 'Добавьте Изображение',
            'image.mimes' => 'Изображение должно быть в формате jpg'
        ];

        $request->validate($rules, $messages);
        $data = $request->all();

        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/news');
        }

        $new = News::create($data);
        Functions::createWebp($new->image);

        return redirect()->route('admin.news')->with('success', 'Новость добавлена');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $new = News::find($id);
        return view('admin.news.show', ['new' => $new]);
    }

    /**
     * @param  int  $id
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $new = News::find($id);
        return view('admin.news.edit', ['new' => $new]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $rules = [
            'date' => ['required', 'date'],
            'title' => ['required'],
            'link' => ['required'],
            'image' => ['mimes:jpg'],
        ];

        $messages = [
            'date.required' => 'Укажите Дату',
            'date.date' => 'Не верный формат даты',
            'title.required' => 'Укажите Заголовок',
            'link.required' => 'Укажите Ссылку',
            'image.mimes' => 'Изображение должно быть в формате jpg',
        ];

        $new = News::find($id);
        $request->validate($rules, $messages);

        $data = $request->all();
        if($request->hasFile('image')) {
            if (File::exists($new->image) && $new->image !== 'images/news/default-news.jpg') {
                File::delete($new->image);

                $dir = pathinfo($new->image, PATHINFO_DIRNAME);
                $name = pathinfo($new->image, PATHINFO_FILENAME);
                $dest = "{$dir}/{$name}.webp";

                if(File::exists($dest) && $dest !== 'images/news/default-news.webp') {
                    File::delete($dest);
                }
            }
            $data['image'] = $request->file('image')->store('images/news');
        }
        $new->update($data);

        Functions::createWebp($new->image);

        return redirect()->route('admin.news')->with('success', 'Новость обновлена');
    }

    /**
     * @param  int  $id
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $new = News::find($id);
        if (File::exists($new->image) && $new->image !== 'images/news/default-news.jpg') {
            File::delete($new->image);

            $dir = pathinfo($new->image, PATHINFO_DIRNAME);
            $name = pathinfo($new->image, PATHINFO_FILENAME);
            $dest = "{$dir}/{$name}.webp";

            if (File::exists($dest) && $dest !== 'images/news/default-news.webp') {
                File::delete($dest);
            }
        }

        News::destroy($id);
        return redirect()->route('admin.news')->with('success', 'Новость удалена');
    }
}
