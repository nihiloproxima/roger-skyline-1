Roger-Skyline
Ou Comment Boire Des Shots Sans Se Salir

PARTIE 1 : Creation de la VM
Créer une machine debian de taille fixe de 8gb

Installer debian

Creer une partition de 4.2Gb (en creation, creer une de 4.501gb), une de 1gb (swap) et une derniere du reste de la taille

/!\ Installer seulement service ssh et usuels

PARTIE 2 : Jusqu'au ssh
apt install -y vim sudo net-tools iptables-persistent fail2ban sendmail apache2

vim /etc/ssh/sshd_config -> modification du port en 2222 + decomenter PasswordAuthentification yes

adduser USER sudo

Arreter la machine

Dans VirtualBox -> selectioner la machine -> network -> adapter2 -> hostonly -> ( vboxnet() : en dhcp )

Redemarrer la machine

vim /etc/network/interfaces

Configurer en dhcp le enp0s8

ifconfig -> recuperer IP

vim /etc/network/interfaces

Modification de enp0s8

dhcp -> static
address <adresse recupérée>
netmask 255.255.255.252
reboot

Sur iterm -> ssh_keygen -> copier .ssh/id_rsa.pub

ssh user@IPMACHINE -p 2222
mkdir .ssh
cd .ssh
echo "CE QUI EST COPIÉ" > authorized_keys
vim /etc/ssh/sshd_config -> * PasswordAuthentification no *
Redemarrer la machine, dans Virtualbox -> file -> host.... -> decocher DHCP

PARTIE 3 : Firewall
iptables -L
Ajouter fichier /etc/network/if-pre-up.d/iptables

Dans ce fichier :

#!/bin/bash

iptables-restore < /etc/iptables.test.rules

iptables -F
iptables -X
iptables -t nat -F
iptables -t nat -X
iptables -t mangle -F
iptables -t mangle -X

iptables -P INPUT DROP

iptables -P OUTPUT DROP

iptables -P FORWARD DROP

iptables -A INPUT -m conntrack --ctstate ESTABLISHED,RELATED -j ACCEPT

iptables -A INPUT -p tcp -i enp0s8 --dport 2222 -j ACCEPT

iptables -A INPUT -p tcp -i enp0s8 --dport 80 -j ACCEPT

iptables -A INPUT -p tcp -i enp0s8 --dport 443 -j ACCEPT

iptables -A OUTPUT -m conntrack ! --ctstate INVALID -j ACCEPT

iptables -I INPUT -i lo -j ACCEPT

iptables -A INPUT -j LOG

iptables -A FORWARD -j LOG

iptables -I INPUT -p tcp --dport 80 -m connlimit --connlimit-above 10 --connlimit-mask 20 -j DROP

exit 0
chmod+x sur ce fichier

PARTIE 4 : DOS
sudo touch /var/log/apache2/server.log
vim /etc/fail2ban/jail.local

[DEFAULT]
destemail = USER@student.le-101.fr
sender = root@roger-skyline.fr

[sshd]
port = 2222
enabled = true
maxretry = 5
findtime = 120
bantime = 60

[sshd-ddos]
port = 2222
enabled = true

[recidive]
enabled = true

[apache]
enabled = true
port = http, https
filter = apache-auth
logpath = /var/log/apache2*/*error.log
maxretry = 6
findtime = 600

[apache-noscript]
enabled = true

[apache-overflows]

enabled  = true
port     = http,https
filter   = apache-overflows
logpath  = /var/log/apache2*/*error.log
maxretry = 2

[apache-badbots]

enabled  = true
port     = http,https
filter   = apache-badbots
logpath  = /var/log/apache2*/*error.log
maxretry = 2

[http-get-dos]
enabled = true
port = http,https
filter = http-get-dos
logpath = /var/log/apache2/server.log
maxretry = 100
findtime = 300
bantime = 300
action = iptables[name=HTTP, port=http, protocol=tcp]

Puis créer le fichier suivant :

sudo vim /etc/fail2ban/filter.d/http-get-dos.conf et y mettre le contenu suivant :

[Definition]

# Option: failregex
# Note: This regex will match any GET entry in your logs, so basically all valid and not valid entries are a match.
# You should set up in the jail.conf file, the maxretry and findtime carefully in order to avoid false positives.

failregex = ^<HOST> -.*"(GET|POST).*

# Option: ignoreregex
# Notes.: regex to ignore. If this regex matches, the line is ignored.
# Values: TEXT
#
ignoreregex =
Relancer le service fail2ban : sudo systemctl restart fail2ban.service

Si pas d'erreur, tout va bien, un iptables -L liste désormais toutes les règles activées.

PARTIE 5 : scan des ports
Fait automatiquement par le Firewall -> seul les ports ssh et web sont visibles

PARTIE 6 : services inutiles
service --status-all

apt remove <services inutiles>

systemctl list-unit-files

systemctl disable <services inutiles>
PARTIE 7 : script d'update
vim /home/USER/update_script.sh

#! /bin/bash
apt-get update && apt-get upgrade
chmod +x update_script.sh

vim crontab (dans /etc) et ajouter avant le dernier #

0 4	* * 1	root	/home/USER/update_script.sh  >> /var/log/update_script.log
@reboot	root	/home/USER/update_script.sh  >> /var/log/update_script.log
PARTIE 8 : Script de surveillance
cp /etc/crontab /home/USER/tmp

vim /home/USER/email.txt Remplir le contenu du fichier email.txt avec le message que vous souhaitez

vim /home/USER/watch_script.sh

#!/bin/bash
cat /etc/crontab > /home/USER/new
DIFF=$(diff new tmp)
if [ "$DIFF" != "" ]; then
	sudo sendmail ROOT@MAIL.com < /home/USER/email.txt
	rm -rf /home/USER/tmp
	cp /home/USER/new /home/USER/tmp
fi
chmod +x watch_script.sh

vim /etc/crontab -> ajouter avant le dernier #

0  0	* * *	root	/home/USER/watch_script.sh
PARTIE 9 : Partie web
Générer une clé SSL :

sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/roger-skyline.com.key -out /etc/ssl/certs/roger-skyline.com.crt
Rentrer les infos quand demandées.

Puis : sudo vim /etc/apache2/sites-available/default-ssl.conf

Et modifier uniquement les lignes SSL en renseignant le bon chemin des clés :

<IfModule mod_ssl.c>
 <VirtualHost _default_:443>       
                ServerAdmin webmaster@localhost
                DocumentRoot /var/www/html

                ErrorLog ${APACHE_LOG_DIR}/error.log
                CustomLog ${APACHE_LOG_DIR}/access.log combined

                #Include conf-available/serve-cgi-bin.conf

                #   SSL Engine Switch:
                #   Enable/Disable SSL for this virtual host.
                SSLEngine on
                SSLCertificateFile      /etc/ssl/certs/roger-skyline.com.crt
                SSLCertificateKeyFile /etc/ssl/private/roger-skyline.com.key
                #
                #SSLCertificateFile      /etc/ssl/certs/ssl-cert-snakeoil.pem
                #SSLCertificateKeyFile /etc/ssl/private/ssl-cert-snakeoil.key

......................
.......................

 </VirtualHost>
</IfModule>
Puis tester les commandes suivantes :

sudo apachectl configtest
sudo a2enmod ssl
sudo a2ensite default-ssl
Si pas de message d'erreur, on peut redémarrer le service : sudo systemctl restart apache2.service

Dans ce fichier, modifier le document root vers /var/www/site

a2dissite 000-default.conf
a2ensite 001-site.conf
systemctl reload apache2
Le site sera accessible sur votre IP (https://192.168.56.3), c'est un certificat auto signé donc le navigateur met une alerte, c'est normal !

Vous pouvez mettre les fichiers de votre site dans le dossier /var/www/html !

PARTIE 10 : Partie deploiement
SWAG IT PUSH
