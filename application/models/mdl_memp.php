<?php
   class mdl_memp extends CI_Model
   {
      public function __construct()
      {
         parent::__construct();

         $this->load->database("smarttrack");
      }

      public function get_id_memp_cat($id_memp)
      {
         $id_memp_cat = 0;
         $sql = "
            SELECT id_memp_cat
               FROM memp
               WHERE id_memp = " . $id_memp . "
                  AND memp.`status` = 1;";
         $rs = $this->db->query($sql);
         if ($rs->num_rows() == 1 )
         {
            $row = $rs->row();
            $id_memp_cat = $row->id_memp_cat;
         }
         else
         {
            $id_memp_cat = 0;
         }
         return $id_memp_cat;
      }

   }
?>