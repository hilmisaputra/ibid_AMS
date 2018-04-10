<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('domain_helper');
	}

	public function index()
	{
        $UserLogon = isset($_COOKIE['UserLogon']) ? unserialize($_COOKIE['UserLogon']) : null;
        if (!is_null($UserLogon)) {
            $passData = array(
                "access_token" => $UserLogon['access_token'],
            );
            $url = $this->config->item('adms_auth')['destroy'];

            $data = json_decode($this->postCURL($url, $passData));

            if ($data->status = 1) {
                // delete_cookie('UserLogon', base_domain(base_url()));
				delete_cookie('UserLogon', '.astra.co.id');
                redirect(base_url(), 'refresh');
            } else {
                // delete_cookie('UserLogon', base_domain(base_url()));
				delete_cookie('UserLogon', '.astra.co.id');
                $this->session->set_flashdata('message_failed','Anda belum melakukan log in!!');
                redirect(base_url(), 'refresh');
            }
        } else {
            $this->session->set_flashdata('message_failed','Harap lakukan login terlebih dahulu!!');
            redirect(base_url(), 'refresh');
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

}

/* End of file Logout.php */
/* Location: ./application/controllers/Logout.php */