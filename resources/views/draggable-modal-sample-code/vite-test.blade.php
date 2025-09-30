<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vite Test - Draggable Modal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-10">
    <h1 class="text-2xl font-bold mb-4">Vite를 통한 모달 테스트</h1>

    <div class="space-x-2">
        <button onclick="openModal('modal1')" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            모달 1 열기
        </button>
        <button onclick="openModal('modal2')" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
            모달 2 열기
        </button>
        <button onclick="openModal('modal3')" class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">
            모달 3 열기
        </button>
    </div>

    <x-draggable-modal id="modal1" title="첫 번째 모달" :width="500" :height="300">
        <div class="p-5">
            <p>이것은 첫 번째 드래그 가능한 모달입니다.</p>
            <p>타이틀바를 드래그하여 이동할 수 있습니다.</p>
            <p class="mt-2 text-sm text-gray-600">init.js를 통해 로드되었습니다.</p>
        </div>
    </x-draggable-modal>

    <x-draggable-modal id="modal2" title="두 번째 모달" :width="600" :height="400" :initialX="150" :initialY="150">
        <div class="p-5">
            <p>이것은 두 번째 드래그 가능한 모달입니다.</p>
            <p>다른 위치에서 시작합니다.</p>
            <ul class="mt-2 list-disc list-inside">
                <li>드래그하여 이동</li>
                <li>우측 하단을 드래그하여 리사이즈</li>
                <li>ESC 키로 닫기</li>
            </ul>
        </div>
    </x-draggable-modal>

    <x-draggable-modal id="modal3" title="세 번째 모달" :width="700" :height="500">
        <div class="p-5">
            <h3 class="text-lg font-semibold mb-2">모달 내용</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <ul class="mt-3 space-y-1">
                <li>• 항목 1</li>
                <li>• 항목 2</li>
                <li>• 항목 3</li>
            </ul>
            <div class="mt-4 p-3 bg-blue-50 rounded">
                <p class="text-sm">여러 모달을 동시에 열 수 있으며, z-index가 자동으로 관리됩니다.</p>
            </div>
        </div>
    </x-draggable-modal>

    <script>
        function openModal(modalId) {
            // init.js에서 등록한 이벤트 리스너가 처리합니다
            window.dispatchEvent(new CustomEvent('draggable-modal', {
                detail: { modalId: modalId }
            }));
        }
    </script>
</body>
</html>