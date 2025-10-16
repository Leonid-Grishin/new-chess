<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = \App\Models\Request::paginate(30);
        return view('admin.requests.index', ['requests' => $requests]);
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
        \App\Models\Request::destroy($id);
        return redirect()->route('admin.requests')->with('success', 'Заявка успешно удалена');
    }

    public function clear()
    {
        \App\Models\Request::truncate();
        return redirect()->route('admin.requests')->with('success', 'Все записи удалены');
    }
}
