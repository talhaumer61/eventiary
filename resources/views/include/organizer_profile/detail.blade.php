
<section class="ttm-row profile-header-section clearfix" style="padding:60px 0;">
    <div class="container text-center">

        <img src="{{ asset($organizer->photo) }}" 
             class="rounded-circle mb-3" 
             style="width:150px;height:150px;object-fit:cover;">

        <h2>{{ $organizer->name }}</h2>
        <p class="text-muted">Professional Event Organizer</p>

        <form method="POST" action="{{ route('conversation.start') }}" class="mt-3">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $organizer->id }}">
            <button type="submit" class="btn btn-primary">
                <i class="ti ti-message"></i> Message
            </button>
        </form>

    </div>
</section>

<hr>

<section class="ttm-row pt-50 pb-50 clearfix">
    <div class="container">

        <h3 class="mb-4">Portfolio</h3>

        <div class="row">
            @forelse($portfolios as $item)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset($item->image) }}" class="card-img-top" 
                             style="height:200px;object-fit:cover;">
                        <div class="card-body">
                            <h5>{{ $item->title }}</h5>
                            <p>{{ Str::limit($item->description, 100) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">No portfolio items added yet.</p>
            @endforelse
        </div>


        <h3 class="my-4">Our Team</h3>

        <div class="row">
            @forelse($team as $member)
                <div class="col-md-3 mb-4">
                    <div class="card text-center shadow-sm">
                        <img src="{{ asset($member->photo) }}" 
                             class="card-img-top" 
                             style="height:180px;object-fit:cover;">

                        <div class="card-body">
                            <h5>{{ $member->name }}</h5>
                            <p class="text-muted">{{ $member->designation }}</p>
                            <p>{{ Str::limit($member->bio, 70) }}</p>

                            <div class="d-flex justify-content-center gap-2">
                                @if($member->facebook)
                                    <a href="{{ $member->facebook }}" target="_blank"><i class="ti ti-brand-facebook"></i></a>
                                @endif
                                @if($member->instagram)
                                    <a href="{{ $member->instagram }}" target="_blank"><i class="ti ti-brand-instagram"></i></a>
                                @endif
                                @if($member->linkedin)
                                    <a href="{{ $member->linkedin }}" target="_blank"><i class="ti ti-brand-linkedin"></i></a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">No team members added yet.</p>
            @endforelse
        </div>

    </div>
</section>


<section class="ttm-row pt-50 pb-50 clearfix">
    <div class="container">
        <h3 class="mb-4">Reviews ({{ count($reviews) }})</h3>

        @if($reviews->count())
            @foreach($reviews as $review)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">

                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset($review->reviewer->photo ?? 'uploads/default.png') }}" 
                                style="width:50px;height:50px;border-radius:50%;object-fit:cover;">

                            <div class="ms-3">
                                <strong>{{ $review->reviewer->name ?? 'Unknown User' }}</strong>

                                <div class="text-warning">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                                        @else
                                            <i class="fa-regular fa-star" style="color: #ccc;"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>

                        </div>

                        <p class="mt-2">{{ $review->review }}</p>

                    </div>
                </div>
            @endforeach
        @else
            <p class="text-muted">No reviews yet.</p>
        @endif
    </div>
</section>

