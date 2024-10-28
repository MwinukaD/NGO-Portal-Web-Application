@extends("admin.admin_layout")
@section("main-contents")


    <main id="main" class="main">

        <div class="pagetitle">
            <h1 class="text-success">POSTED CAMPAIGNS >> ({{$total_campaigns}})</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Campaigns</li>
                    <li class="breadcrumb-item active">Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addNewCampaignModal"><i class="bi bi-plus-circle me-1"></i>Add New Campaign </button>
                                <!-- Center aligned spinner -->
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border text-primary" id="permission-loading" role="status" style="width: 2.5em;height: 2.5em;display: none">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div><!-- End Center aligned spinner -->
                            </h5>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Picture</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody id="permissions_data_from_database">
                                @foreach($active_campaigns as $campaign)
                                    <tr style="font-size: 13px" id="campaign-{{$campaign->id}}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>

                                            @if($campaign->picture)
                                                <img src="{{ asset('uploads/'.$campaign->picture) }}" alt="Campaign Picture" style="width: 150px; height: auto;">
                                            @else
                                                No Image
                                            @endif


                                        </td>
                                        <td>Starting from
                                            <span class="text-primary fw-bold">{{$campaign->startingDate}}</span>
                                            </span> to <span class="text-primary fw-bold">{{$campaign->endingDate}}
                                        </td>
                                        <td>{{\Illuminate\Support\Str::limit($campaign->title,200,'...') }}</td>
                                        <td>{{\Illuminate\Support\Str::limit($campaign->descriptions, 351, '...')}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-4">
                                                    <a class="text-success fs-5 eventID" onclick="editCampaign({{$campaign->id}})"
                                                       data-bs-toggle="modal" data-bs-target="#editCampaignModal">
                                                        <i class="bi bi-pencil-square me-1"></i>
                                                    </a>
                                                </div>

                                                <div class="col-4">
                                                    <a class="text-danger fs-5" onclick="campaignDeletion('{{$campaign->id}}')">
                                                        <i class="bi bi-trash-fill me-1"></i>
                                                    </a>
                                                </div>

                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
