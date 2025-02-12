<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Analytics</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboards</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Analytics</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="btn-list">
        <button class="btn btn-primary-light btn-wave me-2">
            <i class="bx bx-crown align-middle"></i> Plan Upgrade
        </button>
        <button class="btn btn-secondary-light btn-wave me-0">
            <i class="ri-upload-cloud-line align-middle"></i> Export Report
        </button>
    </div>
</div>
<!-- Page Header Close -->

<!-- Start::row-1 -->
<div class="row">
    <div class="col-xl-7">
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Audience Report
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary-light btn-wave"><i class="ri-share-forward-line me-1 align-middle d-inline-block"></i>Export</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="audienceReport"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <div class="fs-15 mb-3">Total Users</div>
                            </div>
                            <div>
                                <span class="avatar avatar-md bg-outline-primary">
                                    <i class="ri-map-pin-user-line fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div class="fs-25 d-flex align-items-end justify-content-between lh-1">18.2k<span class="text-success fs-12 ms-auto">+0.743 <i class="ti ti-trending-up ms-1"></i></span></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <div class="fs-15 mb-3">Live Visitors</div>
                            </div>
                            <div>
                                <span class="avatar avatar-md bg-outline-success">
                                    <i class="ri-user-3-line fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div class="fs-25 d-flex align-items-end justify-content-between lh-1">27,142
                            <span class="d-block text-danger fs-12">+0.59<i class="ti ti-trending-down ms-1 d-inline-flex"></i></span></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <div class="card custom-card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <div class="fs-15 mb-3">Bounce Rate</div>
                            </div>
                            <div>
                                <span class="avatar avatar-md bg-outline-warning">
                                    <i class="ri-line-chart-line fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div class="fs-25 d-flex align-items-end justify-content-between lh-1">54.7%
                            <span class="fs-12 text-warning op-7 ms-2">+0.28<i class="ti ti-arrow-big-up-line ms-1 d-inline-flex"></i></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-5">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">Sessions Duration By New Users</div>
                <div class="dropdown">
                    <a href="javascript:void(0);" class="p-2 fs-12 text-muted" data-bs-toggle="dropdown">
                        View All<i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a class="dropdown-item" href="javascript:void(0);">Download</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Import</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Export</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div id="session-users"></div>
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->

<!-- Start::row-2 -->
<div class="row">
    <div class="col-xxl-3 col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Sessions By Device
                </div>
                <div>
                    <button type="button" class="btn btn-primary-light">View All</button>
                </div>
            </div>
            <div class="card-body my-2 py-4">
                <div id="sessions"></div>
            </div>
            <div class="card-footer p-0">
                <div class="row row-cols-12 justify-content-center">
                    <div class="col pe-0 text-center">
                        <div class="p-sm-3 p-2 ">
                            <span class="text-muted fs-11">Mobile</span>
                            <span class="d-block fs-16 fw-medium text-primary">68.3%</span>
                        </div>
                    </div>
                    <div class="col px-0 text-center">
                        <div class="p-sm-3 p-2 ">
                            <span class="text-muted fs-11">Tablet</span>
                            <span class="d-block fs-16 fw-medium text-info">17.68%</span>
                        </div>
                    </div>
                    <div class="col px-0 text-center">
                        <div class="p-sm-3 p-2 ">
                            <span class="text-muted fs-11">Desktop</span>
                            <span class="d-block fs-16 fw-medium text-success">10.5%</span>
                        </div>
                    </div>
                    <div class="col ps-0 text-center">
                        <div class="p-sm-3 p-2">
                            <span class="text-muted fs-11">Others</span>
                            <span class="d-block fs-16 fw-medium text-warning">5.16%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-12">
        <div class="card custom-card overflow-hidden">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Traffic Sources
                </div>
                <div class="dropdown">
                    <a href="javascript:void(0);" class="p-2 fs-12 text-muted" data-bs-toggle="dropdown">
                        View All<i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a class="dropdown-item" href="javascript:void(0);">Download</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Import</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Export</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Browser</th>
                                <th scope="col">Traffic</th>
                                <th scope="col" class="text-end">Sessions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-sm p-2 me-2 bg-outline-primary">
                                            <i class="ri-google-fill fs-18 text-primary"></i>
                                        </span>
                                        <div class="fw-medium">Google</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <span class="badge bg-success-transparent"><i class="ri-arrow-up-s-fill me-1 text-success align-middle"></i>23,379</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-sm p-2 bg-outline-secondary me-2">
                                            <i class="ri-safari-line fs-18 text-secondary"></i>
                                        </span>
                                        <div class="fw-medium">Safari</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 32%" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <span class="badge bg-success-transparent"><i class="ri-arrow-up-s-fill me-1 text-success align-middle"></i>78,973</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-sm p-2 bg-outline-success me-2">
                                            <i class="ri-opera-fill fs-18 text-success"></i>
                                        </span>
                                        <div class="fw-medium">Opera</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 21%" aria-valuenow="21" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <span class="badge bg-danger-transparent"><i class="ri-arrow-down-s-fill me-1 text-danger align-middle"></i>12,457</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-sm p-2 bg-outline-info me-2">
                                            <i class="ri-edge-fill fs-18 text-info"></i>
                                        </span>
                                        <div class="fw-medium">Edge</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <span class="badge bg-success-transparent"><i class="ri-arrow-up-s-fill me-1 text-success align-middle"></i>8,570</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-sm p-2 bg-outline-warning me-2">
                                            <i class="ri-firefox-fill fs-18 text-warning"></i>
                                        </span>
                                        <div class="fw-medium">Firefox</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <span class="badge bg-danger-transparent"><i class="ri-arrow-down-s-fill me-1 text-danger align-middle"></i>6,135</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-sm p-2 bg-outline-danger me-2">
                                            <i class="ri-ubuntu-fill fs-18 text-danger"></i>
                                        </span>
                                        <div class="fw-medium">Ubuntu</div>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </td>
                                <td class="border-bottom-0 text-end">
                                    <span class="badge bg-success-transparent"><i class="ri-arrow-up-s-fill me-1 text-success align-middle"></i>4,789</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-6 col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Top Countries Sessions vs Bounce Rate
                </div>
                <div class="dropdown">
                    <a href="javascript:void(0);" class="p-2 fs-12 text-muted" data-bs-toggle="dropdown">
                        View All<i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a class="dropdown-item" href="javascript:void(0);">Day</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Month</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Year</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div id="country-sessions"></div>
            </div>
        </div>
    </div>
</div>
<!-- End::row-2 -->

<!-- Start::row-3 -->
<div class="row">
    <div class="col-xl-3">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Visitors By Countries
                </div>
                <div class="dropdown">
                    <a href="javascript:void(0);" class="p-2 fs-12 text-muted" data-bs-toggle="dropdown" aria-expanded="false">
                        View All<i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a class="dropdown-item" href="javascript:void(0);">Day</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Month</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Year</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0 analytics-visitors-countries">
                    <li>
                        <div class="d-flex align-items-center">
                            <div class="lh-1">
                                <span class="avatar avatar-xs text-default">
                                    <img src="dashboard/images/flags/us_flag.jpg" alt="">
                                </span>
                            </div>
                            <div class="ms-3 flex-fill lh-1">
                                <span class="fs-14">United States</span>
                            </div>
                            <div>
                                <span class="bg-primary-transparent badge mt-2">32,190</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="d-flex align-items-center">
                            <div class="lh-1">
                                <span class="avatar avatar-xs text-default">
                                    <img src="dashboard/images/flags/germany_flag.jpg" alt="">
                                </span>
                            </div>
                            <div class="ms-3 flex-fill lh-1">
                                <span class="fs-14">Germany</span>
                            </div>
                            <div>
                                <span class="bg-primary-transparent badge mt-2">8,798</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="d-flex align-items-center">
                            <div class="lh-1">
                                <span class="avatar avatar-xs text-default">
                                    <img src="dashboard/images/flags/mexico_flag.jpg" alt="">
                                </span>
                            </div>
                            <div class="ms-3 flex-fill lh-1">
                                <span class="fs-14">Mexico</span>
                            </div>
                            <div>
                                <span class="bg-primary-transparent badge mt-2">16,885</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="d-flex align-items-center">
                            <div class="lh-1">
                                <span class="avatar avatar-xs text-default">
                                    <img src="dashboard/images/flags/uae_flag.jpg" alt="">
                                </span>
                            </div>
                            <div class="ms-3 flex-fill lh-1">
                                <span class="fs-14">Uae</span>
                            </div>
                            <div>
                                <span class="bg-primary-transparent badge mt-2">14,885</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="d-flex align-items-center">
                            <div class="lh-1">
                                <span class="avatar avatar-xs text-default">
                                    <img src="dashboard/images/flags/argentina_flag.jpg" alt="">
                                </span>
                            </div>
                            <div class="ms-3 flex-fill lh-1">
                                <span class="fs-14">Argentina</span>
                            </div>
                            <div>
                                <span class="bg-primary-transparent badge mt-2">17,578</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="d-flex align-items-center">
                            <div class="lh-1">
                                <span class="avatar avatar-xs text-default">
                                    <img src="dashboard/images/flags/russia_flag.jpg" alt="">
                                </span>
                            </div>
                            <div class="ms-3 flex-fill lh-1">
                                <span class="fs-14">Russia</span>
                            </div>
                            <div>
                                <span class="bg-primary-transparent badge mt-2">10,118</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="d-flex align-items-center">
                            <div class="lh-1">
                                <span class="avatar avatar-xs text-default">
                                    <img src="dashboard/images/flags/china_flag.jpg" alt="">
                                </span>
                            </div>
                            <div class="ms-3 flex-fill lh-1">
                                <span class="fs-14">China</span>
                            </div>
                            <div>
                                <span class="bg-primary-transparent badge mt-2">6,578</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="d-flex align-items-center">
                            <div class="lh-1">
                                <span class="avatar avatar-xs text-default">
                                    <img src="dashboard/images/flags/french_flag.jpg" alt="">
                                </span>
                            </div>
                            <div class="ms-3 flex-fill lh-1">
                                <span class="fs-14">France</span>
                            </div>
                            <div>
                                <span class="bg-primary-transparent badge mt-2">2,345</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="d-flex align-items-center">
                            <div class="lh-1">
                                <span class="avatar avatar-xs text-default">
                                    <img src="dashboard/images/flags/canada_flag.jpg" alt="">
                                </span>
                            </div>
                            <div class="ms-3 flex-fill lh-1">
                                <span class="fs-14">Canada</span>
                            </div>
                            <div>
                                <span class="bg-primary-transparent badge mt-2">1,678</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-9">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Visitors By Channel Report
                </div>
                <div class="d-flex flex-wrap">
                    <div class="me-3 my-1">
                        <input class="form-control form-control-sm" type="text" placeholder="Search Here" aria-label=".form-control-sm example">
                    </div>
                    <div class="dropdown my-1">
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm btn-wave waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            Sort By<i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item" href="javascript:void(0);">New</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Popular</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Relevant</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">S.No</th>
                                <th scope="col">Channel</th>
                                <th scope="col">Sessions</th>
                                <th scope="col">Bounce Rate</th>
                                <th scope="col">Avg Session Duration</th>
                                <th scope="col">Goal Completed</th>
                                <th scope="col">Pages Per Session</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    1
                                </th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-sm bg-outline-primary">
                                            <i class="ri-search-2-line fs-15 fw-semibiold text-primary"></i>
                                        </span>
                                        <span class="ms-2">
                                            Organic Search
                                        </span>
                                    </div>
                                </td>
                                <td>782</td>
                                <td>32.09%</td>
                                <td>
                                    0 hrs : 0 mins : 32 secs
                                </td>
                                <td>
                                    <span class="badge bg-primary-transparent">278</span>
                                </td>
                                <td>
                                    2.9
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    2
                                </th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-sm bg-outline-secondary">
                                            <i class="ri-globe-line fs-15 fw-semibiold text-secondary"></i>
                                        </span>
                                        <span class="ms-2">
                                            Direct
                                        </span>
                                    </div>
                                </td>
                                <td>882</td>
                                <td>39.38%</td>
                                <td>
                                    0 hrs : 2 mins : 45 secs
                                </td>
                                <td>
                                    <span class="badge bg-secondary-transparent">782</span>
                                </td>
                                <td>
                                    1.5
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    3
                                </th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-sm bg-outline-success">
                                            <i class="ri-share-forward-line fs-15 fw-semibiold text-success"></i>
                                        </span>
                                        <span class="ms-2">
                                            Referral
                                        </span>
                                    </div>
                                </td>
                                <td>322</td>
                                <td>22.67%</td>
                                <td>
                                    0 hrs : 38 mins : 28 secs
                                </td>
                                <td>
                                    <span class="badge bg-success-transparent">622</span>
                                </td>
                                <td>
                                    3.2
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    4
                                </th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-sm bg-outline-info">
                                            <i class="ri-reactjs-line fs-15 fw-semibiold text-info"></i>
                                        </span>
                                        <span class="ms-2">
                                            Social
                                        </span>
                                    </div>
                                </td>
                                <td>389</td>
                                <td>25.11%</td>
                                <td>
                                    0 hrs : 12 mins : 89 secs
                                </td>
                                <td>
                                    <span class="badge bg-info-transparent">142</span>
                                </td>
                                <td>
                                    1.4
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    5
                                </th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-sm bg-outline-warning">
                                            <i class="ri-mail-line fs-15 fw-semibiold text-warning"></i>
                                        </span>
                                        <span class="ms-2">
                                            Email
                                        </span>
                                    </div>
                                </td>
                                <td>378</td>
                                <td>23.79%</td>
                                <td>
                                    0 hrs : 14 mins : 27 secs
                                </td>
                                <td>
                                    <span class="badge bg-warning-transparent">178</span>
                                </td>
                                <td>
                                    1.6
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    6
                                </th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-sm bg-outline-danger">
                                            <i class="ri-bank-card-line fs-15 fw-semibiold text-danger"></i>
                                        </span>
                                        <span class="ms-2">
                                            Paid Search
                                        </span>
                                    </div>
                                </td>
                                <td>488</td>
                                <td>28.77%</td>
                                <td>
                                    0 hrs : 16 mins : 28 secs
                                </td>
                                <td>
                                    <span class="badge bg-danger-transparent">578</span>
                                </td>
                                <td>
                                    2.5
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer border-top-0">
                <div class="d-sm-flex align-items-center">
                    <div>
                        Showing 6 Entries <i class="bi bi-arrow-right ms-2"></i>
                    </div>
                    <div class="ms-auto">
                        <nav aria-label="Page navigation" class="pagination-style-4">
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="javascript:void(0);">
                                        Prev
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                <li class="page-item">
                                    <a class="page-link text-primary" href="javascript:void(0);">
                                        next
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>