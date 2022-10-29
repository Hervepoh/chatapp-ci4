<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{
    public function login()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            // let's do the validation here 
            // Use a custom validation provider validateUser
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
            ];
            $errors = [
                'password' => [
                    'validateUser' => "Email or Password don't match",
                ]
            ];
            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            }else{
                // Create the user session
                $model = new UserModel();
                $user  = $model->where('email',$this->request->getVar('email'))->first();
                
                $this->setUserSession($user);
                
                return redirect()->to('dashboard'); 
            }
        }

        echo view("templates/header",$data);
        echo view("login");
        echo view("templates/footer");
    }
 
    public function register()
    {
        $data = [];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            // let's do the validation here
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]|max_length[255]',
                'password_confirm' => 'matches[password]',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            }else{
                // Store the user in our database
                $model = new UserModel();
                $newdata = [
                    'firstname' => $this->request->getVar('firstname'),
                    'lastname'=> $this->request->getVar('lastname'),
                    'email'=> $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                ];
                $model->save($newdata);

                $session = session();
                $session->setFlashdata('success', 'Successfull Registration');
                return redirect()->to('/login');
            }
        }
        echo view("templates/header",$data);
        echo view("register");
        echo view("templates/footer");
    }

    public function profile()
    {
        $data = [];
        helper(['form']);
        $model = new UserModel();
        if ($this->request->getMethod() == 'post') {
            // let's do the validation here
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
            ];

            if ($this->request->getPost('password') != ''){
                $rules['password'] = 'required|min_length[8]|max_length[255]';
                $rules['password_confirm'] ='matches[password]';
            }
           
           
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            }else{
                // Update the user in our database
                $newdata = [
                    'firstname' => $this->request->getPost('firstname'),
                    'lastname'  => $this->request->getPost('lastname'),
                ];
                if ($this->request->getPost('password') != ''){
                    $newdata['password'] = $this->request->getPost('password');
                }
                $model->update(session()->get('id'),$newdata);

                session()->setFlashdata('success', 'Successfull updated');
                return redirect()->to('/profile');
            }
        }

        $data['user'] =  $model->find(session()->get('id'));
        echo view("templates/header",$data);
        echo view("profile");
        echo view("templates/footer");
    }

    public function logout(){
     
        session()->destroy();
        return redirect()->to('/');

    }

    private function setUserSession($user){
        $data = [
            "id"         => $user['id'],
            "firstname"  => $user['firstname'],
            "lastname"   => $user['lastname'],
            "email"      => $user['email'],
            "isLoggedIn" => true
        ];
        
        session()->set($data);
        
    }
}
