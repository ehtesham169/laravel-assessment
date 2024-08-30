<?php
namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $body;

    /**
     * Create a new component instance.
     *
     * @param  string  $title
     * @param  string  $body
     * @return void
     */
    public function __construct($title, $body = '')
    {
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.card.card');
    }
}
