@extends("admin.admin_layout")
@section("main-contents")


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>System Administrators</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Administrators</li>
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
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                                    <i class="bi bi-plus-circle me-1"></i>Add New Admin </button>
                                <!-- Center aligned spinner -->
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border text-primary" id="admin-loading" role="status" style="width: 2.5em;height: 2.5em;display: none">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div><!-- End Center aligned spinner -->
                            </h5>
                            <!-- Table with stripped rows -->
                            <table class="table">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Admin Type</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody id="admins_data_from_database">




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
