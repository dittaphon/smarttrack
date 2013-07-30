SELECT mmnu.name_th, mmnu.filelocation
   FROM cmmnu_emp_cat
   LEFT JOIN mmnu
      ON cmmnu_emp_cat.id_mmnu = mmnu.id_mmnu
   WHERE cmmnu_emp_cat.`status` = 1
      AND mmnu.`status` = 1
   ORDER BY cmmnu_emp_cat.id_mmnu