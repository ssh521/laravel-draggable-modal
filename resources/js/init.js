// Import the modal manager
import draggableModal, { draggableModalAlert } from './modal-manager';

// Alpine.js 컴포넌트 초기화
document.addEventListener('alpine:init', () => {
    // 다중 모달을 지원하는 드래그 가능한 모달 컴포넌트
    Alpine.data('draggableModal', draggableModal);
    // Alert 전용 모달 컴포넌트 등록
    Alpine.data('draggableModalAlert', draggableModalAlert);
});

// 모달 이벤트 리스너 등록
document.addEventListener('open-modal-multi', (event) => {
    console.log('open-modal-multi 이벤트 수신:', event.detail);
    const modalId = event.detail.modalId;

    // 해당 모달을 찾아서 열기
    const modalElement = document.querySelector(`[x-data*="modalId: '${modalId}'"]`);
    if (modalElement) {
        // Alpine.js 컴포넌트에 접근하여 모달 열기
        const alpineComponent = Alpine.$data(modalElement);
        if (alpineComponent && alpineComponent.openModal) {
            alpineComponent.openModal();
        }
    } else {
        console.warn(`모달을 찾을 수 없습니다: ${modalId}`);
    }
});

document.addEventListener('draggable-modal', (event) => {
    console.log('draggable-modal 이벤트 수신:', event.detail);
    const modalId = event.detail.modalId;

    // 해당 모달을 찾아서 열기
    const modalElement = document.querySelector(`[x-data*="modalId: '${modalId}'"]`);
    if (modalElement) {
        // Alpine.js 컴포넌트에 접근하여 모달 열기
        const alpineComponent = Alpine.$data(modalElement);
        if (alpineComponent && alpineComponent.openModal) {
            alpineComponent.openModal();
        }
    } else {
        console.warn(`모달을 찾을 수 없습니다: ${modalId}`);
    }
});