/* ORGANIZER */
INSERT INTO USER (username, password) VALUES ("diego", "e8dc8ccd5e5f9e3a54f07350ce8a2d3d");
INSERT INTO USER (username, password) VALUES ("eliot", "e8dc8ccd5e5f9e3a54f07350ce8a2d3d");
INSERT INTO ORGANIZER (o_username) VALUES ("diego");
INSERT INTO ORGANIZER (o_username) VALUES ("eliot");

/* JURY */
INSERT INTO USER (username, password) VALUES ("juanjurado", "e8dc8ccd5e5f9e3a54f07350ce8a2d3d");
INSERT INTO USER (username, password) VALUES ("pepejurado", "e8dc8ccd5e5f9e3a54f07350ce8a2d3d");
INSERT INTO USER (username, password) VALUES ("luisjurado", "e8dc8ccd5e5f9e3a54f07350ce8a2d3d");
INSERT INTO JUDGE (j_username, j_name, j_profession, j_photo)
       	    	  VALUES ("juanjurado", "Juan Castillo Real",
		  "Cocinero", "juancastilloreal.png");
INSERT INTO JUDGE (j_username, j_name, j_profession, j_photo)
       	    	  VALUES ("pepejurado", "Jose Blanco Calero",
		  "Cocinero", "joseblancocalero.png");
INSERT INTO JUDGE (j_username, j_name, j_profession, j_photo)
       	    	  VALUES ("luisjurado", "Luis Barrios Senderos",
		  "Cocinero", "luisbarriossenderos.png");

/* ESTABLISHMENTS */
INSERT INTO USER (username, password) VALUES ("opepe", "e8dc8ccd5e5f9e3a54f07350ce8a2d3d");
INSERT INTO USER (username, password) VALUES ("olagar", "e8dc8ccd5e5f9e3a54f07350ce8a2d3d");
INSERT INTO USER (username, password) VALUES ("lechu", "e8dc8ccd5e5f9e3a54f07350ce8a2d3d");
INSERT INTO USER (username, password) VALUES ("meiga", "e8dc8ccd5e5f9e3a54f07350ce8a2d3d");
INSERT INTO USER (username, password) VALUES ("polar", "e8dc8ccd5e5f9e3a54f07350ce8a2d3d");
INSERT INTO USER (username, password) VALUES ("conti", "e8dc8ccd5e5f9e3a54f07350ce8a2d3d");
INSERT INTO USER (username, password) VALUES ("catanga", "e8dc8ccd5e5f9e3a54f07350ce8a2d3d");
INSERT INTO USER (username, password) VALUES ("xugo", "e8dc8ccd5e5f9e3a54f07350ce8a2d3d");
INSERT INTO ESTABLISHMENT (e_username, address, e_name, e_photo)
       	    		  VALUES ("opepe", "Calle Cardenal nº15",
			  "O Pepe", "opepe.png");
INSERT INTO ESTABLISHMENT (e_username, address, e_name, e_photo)
       	    		  VALUES ("olagar", "Paseo nº3",
			  "O lagar", "olagar.png");
INSERT INTO ESTABLISHMENT (e_username, address, e_name, e_photo)
       	    		  VALUES ("lechu", "Puente Romano 53",
			  "Bar O Lechu", "lechu.png");
INSERT INTO ESTABLISHMENT (e_username, address, e_name, e_photo)
       	    		  VALUES ("meiga", "Morin 14",
			  "A Meiga", "meiga.png");
INSERT INTO ESTABLISHMENT (e_username, address, e_name, e_photo)
       	    		  VALUES ("polar", "Calle Cardenal nº4",
			  "Cafe Bar Polar", "polar.png");
INSERT INTO ESTABLISHMENT (e_username, address, e_name, e_photo)
       	    		  VALUES ("conti", "Quevedo 1",
			  "Cafes Conti", "conti.png");
INSERT INTO ESTABLISHMENT (e_username, address, e_name, e_photo)
       	    		  VALUES ("catanga", "Calle Ozono 31",
			  "Catanga", "catanga.png");
INSERT INTO ESTABLISHMENT (e_username, address, e_name, e_photo)
       	    		  VALUES ("xugo", "Calle Turquesa 34",
			  "Tapas O Xugo", "xugo.png");

INSERT INTO PINCHO (e_username,p_name,p_photo,p_price,counter)
  VALUES("opepe","Pincho de tortilla","opepe.jpg",1.5,0),
  ("olagar","Polbo &aacute; feira","olagar.jpg",2,0),
  ("lechu","Chourizo con queixo de cabra","lechu.jpg",1,0),
  ("meiga","Croqueta","meiga.jpg",1.5,0),
  ("polar","Arepa","polar.jpg",2.5,0),
  ("conti","Xamon asado","conti.jpg",2,0),
  ("catanga","Queixo azul con marmelada","catanga.jpg",1.5,0),
  ("xugo","Pincho de chistorra","xugo.jpg",1.5,0);

INSERT INTO REQUEST (o_username,address,email,password,e_photo,p_name,p_photo,
  p_price,ingredients,state,e_name) VALUES
  (null,"calle del lagarto 8","a@a.b","e8dc8ccd5e5f9e3a54f07350ce8a2d3d","farol.jpg","Minipizza",
    "farol.png",1.5,"masa agua sal queixo tomate",0,"O Farol"),
    (null,"rua se&ntilde;or frasco","a@b.b","e8dc8ccd5e5f9e3a54f07350ce8a2d3d","blue.jpg","Cocodrilo",
      "blue.jpg",2,"carne de cocodrilo",0,"Blue Lake");
