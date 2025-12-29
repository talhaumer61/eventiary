
<!-- Page Header -->
<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Design Your Card</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Design Your Card</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header Close -->

<!-- Start::row-1 -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body add-products p-3">
                <form id="cardForm" action="{{ route('cards.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $eventId }}">
                    <input type="hidden" name="image_base64" id="image_base64">

                    <!-- hidden metadata fields to persist -->
                    <input type="hidden" name="background_type" id="background_type" value="color">
                    <input type="hidden" name="background_color" id="background_color" value="#f9f9f9">
                    <input type="hidden" name="background_color2" id="background_color2" value="">
                    <input type="hidden" name="bg_image_base64" id="bg_image_base64" value="">
                    <input type="hidden" name="text_align" id="hidden_text_align" value="left">
                    <input type="hidden" name="font_family" id="hidden_font_family" value="Arial">
                    <input type="hidden" name="font_size" id="hidden_font_size" value="16">

                    <div class="row">
                        <!-- Inputs -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label>Event Name</label>
                                <input type="text" class="form-control" name="card_data[event_name]" id="eventName" required>
                            </div>

                            <div class="mb-3">
                                <label>Date</label>
                                <input type="date" class="form-control" name="card_data[date]" id="eventDate">
                            </div>

                            <div class="mb-3">
                                <label>Venue</label>
                                <input type="text" class="form-control" name="card_data[venue]" id="eventVenue">
                            </div>

                            <div class="mb-3">
                                <label>Message</label>
                                <textarea class="form-control" name="card_data[message]" id="eventMessage"></textarea>
                            </div>

                            <hr>

                            <!-- Background selection -->
                            <div class="mb-2">
                                <label class="d-block">Background Type</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="bgType" id="bgTypeColor" value="color" checked>
                                    <label class="form-check-label" for="bgTypeColor">Color</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="bgType" id="bgTypeGradient" value="gradient">
                                    <label class="form-check-label" for="bgTypeGradient">Gradient</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="bgType" id="bgTypeImage" value="image">
                                    <label class="form-check-label" for="bgTypeImage">Image</label>
                                </div>
                            </div>

                            <div class="mb-3" id="colorControls">
                                <label>Background Color</label>
                                <input type="color" class="form-control form-control-color" id="bgColor1" value="#f9f9f9">
                            </div>

                            <div class="mb-3 d-none" id="gradientControls">
                                <label>Gradient Colors</label>
                                <div class="d-flex gap-2">
                                    <input type="color" class="form-control form-control-color" id="bgColorA" value="#ffffff">
                                    <input type="color" class="form-control form-control-color" id="bgColorB" value="#ededed">
                                </div>
                            </div>

                            <div class="mb-3 d-none" id="imageControls">
                                <label>Background Image</label>
                                <input type="file" class="form-control" id="bgImageInput" accept="image/*">
                                <small class="text-muted">Uploaded image will be embedded into the saved card (no separate upload required).</small>
                            </div>

                            <hr>

                            <!-- Text alignment -->
                            <div class="mb-3">
                                <label>Text Alignment</label>
                                <select class="form-select" id="textAlign">
                                    <option value="left">Left</option>
                                    <option value="center">Center</option>
                                    <option value="right">Right</option>
                                </select>
                            </div>

                            <!-- Font Family -->
                            <div class="mb-3">
                                <label>Font Family</label>
                                <select class="form-select" id="fontFamily">
                                    <option value="Arial">Arial</option>
                                    <option value="Helvetica, Arial">Helvetica</option>
                                    <option value="Verdana">Verdana</option>
                                    <option value="'Times New Roman', Times, serif">Times New Roman</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="'Courier New', Courier, monospace">Courier New</option>
                                    <option value="'Trebuchet MS'">Trebuchet MS</option>
                                </select>
                            </div>

                            <!-- Font Size -->
                            <div class="mb-3">
                                <label>Font Size (px)</label>
                                <input type="number" class="form-control" id="fontSize" min="10" max="72" value="16">
                            </div>

                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary" id="previewBtn">Preview</button>
                                <button type="submit" class="btn btn-success">Save Card</button>
                            </div>
                        </div>

                        <!-- Live Preview -->
                        <div class="col-md-8 d-flex justify-content-center align-items-center">
                            <div id="cardPreview" style="width:500px; height:250px; padding:20px; border:1px solid #ccc; background:#f9f9f9; background-size:cover; background-position:center;">
                                <h3 id="previewName" class="fw-bold">Your Event</h3>
                                <p id="previewDate">Date: </p>
                                <p id="previewVenue">Venue: </p>
                                <p id="previewMessage">Message here...</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Ensure heading/paragraphs inherit parent font-size/family -->
<style>
    #cardPreview h3, #cardPreview p {
        margin: 6px 0;
        font-size: inherit;
        font-family: inherit;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
(function(){
    // elements
    const previewBtn = document.getElementById('previewBtn');
    const cardPreview = document.getElementById('cardPreview');

    const eventName = document.getElementById('eventName');
    const eventDate = document.getElementById('eventDate');
    const eventVenue = document.getElementById('eventVenue');
    const eventMessage = document.getElementById('eventMessage');

    const previewName = document.getElementById('previewName');
    const previewDate = document.getElementById('previewDate');
    const previewVenue = document.getElementById('previewVenue');
    const previewMessage = document.getElementById('previewMessage');

    const bgTypeColor = document.getElementById('bgTypeColor');
    const bgTypeGradient = document.getElementById('bgTypeGradient');
    const bgTypeImage = document.getElementById('bgTypeImage');

    const colorControls = document.getElementById('colorControls');
    const gradientControls = document.getElementById('gradientControls');
    const imageControls = document.getElementById('imageControls');

    const bgColor1 = document.getElementById('bgColor1');
    const bgColorA = document.getElementById('bgColorA');
    const bgColorB = document.getElementById('bgColorB');
    const bgImageInput = document.getElementById('bgImageInput');

    const textAlign = document.getElementById('textAlign');
    const fontFamily = document.getElementById('fontFamily');
    const fontSize = document.getElementById('fontSize');

    // hidden fields
    const hiddenBgType = document.getElementById('background_type');
    const hiddenBgColor = document.getElementById('background_color');
    const hiddenBgColor2 = document.getElementById('background_color2');
    const hiddenBgImage = document.getElementById('bg_image_base64');

    const hiddenTextAlign = document.getElementById('hidden_text_align');
    const hiddenFontFamily = document.getElementById('hidden_font_family');
    const hiddenFontSize = document.getElementById('hidden_font_size');

    // helper to toggle bg controls visibility
    function updateBgControls() {
        colorControls.classList.toggle('d-none', !bgTypeColor.checked);
        gradientControls.classList.toggle('d-none', !bgTypeGradient.checked);
        imageControls.classList.toggle('d-none', !bgTypeImage.checked);
    }

    // update preview content & styles
    function updatePreview() {
        // content
        previewName.innerText = eventName.value || 'Your Event';
        previewDate.innerText = eventDate.value ? ('Date: ' + eventDate.value) : 'Date: ';
        previewVenue.innerText = eventVenue.value ? ('Venue: ' + eventVenue.value) : 'Venue: ';
        previewMessage.innerText = eventMessage.value || 'Message here...';

        // background logic
        if (bgTypeColor.checked) {
            const c = bgColor1.value;
            cardPreview.style.backgroundImage = '';
            cardPreview.style.background = c;
            hiddenBgType.value = 'color';
            hiddenBgColor.value = c;
            hiddenBgColor2.value = '';
            hiddenBgImage.value = '';
        } else if (bgTypeGradient.checked) {
            const a = bgColorA.value;
            const b = bgColorB.value;
            const grad = `linear-gradient(135deg, ${a}, ${b})`;
            cardPreview.style.backgroundImage = '';
            cardPreview.style.background = grad;
            hiddenBgType.value = 'gradient';
            hiddenBgColor.value = a;
            hiddenBgColor2.value = b;
            hiddenBgImage.value = '';
        } else if (bgTypeImage.checked) {
            // if image is already loaded on preview (set by file reader) keep it; otherwise nothing
            hiddenBgType.value = 'image';
            // hiddenBgImage will be set in file reader callback when image is chosen
        }

        // text align
        cardPreview.style.textAlign = textAlign.value;
        hiddenTextAlign.value = textAlign.value;

        // font family & size
        cardPreview.style.fontFamily = fontFamily.value;
        cardPreview.style.fontSize = fontSize.value + 'px';
        hiddenFontFamily.value = fontFamily.value;
        hiddenFontSize.value = fontSize.value;
    }

    // bg image file read
    bgImageInput.addEventListener('change', function(e){
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(ev) {
            const dataUrl = ev.target.result;
            cardPreview.style.backgroundImage = `url(${dataUrl})`;
            cardPreview.style.backgroundSize = 'cover';
            cardPreview.style.backgroundPosition = 'center';
            hiddenBgImage.value = dataUrl;
            hiddenBgType.value = 'image';
        };
        reader.readAsDataURL(file);
    });

    // live update when inputs change
    [eventName, eventDate, eventVenue, eventMessage, bgColor1, bgColorA, bgColorB, textAlign, fontFamily, fontSize].forEach(el => {
        el.addEventListener('input', updatePreview);
        el.addEventListener('change', updatePreview);
    });

    // bg type radio change
    [bgTypeColor, bgTypeGradient, bgTypeImage].forEach(r => r.addEventListener('change', function(){
        updateBgControls();
        updatePreview();
    }));

    // Preview button
    previewBtn.addEventListener('click', function(){
        updatePreview();
    });

    // initial render
    updateBgControls();
    updatePreview();

    // submit: capture image via html2canvas, attach to hidden input, then submit
    document.getElementById('cardForm').addEventListener('submit', function(e){
        e.preventDefault();
        updatePreview(); // ensure hidden fields up-to-date

        // small timeout to ensure bg image has applied if user just selected it
        setTimeout(() => {
            html2canvas(cardPreview, {allowTaint: true, useCORS: true}).then(canvas => {
                document.getElementById('image_base64').value = canvas.toDataURL("image/png");
                // submit the form normally
                e.target.submit();
            }).catch(err => {
                console.error('html2canvas error:', err);
                // fallback: submit without image (not ideal)
                e.target.submit();
            });
        }, 150);
    });
})();
</script>
