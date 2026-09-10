<?php

namespace App\View\Components;

use App\Models\Price;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LessonsPrice extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $prices = Price::with([
            'items' => function ($query) {
                $query->orderBy('sort_order');
            }
        ])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('components.lessons-price', compact('prices'));
    }
}
