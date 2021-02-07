# bolkun
Nowadays there are a lot of CMS written in php. During my research I could not find the perfect one, 
which will cover all my needs. This project is simple coded and easy understood with minimum knowledge of
programming languages. It has only features, which really useful and needed by the customer. 
That's why a great attention was paid for performance, speed and security. Easy to install, 
minimum changes by configuration and that's it!

## Built With
| Name          | Version       |
| ------------- | ------------- |
| Google Chrome | 87.0.4280.88  |
| XAMPP         | 7.2.31        |
| PHP           | 7.3.8 - 8     |
| MySQL         | 5.7           |
| jQuery        | 3.5.1         |
| TinyMCE       | 5.4.1         |
| Bootstrap     | 4.5.2         |

## Product
* **Started:** 16.01.2020
* **Author:** Serhiy Bolkun
* **Architecture:** MVC
* Made in Germany

## Development
* Install [XAMPP](https://www.apachefriends.org/download.html) to test locally
    * Configure **mailer**
        * Open **C:\xampp\php\php.ini** 
            * Set **sendmail_path="C:\xampp\sendmail\sendmail.exe -t"**
        * Open **C:\xampp\sendmail\sendmail.ini**
            * Set **smtp_server=smtp.gmail.com**
            * Set **smtp_port=587** 
            * Set your own gmail address **auth_username=mustermann@gmail.com**
            * Set your own gmail password **auth_password=123**
    * Check **other** php.ini configurations
        * **file_uploads=On**
        * **upload_max_filesize=40M**
    * Configure **mysql**
        * Open **C:\xampp\mysql\bin\my.ini**
            * Set **max_allowed_packet=4G** or smaller, used in mysql table
            "blog" to store longblob format in column "content"
    * Restart XAMPP  
* Install [Git](https://git-scm.com/downloads) and clone project with (`git clone https://github.com/Bolkun/bolkun.git`)
    to **C:\xampp\htdocs**
* Open [Google Chrome](https://www.google.com/chrome/) and go to [phpMyAdmin](http://localhost/phpmyadmin)
* Create new database with name **bolkun** and charset **utf8_general_ci**
* Open file **bolkun/app/development/bolkun.sql** and set **time_zone** (default Berlin). Copy content of the file and 
    execute it in [phpMyAdmin](http://localhost/phpmyadmin/db_sql.php?db=bolkun)
* Open link [bolkun](http://localhost/bolkun/) and process the registration form
* Open [phpMyAdmin](http://localhost/phpmyadmin/sql.php?server=1&db=bolkun&table=user&pos=0) and set in table **user**
    column **role=Admin** to give admin privilege to your account
* You are ready to login and run the tests  

## Running The Tests
* Log in as an admin to [bolkun](http://localhost/bolkun/)
* Open link [Tests](http://localhost/bolkun/index/tests)
* Select a specific test by clicking on a link

## Deployment
* Check server configuration like in Development XAMPP
* Create new database with name **bolkun** and charset **utf8_general_ci**
* Open file **bolkun/app/development/bolkun.sql** and set **time_zone** (default Berlin). Copy content of the file and 
      execute it in phpMyAdmin
* Copy project to server
    * Open **bolkun/app/config/config.php** and go through comments with *
        * pass*
        * url root*
* Open project link and process the registration form
    * If fails, than configure **mail sender** on your host
* Test creating new article
    * test uploading local image

## Database migration
* Export in utf-8 in file.sql
* Open Notepad++ - Encoding - ANSI
* Copy content of a file and paste it in phpMyAdmin tab SQL
* Run the process
* **Now chars like äöüß in main menu title will properly set**

## Versioning
New versions will be stored at [GIT](https://github.com/Bolkun/bolkun) and can be only available after purchasing a new
license.

## Commercial License
* Licenses are purchased by interested individuals or the company and can be used by any single person within this 
organization. 
* You can’t re-sell or re-distribute this project.

