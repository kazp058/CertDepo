# Automail Online
Website design for hosting a certficicates management system, this site helps keeping a record of certificates generated and send them throught email, the system generates a unique key to every certificate generated.

## Server information
The server is running with a LAMP server.

## Instructions for use
1. Create inside **includes** folder a file named **credentials.php**, make sure to put in here these following variables:
```php
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
```mysql
CREATE DATABASE db_name;
```

## Tables in loginsystem
|Name|Description|
|---|---|
|users|Contains information of the user, all data that is collected from the registry|
|pwdReset|Contains temporary information for the password recovery system|

### users Table

Creation command:
```mysql
CREATE TABLE users ( idUsers INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY , uidUsers TEXT NOT NULL , emailUsers TEXT NOT NULL , isCompany BOOLEAN NOT NULL DEFAULT FALSE , pwdUsers LONGTEXT NOT NULL, logo TEXT NULL, assignedCerts JSON NOT NULL , madeCerts JSON NOT NULL)
```

|Field name|Description|Data type|
|---|---|---|
|idUsers|Incremental index|integer|
|uidUsers|The name of the user|string|
|emailUsers|Email of the user|string|
|pwdUsers|Password of the user encrypted|long string|
|isCompany|Byte to determine is it is a company or not|Byte|

### pwdReset Table
|Field name|Description|Data type|
|---|---|---|
|pwdResetId|Id of the current session|integer|
|pwdResetEmail|Email where the token hasa been sended|string|
|pwdResetSelector|Validator for the token and the reset session|string|
|pwdResetToken|Token that the user recieves in the email|string|
|pwdResetExpires|Date that determines when it expires|integer|

## Tables in certificatesdb

