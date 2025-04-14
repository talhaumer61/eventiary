<section class="ttm-row portfolio-section-3 clearfix ttm-bgcolor-dark-grey pt-1">
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12 ttm-pf-single-content-wrapper ttm-pf-view-top-image">
                <div class="ttm-pf-single-content-wrapper-innerbox">
                    <div class="row">
                        <div class="col-md-7 col-lg-7 ttm-pf-single-content-area">
                            <div class="ttm-portfolio-description">
                                <h4>{{ $event->event_name }}</h4>
                                <p>{{ $eventType->type_name }}</p>
                                <p>{{ $event->event_detail }}</p>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 ttm-pf-single-details-area">
                            <div class="ttm-pf-single-detail-box">
                                <div class="ttm-pf-detailbox">
                                    <div class="ttm-pf-detailbox-inner">
                                        <ul class="ttm-pf-detailbox-list">
                                            <li class="ttm-pf-details-date">
                                                <span class="ttm-pf-left-details">Event by:</span>
                                                <span class="ttm-pf-right-details">{{ $addedBy -> name }}</span>
                                            </li>
                                            <li class="ttm-pf-details-date">
                                                <span class="ttm-pf-left-details">Category:</span>
                                                <span class="ttm-pf-right-details">{{ $eventType -> type_name }}</span>
                                            </li>
                                            <li class="ttm-pf-details-date">
                                                <span class="ttm-pf-left-details">Date</span>
                                                <span class="ttm-pf-right-details">{{ \Carbon\Carbon::parse($event->event_date)->format('d M, Y') }}
                                                </span>
                                            </li>
                                            <li class="ttm-pf-details-date">
                                                <span class="ttm-pf-left-details">Location:</span>
                                                <span class="ttm-pf-right-details">{{ $event -> event_location }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-12">
                            <div class="social-icons square social-hover mt-30">
                                <div class="ttm-social-share-title">Share</div>
                                <ul class="list-inline m-0 social-inline">
                                    <li class="social-facebook"><a
                                            href="https://www.facebook.com/preyantechnosys19"
                                            class="shape-round"><i class="fa fa-facebook"
                                                aria-hidden="true"></i></a></li>
                                    <li class="social-twitter"><a href="https://twitter.com/PreyanTechnosys"
                                            class="shape-round"><i class="fa fa-twitter"
                                                aria-hidden="true"></i></a></li>
                                    <li class="social-linkedin"><a
                                            href="https://www.linkedin.com/in/preyan-technosys-pvt-ltd/"
                                            class="shape-round"><i class="fa fa-linkedin"
                                                aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="clearfix mb-0">
                                <a class="ttm-btn ttm-btn-size-sm ttm-btn-style-fill ttm-icon-btn-right ttm-btn-color-skincolor  shape-round float-right"
                                    href="#"><i
                                        class="ti ti-angle-right"></i>Make Your Reservation</a>
                            </div>
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col-md-12">
                            {{-- <div class="ttm-featured-wrapper ttm-portfolio-featured-wrapper">
                                <iframe width="847" height="476"
                                    src="https://www.youtube.com/embed/HkyVTxH2fIM?feature=oembed"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen=""></iframe>
                            </div> --}}
                            <div class="ttm-featured-wrapper ttm-portfolio-featured-wrapper" style="width: 100%; height: 476px; overflow: hidden;">
                                <img src="{{ asset(''.$event->event_image.'') }}" 
                                     alt="{{ $event->event_name }}" 
                                     style="width: 100%; height: 100%; object-fit: contain;">
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>