# imageContestWorkshop

## requirements:<br>
	1- php 5.5.9.<br>
	2- write/read permisions to storage and database folders.<br>

## how to install:<br>
	  1-create database named workshop.<br>
	  2-import the db_workshop.sql file in phpmyadmin.<br>
	  3-copy the project folder to server root folder (ex: htdocs if using xamp www if using lamp).<br>
	  4-navigate in the browser to the project location.<br>
	  5-for entering /admin page you could use these caredtinals.<br>
		email: admin@admin.com password: 123456.<br>
## important paths:<br>
	  (/):the main page with listing images upload by the users.<br>
	  (/topusers): top users with highest likes.<br>
	  (/admin): very simple page for admin to approve and disapproe images.<br>
	  (/api/documenation): ui documentaion for the all available web services.<br>
	  (/docs): documentaion in json format for the all available web services.<br>
	  
## TODO:<br>
	-move all common logic from admin.js and scripts.js to common.js
