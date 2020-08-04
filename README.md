# Automail Online
Website design for hosting a certficicates management system, this site helps keeping a record of certificates generated and send them throught email.

## Instructions for use
1. Create inside **includes** folder a file named **credentials.php**, make sure to put in here these following variables:
```php
<?php
   $account = "youremail@example.com";
   $accountpwd = "yourpassword";
```

## MySQLi
MySQLi added to the root user
### Databases
| Name|Description|
|---|---|
|loginsystem|Contains tables related to the login system and password recovery|
|certificatesdb|Contains tables related to the certificate system and all types of surveys|
