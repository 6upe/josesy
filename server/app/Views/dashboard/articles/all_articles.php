<main id="main" class="main">

<div class="pagetitle">
    <h1>All Articles</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Articles</li>
            <li class="breadcrumb-item active">All Articles</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row align-items-top">
        <div class="col-lg-12">
            <div class="row">
                <?php foreach ($articles as $article): ?>
                    <div class="col-lg-4">
                        <div class="card">
                            <?php if (!empty($article['image'])): ?>
                                <div class="article-img-container">
                                    <img src="<?= base_url('uploads/articles/' . esc($article['image'])) ?>" class="card-img-top article-img" alt="...">
                                </div>
                            <?php endif; ?>
                            <div class="card-body article-card-body">
                                <h5 class="card-title"><?= esc($article['title']) ?></h5>
                                <p class="card-text"><?= truncate_words($article['content'], 10) ?></p>
                               
                                <button type="button" class="btn btn-outline-secondary w-100 " data-bs-toggle="modal" data-bs-target="#articleModal<?=$article['id']?>">Read More</button>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="articleModal<?=$article['id']?>" tabindex="-1">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title"><?= esc($article['title']) ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            
                            <img style="width: 100%;" src="<?= base_url('uploads/articles/' . esc($article['image'])) ?>" class="img-fluid  mb-3" alt="...">

                                    <p><?= esc($article['content']) ?></p>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <a href="/dashboard/articles/delete-article/<?= $article['id'] ?>" type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="bi bi-trash-fill"></i> Delete</a>
                                <a href="/dashboard/articles/edit-article/<?= $article['id'] ?>" class="btn btn-outline-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
                            </div>
                        </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

</main><!-- End #main -->