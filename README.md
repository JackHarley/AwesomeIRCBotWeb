# Awesome IRC Bot Web  
Web GUI for AwesomeIRCBot  
Created by Jack Harley

Introduction
------------
Awesome IRC Bot Web is a graphical web interface for Awesome IRC Bot.
Some features it provides:

* Browse and download logs
* View an overview of the channel including online users and latest messages and actions
* View detailed statistics about the channel
* Channel leaderboards so you can see who chats the most
* Webchat

Prerequisites
-------------
* PHP 5.3+
* The PHP5 Memcached extension and libmemecached (apt-get install php5-memcached libmemcached)
* SQLite and the SQLite PDO extension (apt-get install php5-sqlite)
* Awesome IRC Bot

Installation
-----------
1. Copy all the files to your web server
2. CHMOD 777 the /cache and /log folder
3. Rename config/config.ini.php.example to config/config.ini.php and edit
4. Load up the site to test it's working, if you need help, open a GitHub Issue.

Legal
-------------
By using Awesome IRC Bot Web, you agree to the license in LICENSE.md