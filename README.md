# ems
Event Management System
Event Manage System Laravel 8 for backend api and Vue 3 for frontend admin panel.
Requirement for installation and setup
--------------------------------------------------------------------------------------------------
1: for laravel backend you need a apache server setup properly and laravel 8 requirement fullfill.  
---------------------------------------------------------------------------------------------------
2: Please place the code in htdocs both folder backend api and frontend admin place in a single folder
--------------------------------------------------------------------------------------------------
3: Mysql database file import the database and set the database details in .env file  which is placed in laravel backend api folder.
---------------------------------------------------------------------------------------------------
4: For vue3 admin panel setup
You need to install npm globally and vue cli installed globally properly
for vue project configuration you need to go in src folder -> config folder -> constant.js file. In constant.js file APP_URL, IMAGE_URL and THUMB_URL set properly according to url for your admin api.
--------------------------------------------------------------------------------
this is current api url: http://localhost/ems/event-management-api/api/v1/
-----------------------------------------------------------------------------
API_URL = "http://localhost/ems/event-management-api/api/v1/";
---------------------------------------------------------------------------
IMAGE_URL = "http://localhost/ems/event-management-api/public/assets/uploads/images/";
---------------------------------------------------------------------------------------------
THUMB_URL = "http://localhost/ems/event-management-api/public/assets/thumbnails/";
--------------------------------------------------------------------------------------------------
these are the urls set in constants.js file if you change the folder directory structure please set these properly.
--------------------------------------------------------------------------------------------------------------
4: Run the vue3 admin panel on development mode you need to run this command >> npm run serve 
--------------------------------------------------------------------------------------------------------------
If you found any issue to setup this project ask me.
Thanks.
