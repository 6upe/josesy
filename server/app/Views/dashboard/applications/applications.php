<main id="main" class="main">

<div class="pagetitle">
    <h1>Data Tables</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active">Data</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">applications</h5>
                    <?php if (session()->has('status')): ?>
                        <div class="alert alert-danger">
                            <?= session('status') ?>
                        </div>
                    <?php endif; ?>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>
                                    <b>Name</b>
                                </th>
                                <th>Email</th>
                                <th>Service</th>
                                <th>Message</th>
                                <th>Created At</th>
                                <th></th> <!-- New column for controls -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($applications) && is_array($applications)): ?>
                                <?php foreach ($applications as $application): ?>
                                    <tr>
                                        <td><?= esc($application['name']) ?></td>
                                        <td><?= esc($application['email']) ?></td>
                                        <td><?= esc($application['service']) ?></td>
                                        <td><?= esc($application['message']) ?></td>
                                        <td><?= esc($application['created_at']) ?></td>
                                        <td>
                                            <!-- Link to delete the entry -->
                                            <a class="w-100 text-center" href="<?= base_url('dashboard/applications/delete-application/' . $application['id']) ?>" onclick="return confirm('Are you sure you want to delete this entry?') ">
                                                <!-- Trash icon for deleting -->
                                                <i class="bi bi-trash text-danger"></i>
                                            </a>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">No applications found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
</section>

</main><!-- End #main -->