<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entry extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('facebook');
		$this->load->library('twitter_api');
		$this->load->library('facebook_api');
	}

	function index()
	{
		// OpenGraph Metadata BEGIN
		$opengraph = 	array(
							'type'				=> 'website',
							'title'				=> 'SAM Song Info',
							'url'				=> site_url().'/entry',
							'image'				=> $this->config->item('base_url').'/images/sam_64.png',
							'description'		=> 'Song Info Poster connects your SAM to popular social networks Facebook, Twitter and soon MySpace.
													The basic functionality included in both networks is sending messages to either or both platforms,
													mentioning Artist and Title that just played on your station.',
						);
		$this->load->vars('opengraph', $opengraph);
		//OpenGraph Metadata END

		// Check for login and hand over base_url
		$data = array(
					'facebook_loggedin' => $this->facebook_api->logged_in(),
					'twitter_loggedin'	=> $this->twitter_api->logged_in(),
					'base' 				=> $this->config->item('base_url'),
				);

		// Ready => Display View
		$this->load->view('entry_view', $data);
		$this->load->view('footer');
	}

	function logout()
	{
		if ($this->twitter_api->logged_in())
			$this->twitter_api->logout();

		if ($this->facebook_api->logged_in())
			$this->facebook_api->logout();

		redirect(site_url());
	}
}
/* End of file songinfo.php */
/* Location: ./application/controllers/songinfo.php */