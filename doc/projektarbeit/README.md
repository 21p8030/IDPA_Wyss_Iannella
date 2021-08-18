Projekt Web-Applikation mit Datenbank (Modul 151)
==================================================

[**LBV Modul 151-5 - 1 Elemente - Bearbeiten eines Projekts**](https://cf.ict-berufsbildung.ch/modules.php?name=Mbk&a=20101&cmodnr=151&noheader=1)

Ziel
--------

Im Rahmen einer Projektarbeit entwickeln Sie in Einzelarbeit eine Web-Applikation mit Datenbank, welche heutigen Sicherheits-Anforderungen gerecht werden kann.
Dabei entwerfen Sie selbständig ein kleines Web-MVC-Framework und implementieren die notwendige Funktionalität.

Sie haben bis Ende Semester Zeit, Die Web-Applikation zu entwerfen und umzusetzen. Während des Unterrichts lernen Sie die notwendigen Kenntnisse 
und Technologien kennen, welche Sie dann im Projekt umsetzen.

Ziel ist eine **dokumentierte** und **lauffähige** Web-Applikation, welche die von Ihnen selbst gewählten Anforderungen abdeckt.

Projektvorgaben
----------------

* Die Projektarbeit wird in **Einzelarbeit** umgesetzt.
* Sie definieren selber ein **Pflichtenheft** zu Ihrer Applikation. Dies kann z.B. ein Blog-System, ein Web-Forum, eine Medien- resp. Bilderverwaltung
  oder ein RSS-Feed-Reader sein. Eigene Vorschläge sind sehr willkommen, werden aber mit der Lehrperson abgesprochen.
* Wählen Sie die Applikation nicht zu umfangreich: **Das Projekt muss zum Schluss des Semesters abgeschlossen sein.**
  Die Applikation sollte **aus 5-8 Haupt-Modellen** (ein Modell ist z.B. Benutzer, Blog-Eintrag, Kategorie, Tag, Bild etc.) bestehen.
* Die Applikation **muss verschiedene Benutzer via Login-Mechanismus unterscheiden.**
* Mein Ziel ist, dass Sie während des Unterrichts jeweils noch Zeit für die Arbeit / Fragen haben.
* Sie dürfen alle Informationen verwenden: Unterrichtsunterlagen, Internet. Bei Unklarheiten oder grösseren Problemen wenden Sie sich an die Lehrperson.

Vorgaben Web-Applikation
---------------------------
* Als Server-Programmiersprache wird **PHP >= 7.4** auf einem **Apache Web Server** via Docker-Container eingesetzt.
* Für das **Frontend** wählen Sie HTML/CSS/JavaScript.
* Als Datenbank wird eine **MySQL-Datenbank** eingesetzt.
* Sie setzen **KEIN PHP-Web-Framework** ein: Sie entwerfen **ein eigenes Web-MVC-Framework**. Die Grundlagen dazu werden in den ersten Unterrichtslektionen erarbeitet.
* Zusätzliche Bibliotheken oder Paket-Manager (z.B. php composer, Template-Engine) dürfen eingesetzt werden.
* Frontend-Bibliotheken / Frameworks (z.B. Bootstrap CSS Framework) sind erlaubt. Das Aussehen / UI-Design wird aber NICHT bewertet.

Abgabe
--------
* Abgabedatum Dokumentation+Code: **18.12.2021** (Vor den Weihnachtsferien)
* Präsentationen: 05.01.2022
* Abgabe-Umfang:
  * **Projekt-Dokumentation** (siehe nachfolgendes Kapitel)
  * **Projekt-Präsentation** inkl. Live-Demo (am 05.01.2022)
    Dauer: 8-15min Vortrag, dann Demo:
    * Vortrag: Kurz-Zusammenfassung des Projektes, wie sind Sie vorgegangen, wichtige Architektur-Entscheide aufzeigen, Security-Massnahmen
    * Demo: Präsentation des Projektes an einem lauffähigen System
  * **Gesamter Quellcode / Datenbank-Schema im git-Repo**:
    * Die gesamte Applikation muss im Github-Classroom-Repo, Main-Branch vorhanden sein.
    * Ein SQL-Dump Ihrer Datenbank muss **zwingend** ebenfalls im Repo vorhanden sein:
      * Dump in `db-init/001_init.sql`
      * Der Dump wird beim ersten Start von MySQL automatisch importiert: Ich erwarte, dass dies OHNE FEHLER durchläuft.
    * Allfällige Konfigurationen (z.B. DB-Parameter, config-Files) müssen ebenfalls im Repo sein, ODER es muss beschrieben werden,
      wo diese anzupassen sind.
    * Ich muss die Applikation durch minimalen Aufand (Repo klonen, Docker starten) zum Laufen bringen können!

**Sie geben alle Teile Ihrer Applikation in Ihrem Github Classroom Repository, Main Branch ab.**

Ich werden Ihr Projekt folgendermassen testen:

```sh
# 1. Klonen Ihres Repositories: (MAIN Branch)
$ git clone https://github.com/pfad/zu/ihrem/repo
$ cd pfad-zum-repo
# 2. Starten aller Dienste:
$ docker-compose up --build
```

Danach muss Ihr Projekt laufen! Das bedingt:

* dass Sie einen sauberen DB-Dump Ihrer DB in `db-init/001_init.sql` erzeugen (siehe `mysqldump`),
  inkl. benötigter MySQL-User!
* dass ALLE benötigen Dateien, inkl. Konfiguration und Docsify-Dokumentation, in Ihrem Repo zu finden sind!

Projekt-Dokumentation
-----------------------

Sie erstellen eine **Projekt-Dokumentation** mit Docsify. Sie können diese Vorlage verwenden.
Ihre Dokumentation muss **mindestens** folgende Kapitel umfassen:

* Titelseite mit: Name, Klasse, Druckdatum, Modul-Name, Projekt-Name
* Pflichtenheft: Ein von Ihnen selbst erstellter Anforderungskatalog. Ich erwarte:
  * eine **Kurzbeschreibung der Applikation**: Beschreiben Sie mir Ihre Idee (ca. 1/2 A4-Seite) in einem "Management Summary".
  * eine Kurzberschreibung von **geplanten Datenmodellen** und wichtigen Eigenschaften (Bsp: "Benutzer mit mind. Username/Passwort")
  * ein **Maskenablauf** resp. Seitenplanung mit der jeweiligen Funktionalität
* Architektur: In diesem Kapitel zeigen Sie die von Ihnen gewählte Architektur auf:
    * Web-Framework: Wie funktioniert Ihr MVC-Framework? Zeigen Sie dies mittels
      geeigneter UML-Diagrammen und Beschreibungen der Funktionsweise. Es muss einem Aussenstehenden klar werden,
      wie Ihr Framework funktioniert (Ablauf vom Request bis zum Generieren einer Antwort).
    * Datenmodell (Datenbank-ERD): Erstellen Sie ein komplettes ERD Ihrer Entitäten und **beschreiben Sie diese**.
    * Klassenmodell (UML):
      * Zeigen Sie die von Ihnen entworfenen Klassen in einem UML-Klassendiagramm.
      * Zeigen Sie eingesetzte Design-Pattern und beschreiben Sie diese.
* Sicherheitskonzepte: Dieses Kapitel zeigt, welche Massnahmen Sie in der Applikation im Bezug auf Datensicherheit, Datenkonsistenz und Datenintegrität getroffen haben, und wie Sie diese umgesetzt haben. Wählen Sie Sicherheitsmassnahmen, die in Ihrer Applikation sinnvoll sind.
  Beschreiben Sie die umgesetzten Massnahmen und illustrieren Sie diese mit Beispielen.
* Testplan, Testprotokoll (inkl. Durchführung und Ergebnis):
  * Erstellen Sie einen Testplan, um die Funktionalität Ihrer Applikation zu testen.
  * Zeigen Sie sinnvolle und komplette Testfälle auf
  * Führen Sie diese durch und protokollieren Sie die Ergebnisse in einem Testprotokoll
* Fazit: Zusammenfassung, persönliche Schlussfolgerungen (ca. 1/2 A4-Seite)
* Quellenverzeichnis

Die Dokumentation soll so ausgeführt werden, dass ein Nicht-eingeweihter (aber technisch versierter) Leser sich ein Bild über Ihr Projekt machen kann.

Benotung
-----------

**Hinweis:** Die detaillierten Bewertungskriterien werden in einem separaten Excel-Dokument ausführlich dargelegt.

* Die Projektarbeit zählt zu 80% zur Modulnote.
* Die Bewertung wird anhand der ICT LBV Modul 151-5 vorgenommen.
* Bewertet wird am Schluss:
  * Dokumentation (40%):
    * Vollständigkeit, Fachliche Richtigkeit
    * Umsetzung/Dokumentation des Web-MVC-Frameworks
    * Sinnvoll gewählte und umgesetzte Sicherheitsmassnahmen
    * Schlüssigkeit (gewählte Kapitel, «Roter Faden»), Orthographie und Rechtschreibung, Formalität
  * Programm/Quellcode (40%)
    * Das Programm ist lauffähig (an Demo gezeigt)
    * Deckt die Anforderungen und Sicherheitsmechanismen aus dem Pflichtenheft ab
    * Der Programmcode deckt sich mit der Dokumentation
    * Der Programmcode wurde vollständig abgeliefert und ist lauffähig
  * Präsentation (20%):
    * Sprachlicher Ausdruck
    * Schlüssiger Ablauf / Erklärungen, «roter Faden» erkennbar
    * Zeigt wichtige / sinnvolle Aspekte der Arbeit bezogen auf das Thema
    * Gute Vorbereitung
    * Zeitrahmen eingehalten (8-15min Präs. + 5min Demo)

