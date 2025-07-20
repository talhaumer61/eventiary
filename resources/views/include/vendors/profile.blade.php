<section class="ttm-row vendor-profile-section clearfix">
    <div class="container">
        <div class="row mb-5">
            <!-- Vendor Info -->
            <div class="col-md-4 text-center">
                <img class="img-fluid rounded-circle mb-3" src="{{ asset($vendor->photo ?? 'default.jpg') }}" alt="{{ $vendor->name }}" style="max-width: 200px;">
                <h3>{{ $vendor->name }}</h3>
                <p>Email: {{ $vendor->email }}</p>
                <p>Phone: {{ $vendor->phone }}</p>
                <!-- Add other fields if needed -->
                <form method="POST" action="{{ route('conversation.start') }}">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $vendor->id }}">
                    <input type="hidden" name="event_id" value="{{ $event->event_id ?? '' }}">
                    <button type="submit" class="btn btn-primary mt-3">Message Vendor</button>
                </form>
            </div>

            <!-- Vendor Services -->
            <div class="col-md-8">
                <h4>Services Offered</h4>
                @if(count($services))
                    <div class="row">
                        @foreach($services as $service)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $service->title }}</h5>
                                        <p class="card-text">{{ $service->description }}</p>
                                        <p><strong>Price:</strong> Rs. {{ $service->price }}</p>
                                        <!-- Optional: add booking button -->
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>This vendor has not listed any services yet.</p>
                @endif
            </div>
        </div>
    </div>
</section>
