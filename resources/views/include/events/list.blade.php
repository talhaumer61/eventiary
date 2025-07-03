<section class="ttm-row upcoming-event-section">
    <div class="container">
        <div class="row">
            @forelse ($events as $event)
                <div class="col-md-6 col-lg-4 mb-30">
                    <!-- featured-imagebox -->
                    <div class="featured-imagebox ttm-box-view-top-image featured-imagebox-post-details">
                        <div class="featured-thumbnail">
                            <img class="img-fluid" src="{{ asset($event->event_image ?? 'images/blog/default.jpg') }}" alt="Event Image">
                        </div>
                        <div class="featured-bottom-content text-left position-relative">
                            <div class="ttm-box-post-date shape-rounded ttm-bgcolor-skincolor">
                                <span class="ttm-entry-date">
                                    <time class="entry-date" datetime="{{ $event->event_date }}">
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('d') }}
                                        <span class="entry-month entry-year">
                                            {{ \Carbon\Carbon::parse($event->event_date)->format('M') }}
                                        </span>
                                    </time>
                                </span>
                            </div>
                            <div class="featured-title">
                                <h5>
                                    <a href="{{ url('events/'.$event->event_href) }}">
                                        {{ $event->event_name }}
                                    </a>
                                </h5>
                            </div>
                            {{-- <div class="featured-desc">
                                <p>{{ \Illuminate\Support\Str::limit($event->event_detail, 100) }}</p>
                            </div> --}}
                            <div class="post-meta">
                                <span class="ttm-meta-line">
                                    <i class="fa fa-map-marker"></i>
                                    {{ $event->event_location }}
                                </span>
                            </div>
                            <div class="post-desc-footer">
                                <a class="ttm-btn btn-inline ttm-icon-btn-right ttm-btncolor-black" href="{{ url('events/'.$event->event_href) }}">
                                    See Details <i class="ti ti-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div><!-- featured-imagebox -->
                </div>
            @empty
            <div class="p-4">
                <h3 class="text-center fw-bolder text-danger bg-light p-3 rounded">No events found!</h3>
            </div>
            @endforelse
        </div>
        
    </div>
</section>