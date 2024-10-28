@extends("admin.admin_layout")
@section("main-contents")


    <main id="main" class="main">

        <div class="pagetitle">
            <h1 class="text-primary fw-bold">WORKING PARTNERS >> ({{$totalPartners}})</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Partners</li>
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
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addNewPartnerModal"><i class="bi bi-plus-circle me-1"></i>Add New Partner </button>
                                <!-- Center aligned spinner -->
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border text-primary" id="partners-loading" role="status" style="width: 2.5em;height: 2.5em;display: none">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div><!-- End Center aligned spinner -->
                            </h5>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody id="permissions_data_from_database">
                                @foreach($partners as $partner)
                                    <tr style="font-size: 13px" id="partner-{{$partner->id}}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            @if($partner->logo)
                                                <img src="{{ asset('partners_logo/'.$partner->logo) }}" alt="Partner Logo" style="width: 100px; height: auto;">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{$partner->name}}</td>
                                        <td>{{\Illuminate\Support\Str::limit($partner->description, 351, '...')}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-4">
                                                    <a class="text-success fs-5 eventID" onclick="editPartner({{$partner->id}})"
                                                       data-bs-toggle="modal" data-bs-target="#editPartnerModal">
                                                        <i class="bi bi-pencil-square me-1"></i>
                                                    </a>
                                                </div>
                                                <div class="col-4">
                                                    <a class="text-danger fs-5" onclick="partnerDeletion('{{$partner->id}}')">
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
