Installationsanleitung:

xampp install https://www.apachefriends.org/download.html mit Php Version 8.2.0 auswählen

composer installieren https://getcomposer.org/download/ (Ohne Proxy, Es muss die Php.exe aus C:\xampp\php\php.exe genommen werden)

git repo in xampp ordner ziehen C:\xampp\htdocs

Hosts Datei bearbeiten, die Datei muss als Administrator geöffnet werden: C:/Windows/System32/drivers/etc/hosts
-diese Zeilen hinzufügen: 
127.0.0.1	localhost
127.0.0.1	PROJECT_NAME.test

httpd-vhosts.conf bearbeiten: C:/xampp/apache/conf/extra/httpd-vhosts.conf
-diese Zeilen hinzufügen:
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs"
    ServerName localhost
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/IBSupermarkt/public"
    ServerName ibsupermarkt.test
 </VirtualHost>
(laravel anleitung https://gist.github.com/bradtraversy/7485f928e3e8f08ee6bccbe0a681a821)

Tjade Datei aus Teams runterladen und in C: speichern (Datei heißt Oracle Instantclient)
Pfad der Datei in Systemumgebungsvariablen → Umgebungsvariablen unter PATH eintragen

extension=oci8_19  ; Use with Oracle Database 19 Instant Client → Semikolon entfernen in "C:\xampp\php\php.ini"
"composer install" in cmd C:\xampp\htdocs\ibsupermarkt
