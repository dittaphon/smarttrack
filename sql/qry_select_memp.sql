set @id_memp = 1;
set @id_memp_cat = 0;
SELECT @id_memp_cat := memp.id_memp_cat
   FROM memp
   WHERE memp.id_memp = @id_memp;

SELECT memp_tit.name_th EMPLOYEE_TITLE, memp.name_th EMPLOYEE_NAME, memp_cat.name_th EMPLOYEE_GROUP
   FROM memp LEFT JOIN memp_cat
      ON memp.id_memp_cat = memp_cat.id_memp_cat
   LEFT JOIN memp_tit 
      ON memp.id_memp_tit = memp_tit.id_memp_tit
   WHERE memp.id_memp = @id_memp;