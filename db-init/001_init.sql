-- Datenbank erstellen, wenn noch nicht gemacht:
create database m151;
use m151;
-- Datenbank-Benutzer erstellen:
grant all privileges on m151.* to 'm151'@'%';
flush privileges;

-- Benutzer-Tabelle erstellen:
create table benutzer (
    id integer auto_increment not null,
    login varchar(100) not null,
    passwort varchar(256),
    name varchar(100),
    vorname varchar(100),
    email varchar(256),
    letzter_login datetime default NULL,
    register_date date default NULL,
    primary key(id),
    unique index(login)
);

create table categorys (
    name varchar(100),
    numberOfThreads integer,
    primary key(name),
    unique index(name)

);

create table tags (
    id integer auto_increment not null,
    name varchar(100),
    primary key(id)
);

create table threads (
    ThreadId integer auto_increment not null,
    UserId integer not null,
    Date timestamp,
    Title varchar(256),
    Body text,
    category varchar(100),
    primary key(ThreadId),
    FOREIGN KEY (UserId) REFERENCES benutzer(id),
    FOREIGN KEY (category) REFERENCES categorys(name)
);

create table ThreadTags (
    id integer auto_increment not null,
    IdThread integer not null,
    tagId integer not null,
    primary key(id),
    FOREIGN Key (IdThread) REFERENCES threads(ThreadId),
    FOREIGN Key (tagId) REFERENCES tags(id)
);

create table posts (
    PostId integer auto_increment not null,
    ThreadId integer not null,
    UserId integer not null,
    AnswerId integer,
    Date timestamp,
    Body text,
    primary key(PostId),
    FOREIGN KEY(ThreadId) REFERENCES threads(ThreadId),
    FOREIGN KEY(AnswerId) REFERENCES posts(PostId)
);

-- Benutzer einfügen:
-- ACHTUNG: Der Einfachheit halber wurden hier Plain-Text-Passwörter verwendet. Dies wird in der Praxis NICHT so gemacht!
-- Passwörter sollten mit einem sicheren Hash-Verfahren in der Datenbank gespeichert werden!
insert into benutzer values
(null,'alex','geheim','Schenkel','Alex','alex@alexi.ch',null, CURDATE()),
(null,'frodo','ring','Beutlin','Frodo','frodo@auenland.net',null, CURDATE()),
(null,'bilbo','schatz','Beutlin','Bilbo','bilbo@auenland.net',null, CURDATE()),
(null,'thorin','gold','Eichenschild','Thorin','thorin@moria.net',null, CURDATE());

insert into categorys values
('Allgemein', 1),
('Schule', 1),
('Arbeit', 0),
('Privat', 0),
('Medizin', 0),
('Weihnachten', 1),
('Geburtstag', 0),
('Wochenende', 0),
('Computer', 0),
('Ferien', 0);

insert into tags values
(null, 'WitzigerTag'),
(null, 'ZweiterTag'),
(null, 'DritterTag'),
(null, 'Ernst'),
(null, 'Wochenende');

insert into threads values
(null, 1, CURRENT_TIMESTAMP(), 'Erster Thread', 'Das hier ist der Erste Thread der überhaupt erstellt wurde', 'Allgemein'),
(null, 3, CURRENT_TIMESTAMP(), 'Zweiter Thread', 'Das hier ist der Zweite Thread der überhaupt erstellt wurde', 'Schule'),
(null, 2, CURRENT_TIMESTAMP(), 'Dritter Thread', 'Das hier ist der Dritte Thread der überhaupt erstellt wurde', 'Weihnachten'),
(null, 1, CURRENT_TIMESTAMP(), 'Lorem Upsum Titel', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.' , 'Allgemein'),
(null, 1, CURRENT_TIMESTAMP(), 'Lorem Upsum Titel', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.' , 'Allgemein'),
(null, 1, CURRENT_TIMESTAMP(), 'Lorem Upsum Titel', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.' , 'Allgemein'),
(null, 1, CURRENT_TIMESTAMP(), 'Lorem Upsum Titel', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.' , 'Allgemein'),
(null, 1, CURRENT_TIMESTAMP(), 'Lorem Upsum Titel', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.' , 'Allgemein'),
(null, 1, CURRENT_TIMESTAMP(), 'Lorem Upsum Titel', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.' , 'Allgemein'),
(null, 1, CURRENT_TIMESTAMP(), 'Lorem Upsum Titel', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.' , 'Allgemein'),
(null, 1, CURRENT_TIMESTAMP(), 'Lorem Upsum Titel', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.' , 'Allgemein');

insert into ThreadTags values
(null, 1,1),
(null, 1,2),
(null, 1,4),
(null, 2,1);

insert into posts values
(null, 1, 1 , null ,CURRENT_TIMESTAMP(), "Das ist der Body der Antwort"),
(null, 1, 1 , null ,CURRENT_TIMESTAMP(), "Das ist der Body der Antwort"),
(null, 1, 2 , 2 ,CURRENT_TIMESTAMP(), "Das ist der Body der Antwort"),
(null, 1, 2 , 3 ,CURRENT_TIMESTAMP(), "Das ist der Body der Antwort"),
(null, 1, 3 , 3 ,CURRENT_TIMESTAMP(), "Das ist der Body der Antwort"),
(null, 1, 2 , 5 ,CURRENT_TIMESTAMP(), "Das ist der Body der Antwort"),
(null, 2, 1 , null ,CURRENT_TIMESTAMP(), "Das ist der Body der Antwort"),
(null, 3, 1 , null ,CURRENT_TIMESTAMP(), "Das ist der Body der Antwort");