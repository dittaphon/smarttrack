set @id_memp = 1;
set @id_memp_cat = 0;
set @dt_create = '2013-02-01 08:00:00'
SELECT @id_memp_cat := memp.id_memp_cat
   FROM memp
   WHERE memp.id_memp = @id_memp;
set @id_mmnu = 0;
INSERT INTO cmmnu_emp_cat(id_mmnu, id_memp_cat,  status , id_create, dt_create, id_update, dt_update)
   SELECT id_mmnu, @id_memp_cat, 1, @id_memp, @dt_creat, @id_memp,  @dt_create
      FROM mmnu
      WHERE mmnu.`status` = 1
      ORDER BY mmnu.id_mmnu;

SELECT * FROM cmmnu_emp_cat;

