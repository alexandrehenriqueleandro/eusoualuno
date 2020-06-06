<?php
function autoriza() {
	$ci = get_instance();
	$email_usuario = $ci->session->userdata("email_usuario");
	if(!$email_usuario) {
		redirect('/');
	}
	return 1;
}