<main id="main" class="main">

<div class="pagetitle">
  <h1>Articles</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Articles</li>
      <li class="breadcrumb-item active">Edit Article</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-8">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Edit your Article</h5>

            <!-- Edit Article Form -->
            <form action="<?= base_url('/dashboard/articles/update-article/' . $article['id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row mb-3">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" value="<?= esc($article['title']) ?>" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="content" class="col-sm-2 col-form-label">Content</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" style="height: 100px" id="content" name="content" required><?= esc($article['content']) ?></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="images" class="col-sm-2 col-form-label">Images</label>
                    <div class="col-sm-10">
                        <?php foreach ($images as $image): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('uploads/articles/' . esc($image['filename'])) ?>" alt="Image" class="img-thumbnail" style="width: 150px;">
                                <a href="<?= base_url('/dashboard/articles/edit-delete-image/' . $image['id']) ?>" class="btn btn-danger btn-sm ms-2"><i class="bi bi-x"></i></a>
                            </div>
                        <?php endforeach; ?>
                        <input class="form-control" type="file" id="images" name="images[]" accept="image/*" multiple>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Update Article</button>
                    </div>
                </div>
            </form>
            <!-- End Edit Article Form -->

        </div>
      </div>

    </div>
   
  </div>
</section>

</main><!-- End #main -->
