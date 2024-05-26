<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleImagesModel extends Model
{
    protected $table = 'article_images';
    protected $primaryKey = 'id';
    protected $allowedFields = ['article_id', 'filename', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
