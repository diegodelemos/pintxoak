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
