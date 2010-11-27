#
#  Table structure for people table
#
DROP TABLE IF EXISTS people;

CREATE TABLE people (
pp_id int(11) NOT NULL auto_increment,
pp_name text NOT NULL,
pp_img text NOT NULL,
pp_email varchar(100) NOT NULL,
pp_password text NOT NULL,
PRIMARY KEY (pp_id)
)TYPE=MyISAM;

#
#  Table structure for friend_list table
#
DROP TABLE IF EXISTS friend_list;

CREATE TABLE friend_list (
fl_id int(30) NOT NULL auto_increment,
pp_id int(11) NOT NULL,
fl_friend int(11) NOT NULL,
PRIMARY KEY (fl_id),
FOREIGN KEY (pp_id) REFERENCES people(pp_id) ON UPDATE CASCADE ON DELETE CASCADE
)TYPE=MyISAM;

#
#  Table structure for day_off table
#
DROP TABLE IF EXISTS day_off;

CREATE TABLE day_off (
do_id int(30) NOT NULL auto_increment,
pp_id int(11) NOT NULL,
do_day date NOT NULL,
PRIMARY KEY (do_id),
FOREIGN KEY (pp_id) REFERENCES people(pp_id) ON UPDATE CASCADE ON DELETE CASCADE
)TYPE=MyISAM;

#
#  Table structure for movie_list table
#
DROP TABLE IF EXISTS movie_list;

CREATE TABLE movie_list (
ml_id int(30) NOT NULL auto_increment,
pp_id int(11) NOT NULL,
ml_movie text NOT NULL,
PRIMARY KEY (ml_id),
FOREIGN KEY (pp_id) REFERENCES people(pp_id) ON UPDATE CASCADE ON DELETE CASCADE
)TYPE=MyISAM;


INSERT INTO people VALUES ("1","Peter","joy.png","peter@plan_c.com","peter");
INSERT INTO people VALUES ("2","Mayous","happy.png","mayous@plan_c.com","mayous");
INSERT INTO people VALUES ("3","Bayira","bab","bayira@plan_c.com","bayira");

INSERT INTO friend_list VALUES ("1","1","2");
INSERT INTO friend_list VALUES ("2","1","3");
INSERT INTO friend_list VALUES ("3","2","1");
INSERT INTO friend_list VALUES ("4","2","3");
INSERT INTO friend_list VALUES ("5","3","1");
INSERT INTO friend_list VALUES ("6","3","2");

INSERT INTO day_off VALUES ("1","1","2010-11-26");
INSERT INTO day_off VALUES ("2","1","2010-11-27");
INSERT INTO day_off VALUES ("3","1","2010-11-28");
INSERT INTO day_off VALUES ("4","2","2010-11-25");
INSERT INTO day_off VALUES ("5","2","2010-11-27");
INSERT INTO day_off VALUES ("6","2","2010-11-28");
INSERT INTO day_off VALUES ("7","3","2010-11-26");
INSERT INTO day_off VALUES ("8","3","2010-11-28");
INSERT INTO day_off VALUES ("9","3","2010-11-29");

INSERT INTO movie_list VALUES ("1","1","http://api.cineti.ca/movie/21868");
INSERT INTO movie_list VALUES ("2","1","http://api.cineti.ca/movie/37321");
INSERT INTO movie_list VALUES ("3","1","http://api.cineti.ca/movie/40923");
INSERT INTO movie_list VALUES ("4","1","http://api.cineti.ca/movie/39239");
INSERT INTO movie_list VALUES ("5","1","http://api.cineti.ca/movie/40337");
INSERT INTO movie_list VALUES ("6","2","http://api.cineti.ca/movie/21868");
INSERT INTO movie_list VALUES ("7","2","http://api.cineti.ca/movie/37321");
INSERT INTO movie_list VALUES ("8","2","http://api.cineti.ca/movie/42076");
INSERT INTO movie_list VALUES ("9","2","http://api.cineti.ca/movie/40337");
INSERT INTO movie_list VALUES ("10","2","http://api.cineti.ca/movie/30762");
INSERT INTO movie_list VALUES ("11","3","http://api.cineti.ca/movie/21868");
INSERT INTO movie_list VALUES ("12","3","http://api.cineti.ca/movie/38365");
INSERT INTO movie_list VALUES ("13","3","http://api.cineti.ca/movie/40337");
INSERT INTO movie_list VALUES ("14","3","http://api.cineti.ca/movie/35596");
INSERT INTO movie_list VALUES ("15","3","http://api.cineti.ca/movie/39240");
