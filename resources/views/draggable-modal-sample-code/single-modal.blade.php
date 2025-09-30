<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Draggable Modal Demo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-10" x-data="{}">
    <h1 class="text-2xl font-bold mb-6">싱글 드래그 모달 데모</h1>

    <div class="flex flex-wrap gap-2 mb-10">
        <x-modal-trigger text="모달 1 열기" variant="primary" modal-id="single-modal-1" modal-type="single" />
        <x-modal-trigger text="모달 2 열기" variant="secondary" modal-id="single-modal-2" modal-type="single" />
        <x-modal-trigger text="모달 3 열기" variant="success" modal-id="single-modal-3" modal-type="single" />
    </div>

    <x-draggable-modal id="single-modal-1" title="싱글 모달 1" :width="520" :height="340">
        <div class="p-5 space-y-2">
            <p>이것은 싱글 드래그 가능한 모달 1 입니다.</p>
            <p class="text-sm text-gray-600">타이틀바를 드래그해 이동하고, 우하단을 드래그해 크기를 조절하세요.</p>
        </div>
    </x-draggable-modal>

    <x-draggable-modal id="single-modal-2" title="싱글 모달 2" :width="640" :height="420" :initialX="140" :initialY="120">
        <div class="p-5">
            <h3 class="text-lg font-semibold mb-2">내용 예시</h3>
            <ul class="list-disc list-inside space-y-1">
                <li>드래그하여 이동</li>
                <li>우측 하단을 드래그하여 리사이즈</li>
                <li>ESC 키로 닫기</li>
            </ul>
        </div>
    </x-draggable-modal>

    <x-draggable-modal id="single-modal-3" title="싱글 모달 3" :width="700" :height="500">
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
    </x-draggable-modal>

</body>
</html>


