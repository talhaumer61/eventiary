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
                                <h5><a href="#">{{ $organizer->name }}</a></h5>
                            </div>
                            <div class="featured-title">
                                <p><a href="#">View Profile <i class="ti ti-angle-right"></i></a></p>
                            </div>
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