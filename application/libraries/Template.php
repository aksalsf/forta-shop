<?php

class Template
{
    public $template_data = array();
    public function set($template_name, $template_value)
    {
        $this->template_data[$template_name] = $template_value;
    }
    public function load($template = '', $view = '', $view_data = array(), $return = false)
    {
        $this->CI = &get_instance();
        $this->set('content', $this->CI->load->view($view, $view_data, true));
        return $this->CI->load->view($template, $this->template_data, $return);
    }
}