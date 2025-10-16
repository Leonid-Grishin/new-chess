<?php

namespace App\View\Components;

use App\Models\Student;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Rating extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $type,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (Cache::has('ratingClassic')) {
            $classicRatings = Cache::get('ratingClassic');
        } else {
            $classicRatings = Student::select('photo', 'name', 'rating_classic', 'rating_classic_change_class', 'rating_classic_change')
                ->where('deleted_at', null)
                ->orderByDesc('rating_classic')
                ->limit(12)
                ->get();
            Cache::forever('ratingClassic', $classicRatings);
        }

        if (Cache::has('ratingRapid')) {
            $rapidRatings = Cache::get('ratingRapid');
        } else {
            $rapidRatings = Student::select('photo', 'name', 'rating_rapid', 'rating_rapid_change_class', 'rating_rapid_change')
                ->where('deleted_at', null)
                ->orderByDesc('rating_rapid')
                ->limit(12)
                ->get();
            Cache::forever('ratingRapid', $rapidRatings);
        }


        return view('components.rating', ['classicRatings' => $classicRatings, 'rapidRatings' => $rapidRatings, ]);
    }
}
