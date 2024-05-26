<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">
          <div class="col-xxl-4 col-xl-12">
            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Latest News & Articles</h5>

                <div class="d-flex align-items-center">
                  <div
                    class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                  >
                    <i class="bi bi-journal-text"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $totalArticles ?></h6>
                  </div>
                </div>

                <h5 class="card-title">Online Applications & Bookings</h5>

                <div class="d-flex align-items-center">
                  <div
                    class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                  >
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <span class="text-danger small pt-1 fw-bold">12</span>
                    <span class="text-muted small pt-2 ps-1"
                      >Online Applications</span
                    >
                    <span class="text-danger small pt-1 fw-bold">5</span>
                    <span class="text-muted small pt-2 ps-1">Bookings</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Customers Card -->
        </div>
      </div>
      <!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-4">
        <!-- Articles -->
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between w-100 my-2">
               <h5 class="card-title">Latest Posts </h5>
               <small class="text-secondary">
                <i class="bi bi-patch-plus  text-secondary text-mute"></i>
                <a href="/dashboard/articles/create-article">Post Article/News</a>
               </small>
            </div>
           
            <?php foreach ($articles as $article): ?>
            <div class="article-item mb-3">
            <div class="article-img-container">
                                <img src="<?= base_url('uploads/articles/' . esc($article['images'][0]['filename'])) ?>" class="card-img-top article-img" alt="...">
                            </div>
            <div class="d-flex justify-content-between w-100 my-2">
                                <a href="/dashboard/articles/edit-article/<?= $article['id'] ?>"><i class="bi bi-pencil-square  text-secondary text-mute"></i></a>
                                <a href="/dashboard/articles/delete-article/<?= $article['id'] ?>" type="button"><i class="bi bi-trash-fill text-danger text-mute"></i></a>
                            </div>
              <h6><?= esc($article['title']) ?></h6>
              <p><?= truncate_words($article['content'], 15) ?></p>
              <a href="/dashboard/articles/all-articles" class="btn btn-outline-secondary w-100" >Read More</a>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <!-- End Articles -->
        
      </div>
      <!-- End Right side columns -->
    </div>
  </section>
</main>
<!-- End #main -->
