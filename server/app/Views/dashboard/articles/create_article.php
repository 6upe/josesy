
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
                <input class="form-control" type="file" id="image" name="image" accept="image/*">
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

   
  </div>
</section>

</main><!-- End #main -->
