<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscribers = Subscriber::paginate(30);
        return view('admin.subscribers.index', ['subscribers' => $subscribers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
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
    public function edit(string $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }

    /**
     * @param int $id
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Subscriber::destroy($id);
        return redirect()->route('admin.subscribers')->with('success', 'Подписчик удален');
    }

    public function clear()
    {
        Subscriber::truncate();
        return redirect()->route('admin.subscribers')->with('success', 'Все записи удалены');
    }

}
