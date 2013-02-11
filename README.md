osf-rss
=======
The user will be able to have access to application only if he/she has an account. You have to develop a page which 
allows the user to register, in order to achieve the things mentioned above.

After logging in, the user has to have the possibility of editing his/her account (name, password, etc) and 
the possibility to manage the RSS sources - change, add or delete an unlimited number of RSS sources.

The main page should contain the RSS, depending on the selected source. The user has the possibility to set 
certain RSS sources as favourite and those can become afterward as default.  

The lists of feeds that are long will be paginated.  

The user can set a RSS as “read” or “unread” and he/she also can organize and display the feeds by these criteria.

Installation
=======
- Git clone the repository
- mod_rewrite should be enabled (if not use index.php in URL)
- configure your database settings in application/database.php (database will attempt to autocreate on first run )

Notes
=======
- this is a work in progress, not all features are completed. 