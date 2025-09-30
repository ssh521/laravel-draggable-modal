<?php

namespace PhilipShin\LaravelDraggableModal\View\Components;

use Illuminate\View\Component;

class ModalTrigger extends Component
{
    public string $text;
    public ?string $modalId;
    public string $variant;
    public string $type;
    public string $modalType;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $text = 'Open Modal',
        ?string $modalId = null,
        string $variant = 'primary',
        string $type = 'button',
        string $modalType = 'multi'
    ) {
        $this->text = $text;
        $this->modalId = $modalId;
        $this->variant = $variant;
        $this->type = $type;
        $this->modalType = $modalType;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('draggable-modal::components.modal-trigger');
    }
}