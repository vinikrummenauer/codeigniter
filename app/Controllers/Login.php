<?php namespace App\Controllers;

use App\Models\UsuarioModel;

class login extends BaseController{
    public function index(){
        return view('user/login');
    }

    public function signIn(){
        $email = $this->request->getPost('inputEmail');
        $password = $this->request->getPost('inputPassword');

        $usuarioModel = new UsuarioModel();
        $dadosUsuario = $usuarioModel->getByEmail($email);

        if($dadosUsuario['password'] == md5($password) && $email == $dadosUsuario['email']){
            return redirect()->to(base_url() . '/home');
        }
        else{
            return redirect()->to(base_url());
        }
        
    }

    public function signOut(){
        session()->destroy;
        return redirect()->to(base_url());
    }
}