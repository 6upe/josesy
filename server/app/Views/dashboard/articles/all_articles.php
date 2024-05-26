<main id="main" class="main">

<div class="pagetitle">
    <h1>News & Articles</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">News/Articles</li>
            <li class="breadcrumb-item active">All News & Articles</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row align-items-top">
        <div class="col-lg-12">
        <div class="row">

        <?php if (empty($articles)){ ?>
            <h3 class="text-mute my-5">Opps, Looks like you do not have any News/Article</h3>
            <a href="/dashboard/articles/create-article" class="btn btn-outline-secondary my-5">Post News/Article</a>
            <?php } ?>

            <?php foreach ($articles as $article): ?>
                <div class="col-lg-4">
                    <div class="card">
                        <?php if (!empty($article['images'])): ?>
                            <div class="article-img-container">
                                <img src="<?= base_url('uploads/articles/' . esc($article['images'][0]['filename'])) ?>" class="card-img-top article-img" alt="...">
                            </div>
                        <?php endif; ?>
                        <div class="card-body article-card-body">
                            <div class="d-flex justify-content-between w-100 my-2">
                                <a href="/dashboard/articles/edit-article/<?= $article['id'] ?>"><i class="bi bi-pencil-square  text-secondary text-mute"></i></a>
                                <a href="/dashboard/articles/delete-article/<?= $article['id'] ?>" type="button"><i class="bi bi-trash-fill text-danger text-mute"></i></a>
                            </div>
                            <h5 class="text-primary fw-bold"><?= esc($article['title']) ?></h5>
                           
                            <p class="card-text"><?= truncate_words($article['content'], 10) ?></p>
                            
                            <button type="button" class="btn btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#articleModal<?=$article['id']?>">Read More</button>
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
                                <?php if (!empty($article['images'])): ?>
                                    <div id="carousel<?=$article['id']?>" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php foreach ($article['images'] as $index => $image): ?>
                                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                    <img src="<?= base_url('uploads/articles/' . esc($image['filename'])) ?>" class="d-block w-100" alt="...">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?=$article['id']?>" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carousel<?=$article['id']?>" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <p><?= esc($article['content']) ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
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