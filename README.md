M151 - DB in Web-Applikation einbinden - Bootstrap-Repository
==============================================================

Dieses Repository dient als Startpunkt für das Modul M151 - DB in Web-Applikation einbinden.

Es definiert die für die Schüler-Infrastruktur notwendigen Dienste (Docker-Container, siehe `docker-compose.yml).

## Benutzung mit docker:

```
# Starten aller Dienste:
$ docker-compose up

# (optional, da automatisch beim Start) Web-Applikation: Abhängigkeiten und Autoloader konfigurieren:
$ docker exec -ti m151-web composer install
```

Danach stehen folgende Dienste zur Verfügung:

* `m151-web`: http://localhost:8020/webroot/
* `plantuml`: http://localhost:10001/
* `m151-db`: MySQL-Server, Port 3306, user: `m151`, pw: `m151`
* `m151-docsify`: http://localhost:10000/

## Vagrant VM Build

Für die Schüler wird eine VM mittels Vagrant erstellt. Die VM ist mit einem Ubuntu mit XFCE-Desktop
ausgestattet, und beinhaltet alles Notwendige für den Unterricht:

* VS Code
* docker
* git

**Erstellen/Starten der VM:**

```shell
$ cd /pfad/zum/git-/repo
$ vagrant up --provider virtualbox
```

Dies erstelt eine VM für den Default Provider "virtualbox". VirtualBox muss dafür auf dem Host-PC installiert sein.


**Stoppen der VM:**

```shell
$ cd /pfad/zum/git-/repo
$ vagrant halt
```

### Networking mit Vagrant

Die Box wird mit einenm Private Network konfiguriert: die VM hat die IP `10.10.10.10`.
somit sind die Container erreichbar über:

* `m151-web`: http://10.10.10.10:8020/webroot/
* `plantuml`: http://10.10.10.10:10001/
* `m151-db`: MySQL-Server, IP: 10.10.10.10, Port 3306, user: `m151`, pw: `m151`
* `m151-docsify`: http://10.10.10.10:10000/

Wenn ein anderes/zusätzliches Netzwerk gewünscht wird, kann das im `Vagrantfile` angepasst werden.

### Vagrant VMWare Builds

Um Images für VMWare Fusion / Desktop zu erstellen, sind ein paar extra Schritte notwendig:

* Installieren des VMWare Providers: `vagrant plugin install vagrant-vmware-desktop`
* Installieren des Vagrant VMWare Utilities: https://www.vagrantup.com/vmware/downloads

Nun kann eine VM für VMWare erstellt werden:

```shell
$ vagrant up --provider vmware_desktop
```

## PHP und XDebug

Wenn man XDebug benutzen will, um PHP-code im Web-container (`m151-web`) zu debuggen, ist folgendes anzupassen:

* im File `docker/web/php.ini` muss die Remote-XDebug-IP gesetzt werden:
    * für Benutzung via lokalem Docker: `xdebug.remote_host = host.docker.internal`
    * für die Benutzung in der VirtualBox VM, mit dem privaten Netzwerk: `xdebug.remote_host = 10.10.10.1`
* den `docker-web`-Container neu bilden: `docker-compose build web`
* den web-Container entfernen, neu starten: `docker-compose kill web && docker-compose up -d web`

(c) Alexander Schenkel, alex@alexi.ch
