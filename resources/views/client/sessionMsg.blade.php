@if (session()->has('msg'))
    <script>
        window.onload = function() {
            const sessionMsgElement = document.getElementById("sessionMsg");
            if (sessionMsgElement) {
                const toast = new bootstrap.Toast(sessionMsgElement, {
                    delay: 5000,
                    autohide: true
                });
                toast.show();
            }
        };
    </script>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="sessionMsg" class="toast colored-toast bg-{{session('msg.type')}} text-white" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000" data-bs-autohide="true">
            <div class="toast-header bg-{{session('msg.type')}} text-white">
                <i class="ri-information-2-line"></i>
                <i class="bx bx-info-circle me-1 fw-bold"></i>
                <strong class="me-auto">{{ session('msg.title') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">{{ session('msg.text') }}</div>
        </div>
    </div>
    @php
        session()->forget('msg');
    @endphp
@endif