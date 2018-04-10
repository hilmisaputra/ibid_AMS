<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * function for check token
     * @author akmal.m@smooets.com
     * @return boolean
    */
    private function check_token($token)
    {
        $url = $this->config->item('adms_auth')['check'];
        $data = json_decode($this->postCURL($url, ["access_token" => $token]));
        if (isset($data->error)) {
            return false;
        } else {
            return $data->success;
        }
    }
    
    /**
     * function for refresh token
     * @author akmal.m@smooets.com
     * @return boolean
    */
    private function refresh_token($UserLogon)
    {
        $url = $this->config->item('adms_auth')['login'];
        $data = json_decode($this->postCURL($url, $this->refresh_params($UserLogon)));
        return $data;
    }

    /**
     * function for do post with CURL
     * @author akmal.m@smooets.com
     * @return json
    */
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

    
    /**
     * function for parameter refresh token
     * @author akmal.m@smooets.com
     * @return boolean
    */  
	private function refresh_params($UserLogon){
        return [
            "grant_type" => 'refresh_token',
            "client_id" => 'ADMS web',
            "client_secret" => '1234567890',
            "refresh_token" => $UserLogon['refresh_token'],
            "username" => $UserLogon['username'],
            "ipAddress" => '127.0.0.1',
            "createdOn" => '1509330606'
        ];
    }

	public function index()
	{
        $UserLogon = isset($_COOKIE['UserLogon']) ? unserialize($_COOKIE['UserLogon']) : null;
        if (is_null($UserLogon) || ($this->check_token($UserLogon['access_token']) == false)) {
            if (!is_null($UserLogon) && $this->check_token($UserLogon['access_token']) == false) {
                $refresh_token = $this->refresh_token($UserLogon);
                if(isset($refresh_token->error)){
                    delete_cookie('UserLogon', base_domain(base_url()));
                    redirect($this->config->item('ibid_auth').'/user/login', 'refresh');
                }else {
                    $UserLogon['access_token'] = $refresh_token->access_token;
                    $UserLogon['refresh_token'] = $refresh_token->refresh_token;
                    
                    setcookie('UserLogon', serialize($UserLogon), time() + (3600 * 4), "/", base_domain(base_url()));
                    redirect($this->config->item('ibid_auth'), 'refresh');
                }
            }
            redirect($this->config->item('ibid_auth').'/user/login', 'refresh');
        }
		$this->load->helper('custom');
		$this->load->helper('url');
        $data['menu'] = load_menu()['menu'];
        $data['assets_url'] = load_header()['assets_url'];
        $data['title'] = 'Dashboard';
        $data['content_sidebar'] = 'partials/theadmin/sidebar';
        $data['content_topbar'] = 'partials/theadmin/topbar';
        $data['content_footer'] = 'partials/theadmin/footer';
        $data['content'] = 'content';
        $data['content_script'] = 'script';
        $data['content_modal'] = 'modal';
        $this->load->view('/templates/theadmin', $data);
	}
}
