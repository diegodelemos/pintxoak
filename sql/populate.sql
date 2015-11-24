/* ORGANIZER */
INSERT INTO `USER` VALUES ('diego','e8dc8ccd5e5f9e3a54f07350ce8a2d3d'),('eliot','e8dc8ccd5e5f9e3a54f07350ce8a2d3d'),('juanjurado','e8dc8ccd5e5f9e3a54f07350ce8a2d3d'),('lion@gmai.com','0cc175b9c0f1b6a831c399e269772661'),('luisjurado','e8dc8ccd5e5f9e3a54f07350ce8a2d3d'),('mina@gmail.com','0cc175b9c0f1b6a831c399e269772661'),('palloza@gmail.com','0cc175b9c0f1b6a831c399e269772661'),('pepejurado','e8dc8ccd5e5f9e3a54f07350ce8a2d3d'),('pepito@gmail.com','0cc175b9c0f1b6a831c399e269772661'),('pescador@gmail.com','0cc175b9c0f1b6a831c399e269772661'),('turco@gmail.com','0cc175b9c0f1b6a831c399e269772661');

INSERT INTO ORGANIZER (o_username) VALUES ("diego");
INSERT INTO ORGANIZER (o_username) VALUES ("eliot");

/* JURY */
INSERT INTO JUDGE (j_username, j_name, j_profession, j_photo)
       	    	  VALUES ("juanjurado", "Juan Castillo Real",
		  "Cocinero", "juancastilloreal.png");
INSERT INTO JUDGE (j_username, j_name, j_profession, j_photo)
       	    	  VALUES ("pepejurado", "Jose Blanco Calero",
		  "Cocinero", "joseblancocalero.png");
INSERT INTO JUDGE (j_username, j_name, j_profession, j_photo)
       	    	  VALUES ("luisjurado", "Luis Barrios Senderos",
		  "Cocinero", "luisbarriossenderos.png");



/* REQUEST */
INSERT INTO `REQUEST` VALUES (1,NULL,'Calle Chantada 32','horreo@gmail.com','0cc175b9c0f1b6a831c399e269772661','63aa438566.jpeg','Chistorra galega','37027eaf9c.jpg',2.00,'chistorra pan',0,'Horreo'),(2,NULL,'Calle Turquesa 54','jallo@gmail.com','0cc175b9c0f1b6a831c399e269772661','85bdd53e48.jpeg','Chourizo caprino','341109af17.jpg',2.00,'chourizo queixo de cabra',0,'O\' Jallo'),(3,NULL,'Calle do Comercio 21','lareira@gmail.com','0cc175b9c0f1b6a831c399e269772661','37b5902b10.jpeg','Cocodrilo','1c747d2c6b.jpg',1.50,'ajo, sal, patatas, carne de ternera',0,'A Lareira'),(4,'eliot','Calle do Paseo 34','lion@gmai.com','0cc175b9c0f1b6a831c399e269772661','161fb6863c.jpg','Porco celta con ovos de codorniz','4b71e09c7b.png',2.50,'porco celta, ovos de codorniz, pemento, pan, allo e perexil',1,'The White Lion'),(5,NULL,'Calle do BarbaÃ±a 1','luscofusco@gmail.com','0cc175b9c0f1b6a831c399e269772661','63cd93ac32.jpeg','ArepiÃ±a con queixo','808ce09754.jpg',2.00,'fariÃ±a de millo, sal, auga, queixo',0,'Luscofusco'),(6,'eliot','Rua Torvalds 10','mina@gmail.com','0cc175b9c0f1b6a831c399e269772661','c39d8966e2.jpeg','Croqueta da horta','f689e32429.png',2.00,'pimientos verdes y rojos, bechamel, pan rallado, jamon queso y pan de cea',1,'A Mina'),(7,NULL,'Plaza de ferro 2','mogambo@gmail.com','0cc175b9c0f1b6a831c399e269772661','2e1e575a1b.jpeg','Hamburguesa Galega','815a143eaa.jpg',2.00,'jamon pan cebolla ajo pimiento sal',0,'Mogamb0'),(8,'eliot','Avenida de Buenos Aires 32','palloza@gmail.com','0cc175b9c0f1b6a831c399e269772661','f71ace3cfc.jpeg','Retro-hamburguesas','d472ceffda.jpg',2.50,'tofu colorantes fariÃ±a sal jengibre cebola humus',1,'A Palloza'),(9,'eliot','Rua Nova 71','pepito@gmail.com','0cc175b9c0f1b6a831c399e269772661','1fce18dae9.jpeg','Mini pizza','f42ee2de0a.png',2.00,'mozzarella tomate salsa de tomate solis harina sal loureiro fresco oregano',1,'Pepito\'s'),(10,'eliot','Banda do Rio 32','pescador@gmail.com','0cc175b9c0f1b6a831c399e269772661','aca1750a93.jpeg','Polbo a feira','f053c65bce.jpg',2.50,'polbo pimenton allo sal aceite de oliva',1,'Pescador'),(11,NULL,'Camino caneiro 27','queen@gmail.com','0cc175b9c0f1b6a831c399e269772661','d5eb3a006c.jpeg','Tortilla','b746ff78bc.jpg',1.50,'huevos sal cebolla patata aceite',0,'Queen'),(12,'eliot','Avenida Habana 31','turco@gmail.com','0cc175b9c0f1b6a831c399e269772661','7b7f0607f8.jpeg','MarmeliÃ±a','19031c79e1.jpg',2.00,'marmelada de figos, queixo azul, pan de millo, ',1,'O Turco');


/* ESTABLISHMENT */
INSERT INTO `ESTABLISHMENT` VALUES ('lion@gmai.com','Calle do Paseo 34','The White Lion','161fb6863c.jpg'),('mina@gmail.com','Rua Torvalds 10','A Mina','c39d8966e2.jpeg'),('palloza@gmail.com','Avenida de Buenos Aires 32','A Palloza','f71ace3cfc.jpeg'),('pepito@gmail.com','Rua Nova 71','Pepito\'s','1fce18dae9.jpeg'),('pescador@gmail.com','Banda do Rio 32','Pescador','aca1750a93.jpeg'),('turco@gmail.com','Avenida Habana 31','O Turco','7b7f0607f8.jpeg');

/* PINCHO */
INSERT INTO `PINCHO` VALUES (7,'lion@gmai.com','Porco celta con ovos de codorniz','4b71e09c7b.png',2.50,0),(8,'mina@gmail.com','Croqueta da horta','f689e32429.png',2.00,0),(9,'palloza@gmail.com','Retro-hamburguesas','d472ceffda.jpg',2.50,0),(10,'pepito@gmail.com','Mini pizza','f42ee2de0a.png',2.00,0),(11,'pescador@gmail.com','Polbo a feira','f053c65bce.jpg',2.50,0),(12,'turco@gmail.com','MarmeliÃ±a','19031c79e1.jpg',2.00,0);


/* INGREDIENT */
INSERT INTO `INGREDIENT` VALUES ('aceite de oliva',0),('ajo',0),('bechamel',1),('carne de cerdo',0),('cebolla',0),('harina',1),('huevo de codorniz',0),('humus',0),('jamon',0),('jengibre',0),('laurel',0),('mermelada de higos',0),('mozzarella',1),('orÃ©gano',0),('pan',1),('pan de maiz',0),('perejil',0),('pimentÃ³n',0),('pimiento',0),('pulpo',1),('queso',1),('queso azul',0),('sal',0),('salsa de tomate',0),('tofu',0),('tomate',0);

/* CONTAINS */
INSERT INTO `CONTAINS` VALUES (11,'aceite de oliva'),(7,'ajo'),(11,'ajo'),(8,'bechamel'),(7,'carne de cerdo'),(9,'cebolla'),(9,'harina'),(10,'harina'),(7,'huevo de codorniz'),(9,'humus'),(8,'jamon'),(9,'jengibre'),(10,'laurel'),(12,'mermelada de higos'),(10,'mozzarella'),(10,'orÃ©gano'),(7,'pan'),(8,'pan'),(12,'pan de maiz'),(7,'perejil'),(11,'pimentÃ³n'),(7,'pimiento'),(8,'pimiento'),(11,'pulpo'),(8,'queso'),(12,'queso azul'),(9,'sal'),(10,'sal'),(11,'sal'),(10,'salsa de tomate'),(9,'tofu'),(10,'tomate');


/* CODE */
INSERT INTO `CODE` VALUES (7,1,1,0,'e2c420d928'),(7,2,1,0,'32bb90e897'),(7,3,0,0,'d2ddea18f0'),(7,4,0,0,'ad61ab1432'),(7,5,0,0,'d09bf41544'),(7,6,0,0,'fbd7939d67'),(7,7,0,0,'28dd2c7955'),(7,8,0,0,'35f4a8d465'),(7,9,0,0,'d1fe173d08'),(7,10,0,0,'e70611883d'),(7,11,0,0,'6081594975'),(7,12,0,0,'19bc916108'),(7,13,0,0,'07c5807d0d'),(7,14,0,0,'d14220ee66'),(7,15,0,0,'8df707a948'),(9,1,1,0,'54229abfcf'),(9,2,1,0,'92cc227532'),(9,3,0,0,'98dce83da5'),(9,4,0,0,'f4b9ec30ad'),(9,5,0,0,'812b4ba287'),(9,6,0,0,'26657d5ff9'),(9,7,0,0,'e2ef524fbf'),(9,8,0,0,'ed3d2c2199'),(9,9,0,0,'ac627ab1cc'),(9,10,0,0,'e205ee2a5d'),(12,1,1,1,'4c56ff4ce4'),(12,2,1,1,'a0a080f42e'),(12,3,0,0,'202cb962ac'),(12,4,0,0,'c8ffe9a587'),(12,5,0,0,'3def184ad8');


