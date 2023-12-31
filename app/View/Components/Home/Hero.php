<?php

namespace App\View\Components\Home;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Hero extends Component
{

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $steps = $this->getSteps();
        return view('components.home.hero', compact('steps'));
    }

    private function getSteps(): array
    {
        return [
            [
                'title' => '70+ million songs',
                'description' => 'Find new loves and old favorites from over 80 million tracks.',
            ],
            [
                'title' => 'High-fidelity sound quality',
                'description' => 'Clearly hear the best sound offline.',
            ],
            [
                'title' => 'Anytime. Anywhere',
                'description' => 'Listen on your terms on any device.',
            ],
        ];
    }
}
