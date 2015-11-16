/* ORGANIZER */
INSERT INTO USER (username, password) VALUES ("diego", "abc123.");
INSERT INTO USER (username, password) VALUES ("eliot", "abc123.");
INSERT INTO ORGANIZER (o_username) VALUES ("diego", "abc123.")
INSERT INTO ORGANIZER (o_username) VALUES ("eliot", "abc123.");

/* JURY */
INSERT INTO USER (username, password) VALUES ("juanjurado", "abc123.");
INSERT INTO USER (username, password) VALUES ("pepejurado", "abc123.");
INSERT INTO USER (username, password) VALUES ("luisjurado", "abc123.");
INSERT INTO JUDGE (j_username, j_name, j_profession, j_photo)
       	    	  VALUES ("juanjurado", "Juan Castillo Real",
		  "Cocinero", "juancastilloreal.png")
INSERT INTO JUDGE (j_username, j_name, j_profession, j_photo)
       	    	  VALUES ("pepejurado", "Jose Blanco Calero",
		  "Cocinero", "joseblancocalero.png")
INSERT INTO JUDGE (j_username, j_name, j_profession, j_photo)
       	    	  VALUES ("luisjurado", "Luis Barrios Senderos",
		  "Cocinero", "luisbarriossenderos.png")
		  
/* ESTABLISHMENTS */
INSERT INTO USER (username, password) VALUES ("opepe", "abc123.");
INSERT INTO USER (username, password) VALUES ("olagar", "abc123.");
INSERT INTO USER (username, password) VALUES ("lechu", "abc123.");
INSERT INTO USER (username, password) VALUES ("meiga", "abc123.");
INSERT INTO USER (username, password) VALUES ("polar", "abc123.");
INSERT INTO USER (username, password) VALUES ("conti", "abc123.");
INSERT INTO USER (username, password) VALUES ("catanga", "abc123.");
INSERT INTO USER (username, password) VALUES ("xugo", "abc123.");
INSERT INTO ESTABLISHMENT (e_username, address, e_name, e_phate)
       	    		  VALUES ("opepe", "Calle Cardenal nº15",
			  "O Pepe", "opepe.png")
INSERT INTO ESTABLISHMENT (e_username, address, e_name, e_phate)
       	    		  VALUES ("olagar", "Paseo nº3",
			  "O lagar", "olagar.png")
INSERT INTO ESTABLISHMENT (e_username, address, e_name, e_phate)
       	    		  VALUES ("lechu", "Puente Romano 53",
			  "Bar O Lechu", "lechu.png")
INSERT INTO ESTABLISHMENT (e_username, address, e_name, e_phate)
       	    		  VALUES ("meiga", "Morin 14",
			  "A Meiga", "meiga.png")
INSERT INTO ESTABLISHMENT (e_username, address, e_name, e_phate)
       	    		  VALUES ("polar", "Calle Cardenal nº4",
			  "Cafe Bar Polar", "polar.png")
INSERT INTO ESTABLISHMENT (e_username, address, e_name, e_phate)
       	    		  VALUES ("conti", "Quevedo 1",
			  "Cafes Conti", "conti.png")
INSERT INTO ESTABLISHMENT (e_username, address, e_name, e_phate)
       	    		  VALUES ("catanga", "Calle Ozono 31",
			  "Catanga", "catanga.png")
INSERT INTO ESTABLISHMENT (e_username, address, e_name, e_phate)
       	    		  VALUES ("xugo", "Calle Turquesa 34",
			  "Tapas O Xugo", "xugo.png")




