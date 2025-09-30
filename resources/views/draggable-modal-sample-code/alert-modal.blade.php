<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alert Modal Demo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-10" x-data="{}">
    <h1 class="text-2xl font-bold mb-6">Alert 모달 데모</h1>

    <div class="flex flex-wrap gap-2 mb-10">
        <x-modal-trigger text="정보" variant="info" modal-type="alert" modal-id="alert-info" />
        <x-modal-trigger text="성공" variant="success" modal-type="alert" modal-id="alert-success" />
        <x-modal-trigger text="경고" variant="warning" modal-type="alert" modal-id="alert-warning" />
        <x-modal-trigger text="에러" variant="danger" modal-type="alert" modal-id="alert-error" />
        <x-modal-trigger text="primary" variant="primary" modal-id="primary" />
        <x-modal-trigger text="secondary" variant="secondary" modal-id="secondary" />        
    </div>

    <x-draggable-modal-alert id="alert-info" title="정보" type="info" message="일반 정보 메시지입니다." />

    <x-draggable-modal-alert id="alert-success" title="성공" type="success">
        작업이 성공적으로 완료되었습니다.
    </x-draggable-modal-alert>

    <x-draggable-modal-alert id="alert-warning" title="경고" type="warning" :closeOnBackdropClick="true">
        주의가 필요한 상황입니다. 확인을 눌러 닫을 수 있습니다.
    </x-draggable-modal-alert>

    <x-draggable-modal-alert id="alert-error" title="오류" type="error" :showCloseButton="true" :closeOnEscape="true">
        처리 중 오류가 발생했습니다. 다시 시도해주세요.
    </x-draggable-modal-alert>

    <x-draggable-modal-alert id="primary" title="primary" type="primary" message="일반 정보 메시지입니다." />

    <x-draggable-modal-alert id="secondary" title="secondary" type="secondary" message="일반 정보 메시지입니다." />


</body>
</html>


