<?php


function auth()
{
	$ci = get_instance();
	$ci->load->model('M_auth','auth');
	if(!$ci->session->userdata('id')){
		$ci->session->set_flashdata('error','Silahkan login terlebih dahulu.');
		redirect('auth');
	}

}

function isAdmin()
{
	$ci = get_instance();
	$ci->load->model('M_auth','auth');
	if($ci->session->userdata('role_id') == 2)
	{
		redirect('/');
	}
}
