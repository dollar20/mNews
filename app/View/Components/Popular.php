<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\News;

class Popular extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
		$popularNews = News::with('comments')->get()->sortBy(function($news)
		{
			return $news->comments->count();
		});
        return view('components.popular',compact('popularNews'));
    }
}
