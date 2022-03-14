# Blog

Features
Login,register,logout
Blogs
Comments
Role Based Access
Laravel Migrations
Simple & Minimal UI Design

Tech

Bootstrap 4 - great UI 
Laravel 7 - Framework for Web Artisans
FontAwesome - Design icons 
TinyMCE - WYSIWYG rich text editor


Installation Guide
git clone -https://github.com/sdharmi19/Blog.git
cd blog
composer install
rename .env.example to .env
php artisan key:generate
Edit file config/app.php & .env - and set your correct app url
Edit file config/database.php - and set your DB connection details
php artisan migrate 

when any user register and login into web than they are able to create, edit ,delete, comment on  their post , Guest user can't perform any action ,In this project need to implement status like private and public only public post show in home page , also put the like ,share, favourite functionalities .I spent 8 hours to complete this task and in this task Tags functionality is pending


