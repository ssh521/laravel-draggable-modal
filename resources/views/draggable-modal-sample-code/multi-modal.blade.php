<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi Draggable Modal Demo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-10" x-data="{}">
    <h1 class="text-2xl font-bold mb-4">멀티 드래그 모달 데모</h1>

    <div class="space-x-2 mb-6">
        <x-modal-trigger text="모달 A 열기" variant="info" modal-id="multi1" modal-type="multi" />
        <x-modal-trigger text="모달 B 열기" variant="success" modal-id="multi2" modal-type="multi" />
        <x-modal-trigger text="모달 C 열기" variant="primary" modal-id="multi3" modal-type="multi" />
    </div>

    <x-draggable-modal-multi id="multi1" title="모달 A" :width="520" :height="340">
        <div class="p-5 space-y-2">
            <p>이것은 멀티 모달 A 입니다.</p>
            <p class="text-sm text-gray-600">타이틀바를 드래그해 이동하고, 우하단을 드래그해 크기를 조절하세요.</p>
        </div>
    </x-draggable-modal-multi>

    <x-draggable-modal-multi id="multi2" title="모달 B" :width="640" :height="420" :initialX="120" :initialY="140">
        <div class="p-5">
            <h3 class="text-lg font-semibold mb-2">목록</h3>
            <ul class="list-disc list-inside space-y-1">
                <li>여러 모달을 동시에 열 수 있습니다.</li>
                <li>활성화 시 자동으로 맨 앞으로 옵니다.</li>
                <li>ESC 키로 닫을 수 있습니다.</li>
            </ul>
        </div>
    </x-draggable-modal-multi>

    <x-draggable-modal-multi id="multi3" title="모달 C" :width="700" :height="500">
        <div class="p-5 space-y-3">
            <p>내용이 길어지면 내부에서 스크롤 됩니다.</p>
            <div class="space-y-2">
                <p>라인 1</p>
                <p>라인 2</p>
                <p>라인 3</p>
                <p>라인 4</p>
                <p>라인 5</p>
                <p>라인 6</p>
                <p>라인 7</p>
                <p>라인 8</p>
                <p>라인 9</p>
                <p>라인 10</p>
            </div>
        </div>
    </x-draggable-modal-multi>

    
</body>
</html>

