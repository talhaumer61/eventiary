<section class="ttm-row team-member-section clearfix">
    <div class="container">
        <div class="row">
            @foreach($organizers as $organizer)
                <div class="col-md-6 col-lg-4 mb-30">
                    <!--team-member-->
                    <div class="featured-imagebox featured-imagebox-team ttm-team-box-view-overlay">
                        <div class="featured-thumbnail">
                            <a href="#">
                                <img class="img-fluid" src="{{ asset(''. ($organizer->photo.'')) }}" alt="{{ $organizer->name }}">
                            </a>
                        </div>
                        <div class="featured-content featured-content-team">
                            <div class="featured-title">
                                <h5><a href="{{ route('organizer.profile', $organizer->id) }}">{{ $organizer->name }}</a></h5>

                                @php
                                    $avg = \App\Models\Review::where('to', $organizer->id)->avg('rating');
                                    $avg = $avg ? number_format($avg, 1) : 0;

                                    $fullStars = floor($avg);                 // e.g., 4
                                    $halfStar  = ($avg - $fullStars) >= 0.5;  // true for 4.5
                                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                @endphp

                                <div class="rating-stars mb-2">

                                    {{-- Full Stars --}}
                                    @for($i = 1; $i <= $fullStars; $i++)
                                        <i class="fa-solid fa-star" style="color:#ffc107;"></i>
                                    @endfor

                                    {{-- Half Star --}}
                                    @if($halfStar)
                                        <i class="fa-regular fa-star-half-stroke" style="color:#ffc107;"></i>
                                    @endif

                                    {{-- Empty Stars --}}
                                    @for($i = 1; $i <= $emptyStars; $i++)
                                        <i class="fa-regular fa-star" style="color:#ccc;"></i>
                                    @endfor

                                    <span class="text-muted">({{ $avg }})</span>
                                </div>


                            </div>
                            <div class="featured-title">
                                <p><a href="{{ route('organizer.profile', $organizer->id) }}">View Profile <i class="ti ti-angle-right"></i></a></p>
                            </div>
                            <form method="POST" action="{{ route('conversation.start') }}">
                                @csrf
                                <input type="hidden" name="receiver_id" value="{{ $organizer->id }}">
                                <input type="hidden" name="event_id" value="{{ $event->event_id ?? '' }}">
                                <button type="submit" class="btn btn-primary">Message</button>
                            </form>

                            {{-- <span class="category">
                                {{ $organizer->id_role == 1 ? 'Event Planner' : 'Organizer' }}
                            </span> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
    </div>
</section>