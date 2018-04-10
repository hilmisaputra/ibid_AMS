<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
	// session_start();
	
	public function __construct()
	{
		parent::__construct();
        $this->load->helper('custom');
        $this->load->helper('domain_helper');
        $UserLogon = isset($_COOKIE['UserLogon']) ? unserialize($_COOKIE['UserLogon']) : null;
        if (!is_null($UserLogon)) {
            redirect($this->config->item('ibid_stock'),'refresh');
        } 
	}

	public function index()
	{
        $data['title'] = 'Masuk';
        $data['content'] = 'login';
        $data['content_script'] = 'script-login';
        $this->load->view('/templates/theadmin', $data);
	}

	public function login()
	{
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $username = isset($_POST['username']) ? $_POST['username'] : null;
            $this->error_login(['username'=>$username]);
        } else {
            $passData = array(
                "grant_type" => 'password',
                "client_id" => 'ADMS web',
                "client_secret" => '1234567890',
                "username" => $_POST['username'],
                "password" => $_POST['password'],
                "action" => '',
                "redirect_url" => '',
                "ipAddress" => '127.0.0.1',
                "createdOn" => '1509330606'
            );
            
            $url = $this->config->item('adms_auth')['login'];
            
            $data = json_decode($this->postCURL($url, $passData));
            if (isset($data->error)) {
                $this->error_login($data);
            } else {
                $userlogon = [
                    "access_token" => $data->access_token,
                    "refresh_token" => $data->refresh_token,
                    "username" => $data->username,
                    "GroupId" => $data->GroupId,
                    "GroupName" => $data->GroupName,
                    "CompanyId" => $data->CompanyId,
                    "Role" => $data->Role
                ];
                // setcookie('UserLogon', serialize($userlogon), time() + (3600 * 4), "/", base_domain(base_url()));
                setcookie('UserLogon', serialize($userlogon), time() + (3600 * 4), "/", '.astra.co.id');
                redirect($this->config->item('ibid_stock'),'refresh');
            }

        }
	}

	public function forget_password(){
        $data['title'] = 'Reset Password';
        $data['content'] = 'forget_password';
        $data['content_script'] = 'script-login';
        $this->load->view('/templates/theadmin', $data);
    }

    public function forget_passwordPOST(){
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Reset Password';
            $data['content'] = 'forget_password';
            $data['content_script'] = 'script-login';
            $data['old_username'] = $this->input->post('username');
            return $this->load->view('/templates/theadmin', $data);
        } else {
            $passData = array(
                "grant_type" => 'forgot',
                "username" => $_POST['username'],
                "password" => $_POST['password'],
            );
            
            $url = 'http://ibidadmsdevserviceaccount.azurewebsites.net/index.php/auth/oauth2';

            $data = json_decode($this->postCURL($url, $passData));

            // var_dump($data);
            // die();

            if ($data->success == true) {
                $this->session->set_flashdata('message_success','Berhasil mengubah password');
                redirect('user','refresh');
            } else {
                $this->session->set_flashdata('message_failed','Gagal mengubah password!!');
                redirect('user','refresh');
            }

        }
    }

    private function postCURL($_url, $_param){
        $postData = '';
            //create name value pairs seperated by &
            foreach($_param as $k => $v) 
            { 
               $postData .= $k . '='.$v.'&'; 
            }
            rtrim($postData, '&');
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, false); 
            curl_setopt($ch, CURLOPT_POST, count($postData));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
            
            $output=curl_exec($ch);
            curl_close($ch);
            return $output;
    }

    function error_login($error)
    {
        $data['title'] = 'Masuk';
        $data['content'] = 'login';
        $data['content_script'] = 'script-login';
        $data['error_login'] = isset($error->error) ? 'Nama user atau kata sandi salah' : null;
        // var_dump($error);die();
        // if (isset($error->username)) {
        //     $data['old_username'] = isset($error->username) ? $error->username : null;
        // } elseif (isset($error['username'])) {
        //     $data['old_username'] = isset($error['username']) ? $error['username'] : null;
        // }
        return $this->load->view('/templates/theadmin', $data);
    }
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */