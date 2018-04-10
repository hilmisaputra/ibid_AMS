<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
		parent::__construct();
	}

	public function index()
	{
		
	}

	public function menu() 
	{
		$data['menu']  = [
			'Stock' => [
					'icon' => 'fa-car',
					'link' => 'http://stock.ibid-ams.dev/',
					'submenu' => [],
				],
			'Schedule' => [
					'icon' => 'fa-calendar',
					'link' => 'http://schedule.ibid-ams.dev/',
					'submenu' => [],
				],
			'LOT' => [
					'icon' => 'fa fa-cubes',
					'link' => 'http://lot.ibid-ams.dev/',
					'submenu' => [],
				],
			'Auto Bidding' => [
					'icon' => 'fa fa-spinner',
					'link' => 'http://autobid.ibid-ams.dev/',
					'submenu' => [],
				],
			'KPL' => [
					'icon' => 'fa fa-key',
					'link' => 'http://kpl.ibid-ams.dev/',
					'submenu' => [],
				],
			];

        echo json_encode($data);
	}

}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */