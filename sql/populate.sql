/* ORGANIZER */
INSERT INTO USER (username, password) VALUES ("diego", "abc123.");
INSERT INTO USER (username, password) VALUES ("eliot", "abc123.");
INSERT INTO ORGANIZER (o_username) VALUES ("diego");
INSERT INTO ORGANIZER (o_username) VALUES ("eliot");

/* JURY */
INSERT INTO USER (username, password) VALUES ("juanjurado", "abc123.");
INSERT INTO USER (username, password) VALUES ("pepejurado", "abc123.");
INSERT INTO USER (username, password) VALUES ("luisjurado", "abc123.");
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
INSERT INTO USER (username, password) VALUES ("opepe", "abc123.");
INSERT INTO USER (username, password) VALUES ("olagar", "abc123.");
INSERT INTO USER (username, password) VALUES ("lechu", "abc123.");
INSERT INTO USER (username, password) VALUES ("meiga", "abc123.");
INSERT INTO USER (username, password) VALUES ("polar", "abc123.");
INSERT INTO USER (username, password) VALUES ("conti", "abc123.");
INSERT INTO USER (username, password) VALUES ("catanga", "abc123.");
INSERT INTO USER (username, password) VALUES ("xugo", "abc123.");
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
  (null,"calle del lagarto 8","a@a.b","abc123.","farol.jpg","Minipizza",
    "farol.png",1.5,"masa agua sal queixo tomate",0,"O Farol"),
    (null,"rua se&ntilde;or frasco","a@b.b","abc123.","blue.jpg","Cocodrilo",
      "blue.jpg",2,"carne de cocodrilo",0,"Blue Lake");
