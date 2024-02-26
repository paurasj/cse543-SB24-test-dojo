USE bloggo;
INSERT INTO users (username, password, firstname, lastname, email) 
           VALUES ("jdoe", "doedoe", "John", "Doe", "jdoe@foo.com");
INSERT INTO users (username, password, firstname, lastname, email) 
           VALUES ("jdee", "updog", "Jane", "Dee", "jdee@bar.com");
INSERT INTO users (username, password, firstname, lastname, email) 
           VALUES ("jack", "ripper", "Jack", "Ripper", "jack@ripper.com");
INSERT INTO users (username, password, firstname, lastname, email) 
           VALUES ("david", "imrich", "David", "Chapelle", "chapelle@comedy.com");
INSERT INTO users (username, password, firstname, lastname, email) 
           VALUES ("amadeus", "moz4rt", "Amadeus", "Mozart", "mozart@falco.org");
INSERT INTO users (username, password, firstname, lastname, email) 
           VALUES ("admin", "THISISTHESECRET", "Wang", "Fish", "fishw@asu.edu");

INSERT INTO blogs (owner, blogname, password) 
           VALUES ("jdee", 'My Trip To China', 'firenze');
INSERT INTO blogs (owner, blogname, password) 
           VALUES ("jdoe", "Surfin' in SoCal", 'ridethewave');

INSERT INTO entries (author, blogname, title, keywords, entry, shared) 
           VALUES ('jdee', 'My Trip To China', 'Eating in Beijing', "Food, Orange Chicken (OMG)", 
                   "I could not find Peking duck in Beijing", 1);
INSERT INTO entries (author, blogname, title, keywords, entry, shared) 
           VALUES ("jdoe", "Surfing in SoCal", 'December 22, 2005', 
                   "big waves, storm",  
                   "Incredible waves in Santa Barbara!", 1);
INSERT INTO entries (author, blogname, title, keywords, entry, shared) 
           VALUES ("jdoe", "Surfing in SoCal", 'December 23, 2005', 
                   "big waves, storm",  
                   "Still incredible waves in Santa Barbara!", 1);
INSERT INTO entries (author, blogname, title, keywords, entry, shared) 
           VALUES ("jdoe", "My Trip To Beijing", 'Eating in Beijing', "food", 
                   "No Alfredo?!? What about meatballs?", 0);
		
