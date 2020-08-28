#! /bin/bash
sudo apt-get update
sudo apt-get install apache2 -y
sudo apt-get install git -y
sudo apt-get install mariadb-server -y
sudo mysql -e "UPDATE mysql.user SET Password = PASSWORD('Ero14a5S') WHERE User = 'root'"
sudo mysql -e "CREATE USER 'server'@'localhost' IDENTIFIED BY 'server';"
sudo mysql -e "GRANT ALL PRIVILEGES ON *.* TO 'server'@'localhost';"
sudo mysql -e "DROP USER ''@'localhost'"
sudo mysql -e "DROP USER ''@'$(hostname)'"
sudo mysql -e "DROP DATABASE test"
sudo mysql -e "CREATE DATABASE loginsystem;"
sudo mysql -e "USE loginsystem;"
sudo mysql -e "CREATE TABLE loginsystem.users (  idUsers INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY , uidUsers TEXT NOT NULL , emailUsers TEXT NOT NULL , isCompany BOOLEAN NOT NULL DEFAULT FALSE , pwdUsers LONGTEXT NOT NULL, logo TEXT NULL, certificatesAv INT NOT NULL DEFAULT 0);"
sudo mysql -e "CREATE TABLE loginsystem.pwdreset ( pwdResetId INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, pwdResetEmail TEXT NOT NULL , pwdResetSelector TEXT NOT NULL , pwdResetToken TEXT NOT NULL , pwdResetExpires INT NOT NULL);"
sudo mysql -e "CREATE DATABASE certificatesdb;"
sudo mysql -e "USE certificatesdb;"
sudo mysql -e "CREATE TABLE certificatesdb.certs( idCerts INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, titleCerts TEXT NOT NULL , userName TEXT NOT NULL, certMail TEXT NOT NULL, issuerCerts INT(11) NOT NULL , userCerts INT(11) NULL , tokenCerts LONGTEXT NOT NULL , claimCerts INT(6) NOT NULL , imageCert TEXT NOT NULL , dateCert TEXT NOT NULL, isClaimed BOOLEAN NOT NULL DEFAULT FALSE);"
sudo mysql -e "CREATE TABLE certificatesdb.certscompany ( certId INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY , titleCerts TEXT NOT NULL , dateCert TEXT NOT NULL , certsCreated INT NULL , certsAssigned INT NULL, issuerCerts INT(11) NOT NULL, issuerName TEXT NOT NULL, emailCert TEXT NOT NULL, gatherType TEXT NOT NULL);"
sudo mysql -e "FLUSH PRIVILEGES"
sudo apt-get install php libapache2-mod-php php-mysql libphp-phpmailer -y
sudo apt-get a2enmod php
sudo apt-get install python3 python3-pip -y
sudo pip3 install pillow qrcode
sudo mkdir /var/www/certdepo
sudo git clone https://github.com/kazp058/CertDepo.git /var/www/certdepo/.
echo "Website installed"
sudo chmod -R 777 /var/www/certdepo
cat >/var/www/certdepo/includes/credentials.php <<"EOF"
<?php
$account = "mail@example.com";
$accountpwd = "password";
$clientId = "ASWTD2lnV8eW6xqTvZU6P2Pro2EbWLSKWiGKe52_FkaYi_-nGpjSyZvqJv4cRFCCAV74GN8jyn5kpKLe";
$secret = "EF-mH2AR5h-S2MpMkrITrz2s2RGvjVK_Z0J1yiCHZEHJV-D0eBisC20FW8ygHln3ygv4gkSL0Ehquovk";
?>
EOF
sudo apt-get install curl php-cli php-mbstring git unzip -y
cd
curl -sS https://getcomposer.org/installer -o composer-setup.php
HASH="$(wget -q -O - https://composer.github.io/installer.sig)"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
cd
sudo mkdir /var/www/certdepo/includes/PHPMailer
cd /var/www/certdepo/includes/PHPMailer
composer require phpmailer/phpmailer
sudo mv /var/www/certdepo/certdepo.conf /etc/apache2/sites-available/certdepo.conf
cd
sudo chmod +x /var/www/certdepo/update.sh
(crontab -l 2>/dev/null; echo "0 * * * * /var/www/certdepo/update.sh -with args") | crontab -
sudo a2ensite certdepo.conf
sudo a2dissite 000-default.conf
sudo systemctl restart apache2
