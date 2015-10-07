drop database if exists raspored;
create database raspored character set utf8 collate utf8_general_ci;
use raspored;

alter database character set utf8 collate utf8_general_ci;

create table korisnik(
	sifra int not null primary key auto_increment,
	korisnik varchar(30) not null,
	slika varchar(100)
);

create table slusa(
	korisnik int not null,
	predmet int not null,
	izostanak_vj int not null default 0,
	izostanak_pr int not null default 0
);

create table predmet(
	sifra int not null primary key auto_increment,
	naziv varchar(100) not null,
	profesor int not null,
	asistent int,
	max_izostanaka_vj int not null,
	max_izostanaka_pr int not null
);

create table profesor(
	sifra int not null primary key auto_increment,
	ime varchar(15) not null,
	prezime varchar(30) not null
);

alter table slusa add foreign key (korisnik) references korisnik(sifra);
alter table slusa add foreign key (predmet) references predmet(sifra);
alter table predmet add foreign key (profesor) references profesor(sifra);
alter table predmet add foreign key (asistent) references profesor(sifra);

insert into korisnik (korisnik) values ("lbuljan");
insert into profesor(ime, prezime) values ("Mirna", "Varga"), ("Damir", "Hasenay"), ("Maja", "Krtalić"), ("Gordana", "Dukić"), ("Ines", "Hocenski"), ("Sanjica", "Faletar Tanacković"), ("Darko", "Lacović"), ("Josipa", "Selthofer"), ("Kornelija", "Petr Balog"), ("Kristina", "Feldvari"), ("Milijana", "Mičunović");
insert into predmet (naziv, profesor, asistent, max_izostanaka_pr, max_izostanaka_vj) values ("Engleski jezik za napredne 1", 1, NULL, 6, 6),
		("Upravljanje u nakladništvu i knjižarstvu", 8, NULL, 4, 4),
		("Čuvanje i zaštita elektroničkih dokumenata", 2, 3, 4, 4),
		("Marketing knjižničnih proizvoda i usluga", 4, 5, 4, 4),
		("Marketing u nakladništvu i knjižarstvu", 4, 5, 4, 4),
		("Teorija i praksa organizacije informacija", 9, 10, 4, 4),
		("Arhitektura knjižnica", 6, 7, 4, 4),
		("Informacijska politika i tehnološke promjene", 11, NULL, 4, 4);
insert into slusa (korisnik, predmet) values (1, 2), (1, 4), (1, 6), (1, 8);