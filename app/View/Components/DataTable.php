<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class DataTable extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Collection $filling,
        public string $mail
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // dd($this->filling);
        return view('components.data-table');
    }
}
