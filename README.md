osf-rss
=======
The user will be able to have access to application only if he/she has an account. I developed a page which 
allows the user to register, in order to achieve the things mentioned above.

After logging in, the user has the possibility of editing his/her account (name, password, etc) and 
the possibility to manage the RSS sources - change, add or delete an unlimited number of RSS sources.

The main page contains the favorite RSS. 

The lists of feeds that are long are paginated.  

The user can set a RSS as “read” or “unread”.

Installation
=======
- Git clone the repository
- mod_rewrite should be enabled (if not use index.php in URL)
- configure your database settings in application/database.php (database will attempt to autocreate on first run )
- admin section available in base_url/admin
- the login data is: admin: admin
                     password: 123456   
