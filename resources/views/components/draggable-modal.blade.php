@props([
'title' => '',
'width' => 800,
'height' => 600,
'minWidth' => 300,
'minHeight' => 200,
'initialX' => null,
'initialY' => null,
'showCloseButton' => true,
'showResizeHandle' => true,
'closeOnEscape' => true,
'closeOnBackdropClick' => false
])

@php
$modalId = $attributes->get('id', 'draggable-modal-' . uniqid());

// 화면 중앙에 위치하도록 계산
$centerX = $initialX ?? 'Math.floor((window.innerWidth - ' . $width . ') / 2)';
$centerY = $initialY ?? 'Math.floor((window.innerHeight - ' . $height . ') / 2)';
@endphp

<div x-cloak x-data="draggableModal({
    modalId: '{{ $modalId }}',
    initialWidth: {{ $width }},
    initialHeight: {{ $height }},
    minWidth: {{ $minWidth }},
    minHeight: {{ $minHeight }},
    initialX: {{ $centerX }},
    initialY: {{ $centerY }}
})" x-show="isOpen" 
@keydown.escape.window="{{ $closeOnEscape ? 'close()' : '' }}"
@open-modal.window="if ($event.detail.modalId === '{{ $modalId }}') openModal()"
@close-modal.window="if ($event.detail.modalId === '{{ $modalId }}') close()"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 dark:bg-black/70" id="{{ $modalId }}" 
    {{ $attributes->merge(['class' => '']) }}
    x-bind:style="`z-index: ${zIndex}`"
    draggable="false"
    >

    <!-- 모달 박스 -->
    <div x-ref="modal" x-show="isOpen" @keydown.escape.window="close" @mousedown.stop="bringToFront" :style="style"
        class="bg-white dark:bg-gray-800 rounded-lg shadow-lg dark:shadow-gray-900/50 absolute p-0 min-w-[300px] border border-gray-200 dark:border-gray-700">

        <!-- 헤더 -->
        <div class="cursor-move flex justify-between items-center bg-gradient-to-r from-indigo-300 to-indigo-400 dark:from-indigo-600 dark:to-indigo-700 px-3 py-1.5 rounded-t-lg border-indigo-500 dark:border-indigo-600 transform hover:scale-[1] transition-transform duration-200"
            @mousedown.stop="dragStart">

            <span class="text-sm font-semibold text-white drop-shadow-sm">
                {{ $title }}
            </span>

            @if($showCloseButton)
            <button @click="close" class="hover:bg-indigo-500 dark:hover:bg-indigo-600 rounded-full p-1 transition-colors duration-200">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                </svg>
            </button>
            @endif
        </div>

        <!-- 모달 콘텐츠 -->
        <div class="text-sm overflow-y-auto text-gray-900 dark:text-gray-100" style="max-height: calc(100% - 60px);">
            {{ $slot }}
        </div>

        <!-- 리사이즈 핸들 -->
        @if($showResizeHandle)
        <div class="absolute bottom-0 right-0 w-6 h-6 cursor-se-resize flex items-center justify-center"
            @mousedown.stop="resizeStart">
            <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M22 22H20V20H22V22ZM22 18H20V16H22V18ZM18 22H16V20H18V22ZM18 18H16V16H18V18ZM14 22H12V20H14V22ZM22 14H20V12H22V14Z" />
            </svg>
        </div>
        @endif
    </div>
</div>