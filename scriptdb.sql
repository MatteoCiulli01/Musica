create table if not exists Artisti
(
    id_artista int not null auto_increment,
    nome varchar(500),
    anno year,
    descrizione varchar(500),
    primary key (id_artista)
);

/*insert into Artisti values
(default, "bruh", 1980, "cbt"),
(default, "moment", 1990, "deeznuts"),
(default, "test", 2020, "test"),
(default, "Mauro Lapio", 2001, "persona esistente sulla Terra.");*/

create table if not exists Album
(
    id_album int not null auto_increment,
    nome varchar(500),
    genere varchar(20),
    anno year,
    url_cover varchar(500),
    cod_artista int,
    primary key (id_album),
    foreign key (cod_artista) references Artisti(id_artista)
);

/*insert into Album values
(default, "test","pino", 1980,"urlcover" , 1),
(default, "test","gino", 1990,"urlcover" ,2),
(default, "test","dino", 2000,"urlcover" ,3),
(default, "L''Album","Musica", 2020,"urlcover" ,4);*/

create table if not exists Canzoni
(
    id_canzone int not null auto_increment,
    titolo varchar(500),
    durata int,
    genere varchar(20),
    anno year,
    url_canzone varchar(500),
    cod_album int,
    primary key (id_canzone),
    foreign key (cod_album) references Album(id_album)
);

/*insert into Canzoni values
(default, "Gianna", 10,"Folk epico", 2020,"./songs/Gianna-Mauro_Lapio.mp3" ,4),
(default, "Eruption", 10,"Metal bello", 2020,"./songs/Eruption-Mauro_Lapio.mp3" ,4);*/

create table if not exists Canzone_Artista
(
    id_canzoneartista int not null auto_increment,
    cod_canzone int,
    cod_artista int,
    primary key (id_canzoneartista),
    foreign key (cod_canzone) references Canzoni(id_canzone),
    foreign key (cod_artista) references Artisti(id_artista)
);

/*insert into Canzone_Artista values
(default,1,4),
(default,2,4);*/

create table if not exists Credenziali
(
    id_credenziali int not null auto_increment,
    username varchar(64),
    password varchar(128),
    primary key (id_credenziali)
);

CREATE TABLE if not exists Utenti 
( 
	id_utenti INT NOT NULL AUTO_INCREMENT,
 	email VARCHAR(255) NOT NULL,
	sesso VARCHAR(20) NOT NULL, 
	admin BOOLEAN NOT NULL,
	cod_credenziali INT NOT NULL,
	PRIMARY KEY (id_utenti),
	FOREIGN KEY (cod_credenziali) REFERENCES Credenziali(id_credenziali)
);