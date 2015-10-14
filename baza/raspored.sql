drop database if exists raspored;
create database raspored character set utf8 collate utf8_general_ci;
use raspored;

alter database character set utf8 collate utf8_general_ci;

create table korisnik(
	sifra int not null primary key auto_increment,
	korisnik varchar(30) not null,
	lozinka varchar(100) not null,
	slika varchar(100) default "placeholder.png"
);

create table postavke(
	korisnik int not null,
	alarm boolean default 0,
	alarm_time time default "00:15:00"
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
	dan_vj varchar(20) not null,
	sat_vj time not null,
	dan_pr varchar(20) not null,
	sat_pr time not null,
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
alter table postavke add foreign key (korisnik) references korisnik(sifra);

insert into korisnik (korisnik, lozinka, slika) values ("lbuljan", md5("admin"), "sloth.jpg");
insert into profesor(ime, prezime) values ("Mirna", "Varga"), ("Damir", "Hasenay"), ("Maja", "Krtalić"), ("Gordana", "Dukić"), ("Ines", "Hocenski"), ("Sanjica", "Faletar Tanacković"), ("Darko", "Lacović"), ("Josipa", "Selthofer"), ("Kornelija", "Petr Balog"), ("Kristina", "Feldvari"), ("Milijana", "Mičunović");
insert into predmet (naziv, profesor, asistent, dan_vj, sat_vj, dan_pr, sat_pr, max_izostanaka_pr, max_izostanaka_vj) values
		("Upravljanje u nakladništvu i knjižarstvu", 8, NULL, "Utorak", "9:00:00", "Petak", "10:30:00", 4, 4),
		("Čuvanje i zaštita elektroničkih dokumenata", 2, 3, "Petak", "8:45:00", "Utorak", "14:00:00", 4, 4),
		("Marketing knjižničnih proizvoda i usluga", 4, 5, "Utorak", "18:15:00", "Utorak", "15:00:00", 4, 4),
		("Marketing u nakladništvu i knjižarstvu", 4, 5, "Utorak", "16:30:00", "Utorak", "15:00:00", 4, 4),
		("Teorija i praksa organizacije informacija", 9, 10, "Petak", "14:00:00", "Srijeda", "8:45:00", 4, 4),
		("Arhitektura knjižnica", 6, 7, "Četvrtak", "13:00:00", "Četvrtak", "12:15:00", 4, 4),
		("Informacijska politika i tehnološke promjene", 11, NULL, "Četvrtak", "15:45:00", "Četvrtak", "14:45:00", 4, 4);