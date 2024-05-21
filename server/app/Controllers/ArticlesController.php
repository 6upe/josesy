<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use CodeIgniter\Controller;

class ArticlesController extends Controller
{
    public function allArticles()
    {
        helper(['form', 'url', 'text_helper']); // Load the custom helper

        $model = new ArticleModel();
        $data['articles'] = $model->query("SELECT * FROM articles ORDER BY created_at DESC")->getResultArray();


        echo view('templates/header');
        echo view('templates/aside');
        echo view('dashboard/articles/all_articles', $data);
       echo view('templates/footer');
    }

    public function createArticle()
    {
        helper(['form', 'url', 'filesystem']);

        if ($this->request->getMethod() == 'POST') {
            $model = new ArticleModel();

            $data = [
                'title' => $this->request->getPost('title'),
                'content' => $this->request->getPost('content'),
            ];

            // Handle the image upload
            $img = $this->request->getFile('image');
            if ($img) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $img->move('./uploads/articles', $newName);
                    $data['image'] = $newName; // Save the image name to the database
                } else {
                    echo 'Error uploading file: ' . $img->getErrorString() . '<br>';
                }
            } else {
                echo 'No file received.<br>';
            }

            if ($model->insert($data)) {
                return redirect()->to('/dashboard/articles/all-articles');
            }
        }

        return view('templates/header')
            . view('templates/aside')
            . view('dashboard/articles/create_article')
            . view('templates/footer');
    }



    public function editArticle($id)
{
    $model = new ArticleModel();

    $article = $model->find($id);

    if (!$article) {
        return redirect()->back()->with('error', 'Article not found.');
    }

    return 
    view('templates/header')
    .view('templates/aside')
    .view('dashboard/articles/edit_article', ['article' => $article])
    .view('templates/footer');
}

public function updateArticle($id)
{
    $model = new ArticleModel();

        // Get the existing article data
        $article = $model->find($id);

        if (!$article) {
            return redirect()->back()->with('error', 'Article not found.');
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
        ];

        if ($this->request->getFile('image')->isValid()) {
            // Delete the old image
            if (!empty($article['image'])) {
                $oldImagePath = './uploads/articles/' . $article['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Save the new image
            $image = $this->request->getFile('image');
            $newName = $image->getRandomName();
            $image->move('./uploads/articles', $newName);
            $data['image'] = $newName;
        }

        $model->update($id, $data);

        return redirect()->to('/dashboard/articles/all-articles')->with('success', 'Article updated successfully.');
    }


    public function deleteArticle($id)
    {
        $model = new ArticleModel();

        // Get the existing article data
        $article = $model->find($id);

        if (!$article) {
            return redirect()->back()->with('error', 'Article not found.');
        }

        // Delete the image from the file system
        if (!empty($article['image'])) {
            $imagePath = './uploads/articles/' . $article['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete the article record
        $model->delete($id);

        return redirect()->to('/dashboard/articles/all-articles')->with('success', 'Article deleted successfully.');
    
    }

}
