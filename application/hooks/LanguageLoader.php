<?php
class LanguageLoader {
    
	function initialize() {
        $ci =& get_instance();
        $site_lang = $ci->session->userdata('site_lang');
        if ($site_lang) {
            $ci->lang->load(array('main_content', 'faq', 'notifications', 'upload'), $ci->session->userdata('site_lang'));
			$ci->config->set_item('language', $site_lang);
		} else {
            $ci->lang->load(array('main_content', 'faq', 'notifications', 'upload')); // Uses dafault lang from config.php
			$ci->config->set_item('language', 'estonian');
		}
    }
}