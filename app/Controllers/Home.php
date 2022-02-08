<?php

namespace App\Controllers;


class Home extends BaseController
{
    protected $email;
    public function __construct()
    {
        $this->email = \Config\Services::email();
    }
    public function index()
    {
        return view('index');
    }
    public function download()
    {
        return $this->response->download('doc/CV.pdf');
    }
    public function sendEmail()
    {
        $email = \Config\Services::email();

        $from = $this->request->getVar('InputEmail');
        $name = $this->request->getVar('InputName');
        $subject = $this->request->getVar('InputSubject');
        $message = $this->request->getVar('InputMessage');



        $this->email->setFrom($from, $name);
        $this->email->setSubject($subject);
        $this->email->setTo('Dendyrahmatz38@gmail.com');
        $this->email->setMessage($message);

        if ($this->email->send()) {
            return redirect()->to('/');
        }
    }
}
