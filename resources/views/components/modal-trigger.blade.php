@props([
    'text' => 'Open Modal',
    'modalId' => null,
    'modal-id' => null, // kebab-case 지원
    'variant' => 'primary', // primary, secondary, danger, warning, success, info
    'type' => 'button', // button, link
    'modalType' => 'multi' // multi, single, alert
])

@php
    // 버튼 스타일 클래스 정의
    $buttonClasses = match($variant) {
        'primary' => 'bg-indigo-600 dark:bg-indigo-500 hover:bg-indigo-700 dark:hover:bg-indigo-400 text-white',
        'secondary' => 'bg-gray-600 dark:bg-gray-500 hover:bg-gray-700 dark:hover:bg-gray-400 text-white',
        'danger' => 'bg-red-600 dark:bg-red-500 hover:bg-red-700 dark:hover:bg-red-400 text-white',
        'warning' => 'bg-yellow-500 dark:bg-yellow-400 hover:bg-yellow-600 dark:hover:bg-yellow-300 text-black',
        'success' => 'bg-green-600 dark:bg-green-500 hover:bg-green-700 dark:hover:bg-green-400 text-white',
        'info' => 'bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 dark:hover:bg-blue-400 text-white',
        default => 'bg-indigo-600 dark:bg-indigo-500 hover:bg-indigo-700 dark:hover:bg-indigo-400 text-white'
    };
    
    // 링크 스타일 클래스 정의
    $linkClasses = match($variant) {
        'primary' => 'text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300',
        'secondary' => 'text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-300',
        'danger' => 'text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300',
        'warning' => 'text-yellow-600 dark:text-yellow-400 hover:text-yellow-800 dark:hover:text-yellow-300',
        'success' => 'text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300',
        'info' => 'text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300',
        default => 'text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300'
    };
    
    // 공통 클래스
    $commonClasses = 'font-medium transition-colors duration-200 cursor-pointer';
@endphp

@php
    // modalId 처리 (kebab-case 우선, 없으면 camelCase)
    $finalModalId = $modalId ?? $attributes->get('modal-id');
    
    // 모달 타입에 따른 이벤트 결정
    $eventName = match($modalType) {
        'multi' => 'open-modal-multi',
        'single' => 'draggable-modal',
        'alert' => 'open-alert-modal',
        default => 'open-modal-multi'
    };
@endphp

@if($type === 'link')
    {{-- 링크 형태로 렌더링 --}}
    <a 
        @click.prevent="$dispatch('{{ $eventName }}', { modalId: '{{ $finalModalId }}' })"
        class="{{ $commonClasses }} {{ $linkClasses }}"
        {{ $attributes->merge(['class' => '']) }}>
        {{ $text }}
    </a>
@else
    {{-- 버튼 형태로 렌더링 (기본값) --}}
    <button 
        @click="$dispatch('{{ $eventName }}', { modalId: '{{ $finalModalId }}' })"
        class="px-4 py-2 rounded-md {{ $commonClasses }} {{ $buttonClasses }}"
        {{ $attributes->merge(['class' => '']) }}>
        {{ $text }}
    </button>
@endif 