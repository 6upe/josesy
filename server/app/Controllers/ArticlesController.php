<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use CodeIgniter\Controller;

class ArticlesController extends Controller
{

    public function __construct()
    {
        
        if (!session()->get('isLoggedIn')) {
            redirect()->to('/auth/login');
        }

    }

    public function allArticles()
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

    return view('templates/header')
        . view('templates/aside')
        . view('dashboard/articles/all_articles', ['articles' => $articles])
        . view('templates/footer');
}


    public function createArticle()
{
    helper(['form', 'url', 'filesystem']);

    if ($this->request->getMethod() == 'POST') {
        $articleModel = new ArticleModel();
        $imageModel = new \App\Models\ArticleImagesModel();

        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
        ];

        // Handle the image upload
        $images = $this->request->getFiles();
        $imageNames = [];

        if ($images) {
            foreach ($images['images'] as $img) {
                if ($img->isValid() && !$img->hasMoved() && in_array($img->getMimeType(), ['image/png', 'image/jpeg', 'image/gif'])) {
                    $newName = $img->getRandomName();
                    $img->move('./uploads/articles', $newName);
                    $imageNames[] = $newName; // Collect image names
                } else {
                    echo 'Error uploading file: ' . $img->getErrorString() . '<br>';
                }
            }
        } else {
            echo 'No files received.<br>';
        }

        // Insert the article data and get the inserted article ID
        if ($articleModel->insert($data)) {
            $articleId = $articleModel->getInsertID();

            // Insert images into the article_images table
            foreach ($imageNames as $imageName) {
                $imageData = [
                    'article_id' => $articleId,
                    'filename' => $imageName,
                ];
                $imageModel->insert($imageData);
            }

            return redirect()->to('/dashboard/articles/all-articles');
        }
    }

    helper(['url', 'text_helper']); // Load the custom helper 
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

    $data = [
            'articles' => $articles,
        ];


    return view('templates/header')
        . view('templates/aside')
        . view('dashboard/articles/create_article', $data)
        . view('templates/footer');
}






public function editArticle($id)
{
    $articleModel = new ArticleModel();
    $articleImagesModel = new \App\Models\ArticleImagesModel();

    // Fetch the article by ID
    $article = $articleModel->find($id);

    if (!$article) {
        return redirect()->back()->with('error', 'Article not found.');
    }

    // Fetch associated images for the article
    $images = $articleImagesModel->where('article_id', $id)->findAll();

    return view('templates/header')
        . view('templates/aside')
        . view('dashboard/articles/edit_article', ['article' => $article, 'images' => $images])
        . view('templates/footer');
}


public function updateArticle($id)
{
    $articleModel = new ArticleModel();
    $articleImagesModel = new \App\Models\ArticleImagesModel();

    // Get the existing article data
    $article = $articleModel->find($id);

    if (!$article) {
        return redirect()->back()->with('error', 'Article not found.');
    }

    $data = [
        'title' => $this->request->getPost('title'),
        'content' => $this->request->getPost('content'),
    ];

    // Handle the image uploads
    $images = $this->request->getFiles();

    if (!empty($images['images'])) {
        foreach ($images['images'] as $img) {
            if ($img->isValid()) {
                // Save the new image
                $newName = $img->getRandomName();
                $img->move('./uploads/articles', $newName);

                // Save the image record in the database
                $articleImagesModel->insert([
                    'article_id' => $id,
                    'filename' => $newName,
                ]);
            }
        }
    }

    $articleModel->update($id, $data);

    return redirect()->to('/dashboard/articles/all-articles')->with('success', 'Article updated successfully.');
}

public function deleteArticle($id)
{
    $articleModel = new ArticleModel();
    $articleImagesModel = new \App\Models\ArticleImagesModel();

    // Get the existing article data
    $article = $articleModel->find($id);

    if (!$article) {
        return redirect()->back()->with('error', 'Article not found.');
    }

    // Delete the images associated with the article from the file system
    $images = $articleImagesModel->where('article_id', $id)->findAll();

    foreach ($images as $image) {
        $imagePath = './uploads/articles/' . $image['filename'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Delete the image records from the database
    $articleImagesModel->where('article_id', $id)->delete();

    // Delete the article record
    $articleModel->delete($id);

    return redirect()->to('/dashboard/articles/all-articles')->with('success', 'Article deleted successfully.');
}

public function deleteImage($imageId)
{
    $articleImagesModel = new \App\Models\ArticleImagesModel();

    // Fetch the image by ID
    $image = $articleImagesModel->find($imageId);

    if (!$image) {
        return redirect()->back()->with('error', 'Image not found.');
    }

    // Delete the image file from the file system
    $filePath = './uploads/articles/' . $image['filename'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Delete the image record from the database
    $articleImagesModel->delete($imageId);

    // Redirect back to the edit article page with the article ID
    return redirect()->to('/dashboard/articles/edit-article/' . $image['article_id'])->with('success', 'Image deleted successfully.');
}



}
