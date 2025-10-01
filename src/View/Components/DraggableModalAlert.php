<?php

namespace ssh521\LaravelDraggableModal\View\Components;

use Illuminate\View\Component;

class DraggableModalAlert extends Component
{
    public string $title;
    public string $message;
    public string $type;
    public bool $showCloseButton;
    public bool $closeOnBackdropClick;
    public bool $closeOnEscape;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $title = '알림',
        string $message = '',
        string $type = 'info',
        bool $showCloseButton = true,
        bool $closeOnBackdropClick = false,
        bool $closeOnEscape = true
    ) {
        $this->title = $title;
        $this->message = $message;
        $this->type = $type;
        $this->showCloseButton = $showCloseButton;
        $this->closeOnBackdropClick = $closeOnBackdropClick;
        $this->closeOnEscape = $closeOnEscape;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('draggable-modal::components.draggable-modal-alert');
    }
}