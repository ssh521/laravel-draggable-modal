// Import the modal manager
import draggableModal, { draggableModalAlert } from './modal-manager';

// Alpine.js 컴포넌트 초기화
document.addEventListener('alpine:init', () => {
    // 다중 모달을 지원하는 드래그 가능한 모달 컴포넌트
    Alpine.data('draggableModal', draggableModal);
    // Alert 전용 모달 컴포넌트 등록
    Alpine.data('draggableModalAlert', draggableModalAlert);
});

// 모달 이벤트 리스너 등록 (통합)
document.addEventListener('open-modal', (event) => {
    console.log('open-modal 이벤트 수신:', event.detail);
    const modalId = event.detail?.modalId;

    if (!modalId) return;

    const modalElement = document.querySelector(`[x-data*="modalId: '${modalId}'"]`);
    if (modalElement) {
        const alpineComponent = Alpine.$data(modalElement);
        if (alpineComponent && typeof alpineComponent.openModal === 'function') {
            alpineComponent.openModal();
        }
    } else {
        console.warn(`모달을 찾을 수 없습니다: ${modalId}`);
    }
});

document.addEventListener('close-modal', (event) => {
    console.log('close-modal 이벤트 수신:', event.detail);
    const modalId = event.detail?.modalId;

    if (!modalId) return;

    const modalElement = document.querySelector(`[x-data*="modalId: '${modalId}'"]`);
    if (modalElement) {
        const alpineComponent = Alpine.$data(modalElement);
        if (alpineComponent && typeof alpineComponent.close === 'function') {
            alpineComponent.close();
        }
    } else {
        console.warn(`모달을 찾을 수 없습니다: ${modalId}`);
    }
});