<?php

namespace ssh521\LaravelDraggableModal\View\Components;

use Illuminate\View\Component;

class DraggableModalMulti extends Component
{
    public string $title;
    public int $width;
    public int $height;
    public int $minWidth;
    public int $minHeight;
    public ?int $initialX;
    public ?int $initialY;
    public bool $showCloseButton;
    public bool $showResizeHandle;
    public bool $closeOnEscape;
    public bool $closeOnBackdropClick;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $title = '',
        int $width = 800,
        int $height = 600,
        int $minWidth = 300,
        int $minHeight = 200,
        ?int $initialX = null,
        ?int $initialY = null,
        bool $showCloseButton = true,
        bool $showResizeHandle = true,
        bool $closeOnEscape = true,
        bool $closeOnBackdropClick = false
    ) {
        $this->title = $title;
        $this->width = $width;
        $this->height = $height;
        $this->minWidth = $minWidth;
        $this->minHeight = $minHeight;
        $this->initialX = $initialX;
        $this->initialY = $initialY;
        $this->showCloseButton = $showCloseButton;
        $this->showResizeHandle = $showResizeHandle;
        $this->closeOnEscape = $closeOnEscape;
        $this->closeOnBackdropClick = $closeOnBackdropClick;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('draggable-modal::components.draggable-modal-multi');
    }
}