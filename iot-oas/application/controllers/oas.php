<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Oas extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	/**
	*	URL TO AUTH:  http://localhost/iot-oas/index.php/oas/auth/provider[facebook/google]
	*	AUTH HEADER: OAuth oauth_consumer_key="tgvHzZQD45hgbbf9GPvsDH9IR", oauth_nonce="xyzxyz", oauth_signature="sDoXD5ny55%2B6pCKpbzn62UngC4E%3D", oauth_signature_method="HMAC-SHA1", oauth_timestamp="1369735200", oauth_token="iX_HF2Yq57iY-gLa2912Qy9ox", oauth_version="1.0"
	*/
	 
	function __construct() {
		parent::__construct();
		$this->load->model('mFetch');
		$this->load->model('consumer');
		$this->load->model('provider');
		$this->load->model('authorizer');
		$this->load->model('verifier');
	}
	 
	public function index() {
		$output = json_encode(NULL);
		$this->output->set_content_type('application/json');
		$this->output->set_output($output);
	}
	
	public function fetch($consumer_key, $access_token) {
		$result = NULL;
		$output = '';
		$method = $_SERVER['REQUEST_METHOD'];
		if($this->_equals($method,'GET')){
			$result = $this->_fetchAll($consumer_key, $access_token);
		}else {
			$result = NULL;
		}
		if(isset($_GET['callback'])){
			$output =  $_GET['callback'] . '(' . json_encode($result) . ')';
		}else{
			$output = json_encode($result);
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output($output);
	}

	public function oauth($provider){
		//Create auth request for provider
		header("Location: " . $this->provider->getRedirectHeader($provider));
		die();
	}

	public function oauth2callback($provider){
		$code = $_GET["code"];
		//Request access token and get user infos
		$data = $this->provider->getUserInfos($provider,$code);
		//Set up an existing or new user
		//TODO check if informations arrived		
		$my_consumer = $this->consumer->getAllInfos($provider, $data["id"]);
		if (is_null($my_consumer)){ 
			$my_consumer = $this->consumer->createNewUserAuth($provider, $data["id"], $data["name"]);		
		}
		if(isset($_GET['callback'])){
			$output =  $_GET['callback'] . '(' . json_encode($my_consumer) . ')';
		}
		else{
			$output = json_encode($my_consumer);
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output($output);
	}

	public function authorizeToken($consumer_key, $token){
		//maybe TODO CHECK AUTH HEADER
		if (is_null($consumer_key)||is_null($token)) $this->_badRequest("Missing parameters.");
		//Get post data
		$method = $_SERVER['REQUEST_METHOD'];
		if(!$this->_equals($method,'POST'))$this->_badRequest("Only post accepted.");
		$post_input = file_get_contents('php://input');		
		$data = json_decode($post_input);
		if (is_null($data)) $this->_badRequest("Bad json");
		$isAuth = $this->authorizer->isAuthorized($consumer_key,$token,$data->device,$data->actions);
		if ($isAuth==true){
			$this->authorizer->authorize($data->token,$data->device, $data->actions);
			$this->output->set_content_type('text/plain');
			$this->output->set_output("OK");
		}else{
			$this->_badRequest("Not authorized to use resource");
		}
	}
	
	// ------- PRIVATE METHODS --------
	
	private function _equals($str1,$str2){
		return (strcmp($str1,$str2) == 0);
	}
	
	private function _fetchAll($ck, $at) {
		return $this->mFetch->fetchData($ck, $at);
	}

	private function _badRequest($response){
		//Bad request response
		$this->output->set_status_header('400');
		exit($response);
	}

	private function _unauthResponse($response){
		//Bad request response
		$this->output->set_status_header('401');
		exit($response);
	}
}

/* End of file oas.php */
/* Location: ./application/controllers/oas.php */
