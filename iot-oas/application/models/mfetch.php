<?php

class mFetch extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function fetchData($consumer_key, $access_token) {
		$query = $this->db->query("
			SELECT c.consumer_key, c.consumer_secret, c.name, t.token, t.token_secret, t.type, t.expiration_time, r.resource_uuid, ra.actions,
				r.resource_producer, r.resource_model, r.resource_name, r.resource_type
			FROM consumer AS c
			INNER JOIN token AS t
			INNER JOIN resource AS r
			INNER JOIN resource_access AS ra ON c.c_id = t.c_id
			AND t.t_id = ra.token_id AND ra.resource_id = r.r_id 
			WHERE c.consumer_key = '".$consumer_key."' AND t.token = '".$access_token."'");
		
		if ($query->num_rows() > 0) {
			$r = $query->row();
			$data['consumer']['key'] = $r->consumer_key;
			$data['consumer']['secret'] = $r->consumer_secret;
			$data['consumer']['name'] = $r->name;
			$data['token']['token'] = $r->token;
			$data['token']['secret'] = $r->token_secret;
			$data['token']['type'] = $r->type;
			$data['token']['expires'] = $r->expiration_time;
			$data['resources'] = array();
			for ($ii = 0; $ii < $query->num_rows(); $ii++) {
				$it = $query->row($ii);
				$data['resources'][$ii]['uuid'] = $it->resource_uuid;
				$data['resources'][$ii]['producer'] = $it->resource_producer;
				$data['resources'][$ii]['model'] = $it->resource_model;
				$data['resources'][$ii]['name'] = $it->resource_name;
				$data['resources'][$ii]['type'] = $it->resource_type;
				$data['resources'][$ii]['actions'] = $it->actions;
			}
			
			return $data;
		}else{
			//No resources found, change query
			$query = $this->db->query("
			SELECT c.consumer_key, c.consumer_secret, c.name, t.token, t.token_secret, t.type, t.expiration_time
			FROM consumer AS c
			INNER JOIN token AS t ON c.c_id = t.c_id 
			WHERE c.consumer_key = '".$consumer_key."' AND t.token = '".$access_token."'");
			if ($query->num_rows() > 0) {
				$r = $query->row();
				$data['consumer']['key'] = $r->consumer_key;
				$data['consumer']['secret'] = $r->consumer_secret;
				$data['consumer']['name'] = $r->name;
				$data['token']['token'] = $r->token;
				$data['token']['secret'] = $r->token_secret;
				$data['token']['type'] = $r->type;
				$data['token']['expires'] = $r->expiration_time;
				$data['resources'] = array();
				return $data;
			}
		}
		
		return NULL;
	}
}
?>
