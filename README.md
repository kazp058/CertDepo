# Automail Online

Website design for hosting a certficicates management system, this site helps keeping a record of certificates generated and send them throught email, the system generates a unique key to every certificate generated.

## Server information

The server is running with a LAMP server.

## Instructions for use

1. Create inside **includes** folder a file named **credentials.php**, make sure to put in here these following variables:

``` php
<?php
   $account = "youremail@example.com";
   $accountpwd = "yourpassword";
```

## MySQLi

MySQLi added to the root user.

### Databases

| Name|Description|
|---|---|
|loginsystem|Contains tables related to the login system and password recovery|
|certificatesdb|Contains tables related to the certificate system and all types of surveys|

In order to add this databases you can use the command:

``` mysql
CREATE DATABASE db_name;
```

## Tables in loginsystem

|Name|Description|
|---|---|
|users|Contains information of the user, all data that is collected from the registry|
|pwdReset|Contains temporary information for the password recovery system|

### users Table

Creation command:

``` mysql
CREATE TABLE users ( idUsers INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY , uidUsers TEXT NOT NULL , emailUsers TEXT NOT NULL , isCompany BOOLEAN NOT NULL DEFAULT FALSE , pwdUsers LONGTEXT NOT NULL, logo TEXT NULL, assignedCerts JSON NOT NULL , madeCerts JSON NOT NULL, certificatesAv INT NOT NULL DEFAULT 0);
```

|Field name|Description|Data type|
|---|---|---|
|idUsers|Incremental index|integer|
|uidUsers|The name of the user|string|
|emailUsers|Email of the user|string|
|pwdUsers|Password of the user encrypted|long string|
|isCompany|Byte to determine is it is a company or not|Byte|

### pwdReset Table

Creation command:

``` mysql
CREATE TABLE pwdreset ( pwdResetId INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, pwdResetEmail TEXT NOT NULL , pwdResetSelector TEXT NOT NULL , pwdResetToken TEXT NOT NULL , pwdResetExpires INT NOT NULL);
```

|Field name|Description|Data type|
|---|---|---|
|pwdResetId|Id of the current session|integer|
|pwdResetEmail|Email where the token hasa been sended|string|
|pwdResetSelector|Validator for the token and the reset session|string|
|pwdResetToken|Token that the user recieves in the email|string|
|pwdResetExpires|Date that determines when it expires|integer|

## Tables in certificatesdb

|Name|Description|
|---|---|
|certs|Contains information of every certificate registered by the system|

### certs

``` mysql
CREATE TABLE certs( idCerts INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, titleCerts TEXT NOT NULL , userName TEXT NOT NULL, certMail TEXT NOT NULL, issuerCerts INT(11) NOT NULL , userCerts INT(11) NULL , tokenCerts LONGTEXT NOT NULL , claimCerts INT(6) NOT NULL , imageCert TEXT NOT NULL , dateCert TEXT NOT NULL, isClaimed BOOLEAN NOT NULL DEFAULT FALSE);
```

|Field name|Description|Data type|
|---|---|---|
|idCerts|Id of the current certificate|integer|
|titleCerts|Title of the certificate|string|
|issuerCerts|id of the certificate issuer|integer|
|issuerCerts|id of the user that claimed the certificate|integer|
|tokenCerts|Token that validates the certificate|string|
|claimCerts|Code that allows to user to claim a certificate|integer|
|imageCert|Certificate Template|string|
|dateCert|Date of the emission|integer|
|isClaimed|Tells if the certificate is claimed by an account|boolean|

### certsCompany

``` mysql
CREATE TABLE certscompany( certId INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY , titleCerts TEXT NOT NULL , dateCert TEXT NOT NULL , certsCreated INT NULL , certsAssigned INT NULL, issuerCerts INT(11) NOT NULL, issuerName TEXT NOT NULL, emailCert TEXT NOT NULL, gatherType TEXT NOT NULL);
```

|Field name|Description|Data type|
|---|---|---|
|certId|Id of the current certificate group|integer|
|titleCerts|Title of the certificate group|string|
|dateCert|Date of the emission|integer|
|certsCreated|certificates created|integer|
|certsAssigned|Number of certificates assigned to the group|integer|
|issuerCerts|Id of the company that created the group|integer|
