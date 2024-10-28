@extends("admin.admin_layout")
@section("main-contents")


    <main id="main" class="main">

        <div class="pagetitle">
            <h1 class="text-secondary fw-bold">TEAM MEMBERS >> ({{$totalMembers}})</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Team Members</li>
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
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addNewTeamMemberModal"><i class="bi bi-plus-circle me-1"></i>Add New Member </button>
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
                                    <th>FullName</th>
                                    <th>Title</th>
                                    <th>Project</th>
                                    <th>Profile</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody id="permissions_data_from_database">
                                @foreach($teamMembers as $team)
                                    <tr style="font-size: 13px" id="member-{{$team->id}}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            @if($team->picture)
                                                <img src="{{ asset('team/'.$team->picture) }}" alt="member Picture" style="width: 100px; height: auto;">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{$team->firstname}}   {{$team->lastname}}
                                        </td>
                                        <td>{{$team->position}}</td>
                                        <td>{{$team->project}}</td>
                                        <td>{{\Illuminate\Support\Str::limit($team->profile, 351, '...')}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-4">
                                                    <a class="text-success fs-5 eventID" onclick="editTeamMember({{$team->id}})"
                                                       data-bs-toggle="modal" data-bs-target="#editMemberModal">
                                                        <i class="bi bi-pencil-square me-1"></i>
                                                    </a>
                                                </div>
                                                <div class="col-4">
                                                    <a class="text-danger fs-5" onclick="memberDeletion('{{$team->id}}')">
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
