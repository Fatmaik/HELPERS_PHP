<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Tabelas_model', 'Tabelas');
        $this->load->helper('url');
    }

	public function index() {
        if(isset($_POST["user_login"])) {
            $user = addslashes($_POST["user_login"]);
            $password = addslashes(md5($_POST["user_password"]));

            $usuarios_info = $this->Tabelas->login();
            echo "<pre>";
                print_r($usuarios_info);
            echo"</pre>";
            foreach($usuarios_info as $info) {
                $userLogin = $info["user"];
                $userPassword = $info["password"];
                $_SESSION["usuario"] = $info["user"];
                $_SESSION["nivel"] = $info["nivel"];
                $_SESSION['id_user'] = $info['id_usuario'];

                if($user == $userLogin && $password == $userPassword) {
                    $_SESSION["logado"] = "true";
                    redirect("/home/inicio");
                }else{
                    $_SESSION["logado"] = "false";
                }
            };
        };

		$this->load->view('login');
    }

    public function inicio() {
        $dados['viewName'] = 'inicio';
        $this->load->view('Template', $dados);
    }

    // public function sair() {
    //     $_SESSION["logado"] = "false";
    //     header("location: /index.php");
    // }
}
