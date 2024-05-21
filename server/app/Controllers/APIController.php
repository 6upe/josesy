<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use CodeIgniter\RESTful\ResourceController;

class APIController extends ResourceController
{
    protected $modelName = 'App\Models\ArticleModel';
    protected $format    = 'json';

    public function showAllArticles()
    {
        $articles = $this->model->orderBy('created_at', 'DESC')->findAll();
        return $this->respond($articles);
    }

    public function showSingleArticle($id = null)
    {
        $article = $this->model->find($id);
        if ($article) {
            return $this->respond($article);
        } else {
            return $this->failNotFound('Article not found');
        }
    }
}
