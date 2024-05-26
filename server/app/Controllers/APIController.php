<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\ArticleImagesModel;
use App\Models\TrainingApplicationModel;
use App\Models\BookingModel;
use CodeIgniter\RESTful\ResourceController;

class APIController extends ResourceController
{
    protected $articleModel;
    protected $articleImagesModel;
    protected $format = 'json';

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
        $this->articleImagesModel = new ArticleImagesModel();

        
    }

    public function showAllArticles()
    {
        $articles = $this->articleModel->orderBy('created_at', 'DESC')->findAll();
        foreach ($articles as &$article) {
            $article['images'] = $this->articleImagesModel->where('article_id', $article['id'])->findAll();
        }
        return $this->respond($articles);
    }

    public function showSingleArticle($id = null)
    {
        $article = $this->articleModel->find($id);
        if ($article) {
            $article['images'] = $this->articleImagesModel->where('article_id', $article['id'])->findAll();
            return $this->respond($article);
        } else {
            return $this->failNotFound('Article not found');
        }
    }

    public function sendMessage()
    {
        $request = $this->request->getJSON();

        $name = $request->name;
        $userEmail = $request->email;
        $subject = $request->subject;
        $message = $request->message;

        $email = \Config\Services::email(); 
        $email->setTo('info@josesyltd.com');
        $email->setFrom($userEmail, $name);
        $email->setMailType('html'); // Set email type to HTML
        $email->setSubject('Message from Website: '. $subject);
        
        // Load the view and pass data to it
        $emailContent = view('email_templates/email_message', [
            'name' => $name,
            'email' => $userEmail,
            'subject' => $subject,
            'message' => $message
        ]);

        $email->setMessage($emailContent);

        if ($email->send()) {
            return $this->response->setJSON(['success' => true, 'message' => 'Email sent successfully', 'payload' =>  $request ]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to send email', 'payload' =>  $request ]);
        }
    }

    public function sendEmail($to, $subject, $from, $data)
    {
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom($from);
        $email->setSubject($subject);
        $email->setMailType('html'); // Set email type to HTML
        
        // Load the view and pass data to it
        $emailContent = view('email_templates/app_email', $data);

        $email->setMessage($emailContent);

        return $email->send();
    }

    public function submitApplication() {
    helper(['form', 'url']);

    $model = new TrainingApplicationModel();

    $request = $this->request->getJSON();

    $name = $request->name;
    $email = $request->email;
    $service = $request->service;
    $message = $request->message;

    $data = [
        'name' => $name,
        'email' => $email,
        'service' => $service,
        'message' => $message,
        'created_at' => date('Y-m-d H:i:s')
    ];

    
    if ($model->insert($data)) {
        $this->sendEmail('info@josesyltd.com', 'New Training Application',  $data['email'], $data);
        $this->sendEmail($data['email'], 'Training Application Successful', 'info@josesyltd.com', $data);
        return $this->response->setJSON(['success' => true]);
    } else {
        return $this->response->setJSON(['success' => false]);
    }
}



    public function sendBooking($to, $subject, $from, $data)
    {
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom($from);
        $email->setSubject($subject);
        $email->setMailType('html'); // Set email type to HTML
        
        // Load the view and pass data to it
        $emailContent = view('email_templates/book_email', $data);

        $email->setMessage($emailContent);

        return $email->send();
    }

    public function submitBooking()
    {
        helper(['form', 'url']);

        $model = new BookingModel();


        $request = $this->request->getJSON();

        $name = $request->name;
        $email = $request->email;
        $service = $request->service;
        $preferred_date = $request->preferred_date;
        $message = $request->message;

        $data = [
            'name' => $name,
            'email' => $email,
            'preferred_date' => $preferred_date,
            'service' => $service,
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($model->insert($data)) {
            $this->sendBooking('info@josesyltd.com', 'New Booking Request', $data['email'], $data);
            $this->sendBooking($data['email'], 'Booking Request Successful',  'info@josesyltd.com', $data);
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function allApplications()
    {
        $model = new TrainingApplicationModel();
        $applications = $model->findAll();

        $data = [
            'applications' => $applications,
        ];


    return view('templates/header')
        . view('templates/aside')
        . view('dashboard/applications/applications', $data)
        . view('templates/footer');
        
    }

    // Method to delete a specific training application by ID
    public function deleteApplication($id)
    {
        $model = new TrainingApplicationModel();
        
        if ($model->delete($id)) {
            return redirect()->to('/dashboard/applications/all-applications')->with('status', 'Application deleted successfully');
        } else {
            return redirect()->to('/dashboard/applications/all-applications')->with('status', 'Failed to delete application');
        }
    }

    // Method to get all bookings
    public function allBookings()
    {
        $model = new BookingModel();
        $bookings = $model->findAll();

        $data = [
            'bookings' => $bookings,
        ];


    return view('templates/header')
        . view('templates/aside')
        . view('dashboard/bookings/bookings', $data)
        . view('templates/footer');
        
    }

    // Method to delete a specific booking by ID
    public function deleteBooking($id)
    {
        $model = new BookingModel();
        
        if ($model->delete($id)) {
            return redirect()->to('/dashboard/bookings/all-bookings')->with('status', 'Booking deleted successfully');
        } else {
            return redirect()->to('/dashboard/bookings/all-bookings')->with('status', 'Failed to delete booking');
        }
    }



}
