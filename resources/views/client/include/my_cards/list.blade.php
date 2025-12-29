<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Cards List</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Cards</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">My Event Cards</div>
                <div class="d-flex">
                    <a href="/my-events" class="btn btn-sm btn-primary btn-wave waves-light"><i class="ri-add-line fw-medium align-middle me-1"></i> Design For Event</a>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table text-nowrap align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Event Name</th>
                                <th>Preview</th>
                                <th>Share</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cards as $index => $card)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $card->event->event_name ?? 'N/A' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#previewModal"
                                            data-image="{{ asset($card->image_path) }}">
                                            <i class="ri-eye-line"></i> View
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#shareModal"
                                            data-card="{{ $card->id }}"
                                            data-image="{{ asset($card->image_path) }}">
                                            <i class="ri-share-line"></i> Share
                                        </button>
                                    </td>

                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">No cards found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 🔍 Card Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="previewModalLabel">Card Preview</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img id="previewImage" src="" class="img-fluid rounded" alt="Card Preview">
      </div>
    </div>
  </div>
</div>

<!-- 📤 Share Card Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" action="{{ route('client.cards.share') }}">
        @csrf
        <input type="hidden" name="card_id" id="shareCardId">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareModalLabel">Share Card via Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="recipientName" class="form-label">Recipient Name</label>
                    <input type="text" class="form-control" id="recipientName" name="name" placeholder="Enter recipient name">
                </div>
                <div class="mb-3">
                    <label for="recipientEmail" class="form-label">Recipient Email</label>
                    <input type="email" class="form-control" id="recipientEmail" name="email" placeholder="Enter recipient email" required>
                </div>
                <div class="text-center">
                    <img id="sharePreviewImage" src="" alt="Card preview" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Send</button>
            </div>
        </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // For preview modal
    const previewModal = document.getElementById('previewModal');
    previewModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const imageSrc = button.getAttribute('data-image');
        document.getElementById('previewImage').src = imageSrc;
    });

    // For share modal
    const shareModal = document.getElementById('shareModal');
    shareModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const cardId = button.getAttribute('data-card');
        const imageSrc = button.getAttribute('data-image');
        document.getElementById('shareCardId').value = cardId;
        document.getElementById('sharePreviewImage').src = imageSrc;
    });
});
</script>
