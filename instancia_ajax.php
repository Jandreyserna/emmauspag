<?php

//Insertar Javascript js y enviar ruta admin-ajax.php
add_action('wp_enqueue_scripts', 'dcms_insertar_js');

function dcms_insertar_js(){

	if (!is_home()) return;

	wp_register_script('dcms_miscript',get_stylesheet_directory_uri(). '/js/script.js', array('jquery'), '1', true );
	wp_enqueue_script('dcms_miscript');

	wp_localize_script('dcms_miscript','dcms_vars',['ajaxurl'=>admin_url('admin-ajax.php')]);
}

//Devolver datos a archivo js
add_action('wp_ajax_nopriv_dcms_ajax_readmore','dcms_enviar_contenido');
add_action('wp_ajax_dcms_ajax_readmore','dcms_enviar_contenido');

function dcms_enviar_contenido()
{

	$id_post = absint($_POST['id_post']);
	$content = apply_filters('the_content', get_post_field('post_content', $id_post));

	//sleep(2);

	echo $content;

	wp_die();
}
