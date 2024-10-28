@extends("admin.admin_layout")
@section("main-contents")


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>POSTED EVENTS ({{$total_events}})</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">events</li>
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
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addNewPostModal"><i class="bi bi-plus-circle me-1"></i>Add New Post </button>
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
                                    <th>Post Date</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody id="permissions_data_from_database">
                                @foreach($active_events as $event)
                                <tr style="font-size: 13px">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$event->post_date}}</td>
                                    <td>{{\Illuminate\Support\Str::limit($event->post_title,100,'...') }}</td>
                                    <td>{{$event->category}}</td>
                                    <td>{{\Illuminate\Support\Str::limit($event->post_descriptions, 100, '...')}}</td>

                                    <td>
                                        <div class="row">
                                            <div class="col-4">
                                                <a class="text-success fs-5 eventID" onclick="editEvent({{$event->id}})"
                                                   data-bs-toggle="modal" data-bs-target="#editEventModal">
                                                    <i class="bi bi-pencil-square me-1"></i>
                                                </a>
                                            </div>

                                            <div class="col-4">
                                                <span class="badge bg-secondary badge-number">{{$event->total_comments}}</span>
                                                <a class="text-secondary nav-icon eventID" onclick="displayPostComments('{{$event->id}}')"
                                                   data-bs-toggle="modal" data-bs-target="#displayEventComments">
                                                    <i class="bi bi-chat-left-text fs-5"></i>
                                                </a>


                                            </div>

                                            <div class="col-4">
                                                <a class="text-danger fs-5 eventID" onclick="eventDeletion('{{$event->id}}')"
                                                   data-bs-toggle="modal" data-bs-target="#confirmEventDeletion">
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
