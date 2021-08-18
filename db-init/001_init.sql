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
    primary key(id),
    unique index(login)
);

-- Benutzer einfügen:
-- ACHTUNG: Der Einfachheit halber wurden hier Plain-Text-Passwörter verwendet. Dies wird in der Praxis NICHT so gemacht!
-- Passwörter sollten mit einem sicheren Hash-Verfahren in der Datenbank gespeichert werden!
insert into benutzer values
(null,'alex','geheim','Schenkel','Alex','alex@alexi.ch',null),
(null,'frodo','ring','Beutlin','Frodo','frodo@auenland.net',null),
(null,'bilbo','schatz','Beutlin','Bilbo','bilbo@auenland.net',null),
(null,'thorin','gold','Eichenschild','Thorin','thorin@moria.net',null);
