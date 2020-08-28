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
sudo mkdir /var/www/certdepo
sudo cd /var/wwww/certdepo
sudo git clone https://github.com/kazp058/CertDepo.git /var/www/certdepo/.
sudo chmod -R 777 /var/www/certdepo
sudo cd
sudo mv /var/wwww/certdepo.com.conf /etc/sites-enable/certdepo.conf
sudo a2ensite certdepo.conf
sudo a2dissite 000-default.conf
sudo systemctl restart apache2
