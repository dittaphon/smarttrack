<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ctl_main extends CI_Controller {

   public $data;
   public $id_memp=1;
   public $id_memp_cat=0;

   public function __construct()
   {
      parent::__construct();
      $this->lang->load("thai");
      $file_config = "smarttrack";

      $result = $this->config->load($file_config);
      if (!$result)
      {
         $file_config .= '.php';
         $message = sprintf($this->lang->line('error_file_missing'), $file_config);
         exit($message);
      }
      else
      {
         $this->load->model('mdl_memp','mdl_memp');
         $this->load->model('mdl_mmnu','mdl_mmnu');
      }
   }

   public function index()
   {
    
      $screenID = "DBD001L";
      $this->load->library('classform');
      $this->id_memp_cat =  $this->mdl_memp->get_id_memp_cat($this->id_memp);
      $this->data['header'] = $this->classform->getHeader($this->config->item('base_url'), $this->config->item('title'), $this->config->item('company'), $screenID);
      $this->data['footer'] = $this->classform->getFooter($this->mdl_mmnu->load_menu($this->id_memp_cat));

      $this->load->view('dashboard/' . $screenID ,$this->data);
   }

}
