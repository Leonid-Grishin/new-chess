<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainVideo extends Component
{
    public function __construct(
        public ?string $poster = null,
        public ?string $video = null,
        public ?string $videoPreview = null,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.main-video');
    }
}
