            CREATE TEMPORARY TABLE `tmp_mmnu` (
              `id_mmnu` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `name_en` varchar(255) DEFAULT NULL,
              `name_th` varchar(255) DEFAULT NULL,
              `id_parent` int(11) unsigned DEFAULT NULL,
              `id_order` int(11) unsigned DEFAULT NULL,
              `filelocation` varchar(255) DEFAULT NULL,
              `status` int(11) NOT NULL DEFAULT '1',
              PRIMARY KEY (`id_mmnu`)
            ) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8;



            INSERT INTO tmp_mmnu(id_mmnu, name_en, name_th, id_parent, id_order, filelocation, `status`)
               SELECT mmnu.id_mmnu, mmnu.name_en, mmnu.name_th, mmnu.id_parent, mmnu.id_order, mmnu.filelocation, cmmnu_emp_cat.`status`
               FROM mmnu
               INNER JOIN cmmnu_emp_cat
                  ON mmnu.id_mmnu = cmmnu_emp_cat.id_mmnu
               WHERE cmmnu_emp_cat.id_memp_cat = 1
                 AND mmnu.`status` = 1
                 AND cmmnu_emp_cat.`status` = 1
               ORDER BY mmnu.id_mmnu;
            
            SELECT * FROM tmp_mmnu;
            DROP TABLE tmp_mmnu;