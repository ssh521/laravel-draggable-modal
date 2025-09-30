// 전역 모달 관리자 초기화
if (!window.modalManager) {
    window.modalManager = {
        modals: new Map(),
        maxZIndex: 1000,
        
        register(modalId, component) {
            console.log('모달 등록:', modalId);
            this.modals.set(modalId, component);
        },
        
        unregister(modalId) {
            console.log('모달 해제:', modalId);
            this.modals.delete(modalId);
        },
        
        bringToFront(modalId) {
            this.maxZIndex += 1;
            const modal = this.modals.get(modalId);
            if (modal) {
                modal.zIndex = this.maxZIndex;
            }
            return this.maxZIndex;
        },
        
        getNextZIndex() {
            this.maxZIndex += 1;
            return this.maxZIndex;
        }
    };
}

// 다중 모달을 지원하는 드래그 가능한 모달 컴포넌트
export default function draggableModal(config = {}) {
    return {
        // 기본 설정값
        defaultConfig: {
            initialX: 100,
            initialY: 100,
            initialWidth: 800,
            initialHeight: 600,
            minWidth: 300,
            minHeight: 200,
            maxWidth: window.innerWidth - 50,
            maxHeight: window.innerHeight - 50,
            zIndex: 1000
        },

        // 상태 변수들
        modalId: config.modalId || 'modal-' + Math.random().toString(36).substr(2, 9),
        isOpen: false,
        zIndex: 1000,
        pos: { x: 100, y: 100 },
        size: { w: 800, h: 600 },
        dragOffset: null,
        resizeOrigin: null,

        init() {
            console.log('draggableModalMulti 초기화:', this.modalId, config);
            
            // 설정 병합 및 타입 변환
            const finalConfig = { ...this.defaultConfig, ...config };
            
            // 숫자로 변환
            this.zIndex = window.modalManager.getNextZIndex();
            this.pos.x = parseInt(finalConfig.initialX) || 100;
            this.pos.y = parseInt(finalConfig.initialY) || 100;
            this.size.w = parseInt(finalConfig.initialWidth) || 800;
            this.size.h = parseInt(finalConfig.initialHeight) || 600;
            
            console.log('최종 설정:', {
                modalId: this.modalId,
                pos: this.pos,
                size: this.size,
                zIndex: this.zIndex
            });
            
            // 모달 매니저에 등록
            window.modalManager.register(this.modalId, this);
            
            // 모달 닫기 이벤트 리스너 추가
            window.addEventListener('draggable-modal-close', (event) => {
                if (event.detail.modalId === this.modalId && event.detail.action === 'close') {
                    this.close();
                }
            });
        },

        get style() {
            return `top: ${this.pos.y}px; left: ${this.pos.x}px; width: ${this.size.w}px; height: ${this.size.h}px; z-index: ${this.zIndex}`;
        },

        openModal() {
            console.log('모달 열기:', this.modalId);
            this.isOpen = true;
            this.bringToFront();
            // 모달 열기 이벤트 디스패치
            window.dispatchEvent(new CustomEvent('draggable-modal-opened', {
                detail: { modalId: this.modalId }
            }));
        },

        closeModal() {
            console.log('모달 닫기 (closeModal):', this.modalId);
            this.isOpen = false;
            window.modalManager.unregister(this.modalId);
            // 이벤트 디스패치
            this.$dispatch('modal-closed', { modalId: this.modalId });
        },

        bringToFront() {
            this.zIndex = window.modalManager.bringToFront(this.modalId);
        },

        close() {
            console.log('모달 닫기:', this.modalId);
            this.isOpen = false;
            window.modalManager.unregister(this.modalId);
            // 이벤트 디스패치
            this.$dispatch('modal-closed', { modalId: this.modalId });
        },

        dragStart(e) {
            e.preventDefault();
            e.stopPropagation();
            this.bringToFront();
            
            this.dragOffset = {
                x: e.clientX - this.pos.x,
                y: e.clientY - this.pos.y,
            };

            const onMouseMove = (e) => {
                const newX = e.clientX - this.dragOffset.x;
                const newY = e.clientY - this.dragOffset.y;
                
                // 화면 경계 체크
                const maxX = window.innerWidth - this.size.w;
                const maxY = window.innerHeight - this.size.h;
                
                this.pos.x = Math.max(0, Math.min(newX, maxX));
                this.pos.y = Math.max(0, Math.min(newY, maxY));
            };

            const onMouseUp = () => {
                window.removeEventListener("mousemove", onMouseMove);
                window.removeEventListener("mouseup", onMouseUp);
            };

            window.addEventListener("mousemove", onMouseMove);
            window.addEventListener("mouseup", onMouseUp);
        },

        resizeStart(e) {
            e.preventDefault();
            e.stopPropagation();
            this.bringToFront();
            
            this.resizeOrigin = {
                x: e.clientX,
                y: e.clientY,
                w: this.size.w,
                h: this.size.h,
            };

            const onMouseMove = (e) => {
                const newWidth = this.resizeOrigin.w + (e.clientX - this.resizeOrigin.x);
                const newHeight = this.resizeOrigin.h + (e.clientY - this.resizeOrigin.y);
                
                // 최소/최대 크기 제한
                this.size.w = Math.max(this.defaultConfig.minWidth, 
                                     Math.min(newWidth, this.defaultConfig.maxWidth));
                this.size.h = Math.max(this.defaultConfig.minHeight, 
                                     Math.min(newHeight, this.defaultConfig.maxHeight));
            };

            const onMouseUp = () => {
                window.removeEventListener("mousemove", onMouseMove);
                window.removeEventListener("mouseup", onMouseUp);
            };

            window.addEventListener("mousemove", onMouseMove);
            window.addEventListener("mouseup", onMouseUp);
        }
    };
} 