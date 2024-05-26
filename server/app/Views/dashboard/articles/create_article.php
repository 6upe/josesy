
    <main id="main" class="main">

<div class="pagetitle">
  <h1>Articles</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Articles</li>
      <li class="breadcrumb-item active">Create New Article</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-8">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Compose your Article here</h5>

          <!-- General Form Elements -->
          <form action="/dashboard/articles/create-article" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title" required>
              </div>
            </div>
            
             <div class="row mb-3">
              <label for="inputPassword" class="col-sm-2 col-form-label">Content</label>
              <div class="col-sm-10">
                <textarea class="form-control" style="height: 100px" id="content" name="content" required>Write Article Here...</textarea>
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">Upload Image</label>
              <div class="col-sm-10">
                <input class="form-control" type="file" id="image" name="images[]" multiple accept="image/*">
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Submit Button</label>
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Submit Form</button>
              </div>
            </div>

          </form><!-- End General Form Elements -->

        </div>
      </div>

    </div>

    <!-- Right side columns -->
    <div class="col-lg-4">
        <!-- Articles -->
        <div class="card">
          <div class="card-body"><h5 class="card-title">Recently Posted </h5>
           
            <?php foreach ($articles as $article): ?>
            <div class="article-item">
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

</main><!-- End #main -->
