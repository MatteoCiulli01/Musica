use ideeinbi_musica;

drop table if exists lezioni;
drop table if exists insegnanti;
drop table if exists insegnante_scuola;
drop table if exists scuole;

create table if not exists insegnanti
(
	id_insegnante int PRIMARY KEY AUTO_INCREMENT,
    nome varchar(45),
    cognome varchar(45),
    sesso varchar(20),
    eta int,
     strumento varchar(127)
);

insert into insegnanti values
(1, "Pio", "Costa", "male", 31,  "chitarra elettrica"),
(2, "Settimo","Loggia","male", 41, "basso elettrico"),
(3, "Fortunato", "Calabrese", "male", 54, "batteria e percussioni");

create table if not exists scuole
(
	id_scuola int PRIMARY KEY AUTO_INCREMENT,
    via varchar(255),
    civico int,
    cap int,
    citta varchar(255),
    url_mappa varchar(511)
);

insert into scuole values
(1, "Via Montegrappa", 32, 50127, "Firenze FI", "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2880.000809011787!2d11.212543415726328!3d43.79359625135836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x132a56e6f0270677%3A0x30009b646ac66260!2sMusikalmente!5e0!3m2!1sit!2sit!4v1591634767876!5m2!1sit!2sit"),
(2, "Via Giovanni Paisiello", 131, 50144, "Firenze FI", "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2880.4415853728847!2d11.22376541572607!3d43.784449251951315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x132a56c6cdd33185%3A0xd39648db7cb89e5e!2sAccademia%20San%20Felice%20scuola%20di%20musica!5e0!3m2!1sit!2sit!4v1591634674368!5m2!1sit!2sit");

create table if not exists insegnante_scuola
(
	id_insegnante int,
    id_scuola int,
    PRIMARY KEY(id_insegnante, id_scuola),
    foreign key (id_insegnante) references insegnanti(id_insegnante) on delete cascade,
    foreign key (id_scuola) references scuole(id_scuola) on delete cascade
);

insert into insegnante_scuola values
(1,1),
(2,2),
(3,2);

create table if not exists lezioni
(
	id_lezione int PRIMARY KEY AUTO_INCREMENT,
    data_ora datetime,
    id_utente int,
    id_insegnante int,
    foreign key (id_utente) references utenti(id_utente) on delete cascade,
    foreign key (id_insegnante) references insegnanti(id_insegnante) on delete cascade
);

select * from lezioni;
select * from scuole;

select I.cognome, count(distinct L.id_utente) utenti, MONTHNAME(L.data_ora) Mese, I.via from lezioni L inner join insegnanti I on L.id_insegnante = I.id_insegnante
/*where I.url_mappa = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2880.4415853728847!2d11.22376541572607!3d43.784449251951315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x132a56c6cdd33185%3A0xd39648db7cb89e5e!2sAccademia%20San%20Felice%20scuola%20di%20musica!5e0!3m2!1sit!2sit!4v1591634674368!5m2!1sit!2sit'
*/group by I.url_mappa, I.id_insegnante, Mese;