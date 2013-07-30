<?php
   class mdl_mmnu extends CI_Model
   {
      private $id_menuBegin=0;
      public $tree_menu;
      public $db1;

      public function __construct()
      {
         parent::__construct();
         $this->db1 = $this->load->database("smarttrack",TRUE);
      }

      public function get_id_menuBegin()
      {
         return $this->id_menuBegin;
      }

      public function set_id_menuBegin($id_menuBegin)
      {
         $this->id_menuBegin = $id_menuBegin;
      }

      public function prepare_treeMenu($id_menuBegin, $id_memp_cat)
      {        
         $db2 = $this->load->database("smarttrack",TRUE);
         /*
         $sql =  "
             SELECT id_mmnu, name_en, name_th, id_parent, id_order, filelocation
                FROM mmnu
                WHERE id_parent = " . $id_menuBegin . "
                  AND status = 1
                ORDER BY id_order;";
         */
         $sql = "
            SELECT cmmnu_emp_cat.id_mmnu, mmnu.name_th, mmnu.name_en, mmnu.id_order, mmnu.filelocation, cmmnu_emp_cat.`status`
               FROM cmmnu_emp_cat
               LEFT JOIN mmnu
                  ON cmmnu_emp_cat.id_mmnu = mmnu.id_mmnu
               WHERE mmnu.id_parent = " . $id_menuBegin . "
                  AND cmmnu_emp_cat.id_memp_cat = " . $id_memp_cat . "
                  AND cmmnu_emp_cat.`status` = 1
                  AND mmnu.`status` = 1
               ORDER BY cmmnu_emp_cat.id_mmnu;";
         
         $rs = $this->db1->query($sql);

         if ($rs->num_rows() > 0 )
         {
            foreach ($rs->result() as $row)
            {
               $sql =  "
                  SELECT id_mmnu 
                     FROM mmnu 
                     WHERE id_parent = " . $row->id_mmnu . "
                       AND status = 1;";
               $rstemp = $db2->query($sql);
               if ($rstemp->num_rows() > 0 )
               {
                  $this->tree_menu .= "['" . $row->name_th . "','http://localhost/smarttrack/index.php/" . $row->filelocation . "','" . $row->id_mmnu . "',\n";
                  $this->prepare_treeMenu($row->id_mmnu, $id_memp_cat);
                  $this->tree_menu .=  "],\n";
               }
               else
               {
                  $this->tree_menu .= "['" . $row->name_th . "','http://localhost/smarttrack/index.php/" . $row->filelocation . "','" . $row->id_mmnu . "'],\n";
                  $this->prepare_treeMenu($row->id_mmnu, $id_memp_cat);
               }
            }
         }
         else
         {
         }

      }

      public function load_menu($id_memp_cat)
      {
         $this->tree_menu = "
            <script language='JavaScript'>
               var TREE_ITEMS = [\n";

         if ( $this->id_menuBegin > 0)
         {
            $sql = "
               SELECT mmnu.name_en, mmnu.name_th
                  FROM cmmnu_emp_cat
                  LEFT JOIN mmnu
                     ON cmmnu_emp_cat.id_mmnu = mmnu.id_mmnu
                  WHERE cmmnu_emp_cat.id_mmnu = " . $this->id_menuBegin ."
                    AND cmmnu_emp_cat.`status` = 1
                    AND mmnu.`status` = 1;";
 
            $rs = $this->db1->query($sql);
            
            if ($rs->num_rows() > 1 )
            {
               $row_count = $rs->num_rows();
               $row = $rs->row();
               $name_en       = $row->name_en;
               $name_th       = $row->name_th;
               if ( $row_count > 1 )
               {
                  $this->tree_menu .= "         ['$name_th', '','" . $this->id_menuBegin . "',\n";
               }
               else
               {
                  $this->tree_menu .= "         ['$name_th', '','" . $this->id_menuBegin . "'\n";
               }
            }
            else
            {

            }
         }

         $this->prepare_treeMenu($this->id_menuBegin, $id_memp_cat);
         $this->tree_menu .= "];//var tree
            </script>\n";

         return $this->tree_menu;
      }
      
   }
?>
