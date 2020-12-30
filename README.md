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
| jQuery        | 3.4.1         |
| TinyMCE       | 5.4.1         |
| Bootstrap     | 4.5.2         |

## Product
* **Started:** 16.01.2020
* **Author:** Serhiy Bolkun
* **Architecture:** MVC
* Made in Germany

## Development
* Install [XAMPP](https://www.apachefriends.org/download.html) to test locally
<details>
    <summary>Configure <b>mailer</b></summary>
    <p>Open <b>C:\xampp\php\php.ini</b> and set <b>sendmail_path="C:\xampp\sendmail\sendmail.exe -t"</b></p>
    <p>Open <b>C:\xampp\sendmail\sendmail.ini</b> and set <b>smtp_server=smtp.gmail.com</b>, <b>smtp_port=587</b>, 
        <b>auth_username=mustermann@gmail.com</b>, <b>auth_password=123</b></p>
</details>
<details>
    <summary>Check <b>other</b> configurations</summary>
    <p>Open <b>C:\xampp\php\php.ini</b> and set <b>file_uploads=On</b>, <b>upload_max_filesize=40M</b></p>
</details>
<details>
   <summary>Configure <b>mysql</b></summary>
   <p>Open <b>C:\xampp\mysql\bin\my.ini</b> and set <b>max_allowed_packet = 4G</b> or smaller</p>
</details>
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
coming soon ...

## Versioning
New versions will be stored at [GIT](https://github.com/Bolkun/bolkun) and can be only available after purchasing a new
license.

## Commercial License
* Licenses are purchased by interested individuals or the company and can be used by any single person within this 
organization. 
* You can’t re-sell or re-distribute this project.

