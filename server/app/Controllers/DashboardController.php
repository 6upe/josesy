<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use CodeIgniter\Controller;

class DashboardController extends BaseController
{

    public function __construct()
    {
        
        if (!session()->get('isLoggedIn')) {
            redirect()->to('/auth/login');
        }
    }

    public function index()
    {
        helper(['form', 'url', 'text_helper']); // Load the custom helper 
    $articleModel = new ArticleModel();
    $articleImagesModel = new \App\Models\ArticleImagesModel();

    // Fetch all articles
    $articles = $articleModel->orderBy('created_at', 'DESC')->findAll();

    // Fetch and associate images for each article
    foreach ($articles as &$article) {
        // Fetch images associated with the current article
        $images = $articleImagesModel->where('article_id', $article['id'])->findAll();

        // Assign the fetched images to the current article
        $article['images'] = $images;
    }
    
    $totalArticles = count($articles);

        // Pass data to the view
        $data = [
            'articles' => $articles,
            'totalArticles' => $totalArticles
        ];

        return view('templates/header', $data)
            . view('templates/aside')
            . view('dashboard/index', $data)
            . view('templates/footer');
    }
}
