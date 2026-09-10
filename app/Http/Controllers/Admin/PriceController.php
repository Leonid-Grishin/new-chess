<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PriceController extends Controller
{
    public function index()
    {
        $prices = Price::with('items')
            ->orderBy('sort_order')
            ->get();

        return view('admin.prices.index', compact('prices'));
    }

    public function create()
    {
        return view('admin.prices.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],

            'items' => ['nullable', 'array'],
            'items.*.title' => ['required', 'string', 'max:255'],
            'items.*.sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        DB::transaction(function () use ($data) {
            $price = Price::create([
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'price' => $data['price'] ?? null,
                'sort_order' => $data['sort_order'] ?? 0,
                'is_active' => isset($data['is_active']),
            ]);

            foreach ($data['items'] ?? [] as $item) {
                $price->items()->create([
                    'title' => $item['title'],
                    'sort_order' => $item['sort_order'] ?? 0,
                ]);
            }
        });

        return redirect()
            ->route('admin.prices')
            ->with('success', 'Цена успешно добавлена');
    }

    public function edit(Price $price)
    {
        $price->load('items');

        return view('admin.prices.edit', compact('price'));
    }

    public function update(Request $request, Price $price)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],

            'items' => ['nullable', 'array'],
            'items.*.title' => ['required', 'string', 'max:255'],
            'items.*.sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        DB::transaction(function () use ($data, $price) {
            $price->update([
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'price' => $data['price'] ?? null,
                'sort_order' => $data['sort_order'] ?? 0,
                'is_active' => isset($data['is_active']),
            ]);

            $price->items()->delete();

            foreach ($data['items'] ?? [] as $item) {
                $price->items()->create([
                    'title' => $item['title'],
                    'sort_order' => $item['sort_order'] ?? 0,
                ]);
            }
        });

        return redirect()
            ->route('admin.prices')
            ->with('success', 'Цена успешно обновлена');
    }

    public function destroy(Price $price)
    {
        $price->delete();

        return redirect()
            ->route('admin.prices')
            ->with('success', 'Цена удалена');
    }
}
