BCCI
Hello fellow developers!

### Building for development
First you must clone the repository.
-       git clone https://github.com/Dev-Wave-PH/bcci-dtr.git

Change directory to **bcci-dtr** folder.
Create a copy of **.env.example** and rename it to **.env**

Run the composer command (be sure that composer is installed in your machine)
-       composer install
This command will install the dependencies for development and production.

Run generate APP key
-       php artisan key:generate


### Migrating the database
First configure the database. You can find the credentials in **.env** file.
-     DB_CONNECTION=mysql
-     DB_HOST=127.0.0.1
-     DB_PORT=3306
-     DB_DATABASE=bcci_dtr
-     DB_USERNAME=root
-     DB_PASSWORD=

Create database in your mysql server, named it **bcci_dtr**. (Database name should be the same as the DB_DATABASE value of your .env)

Run command
-       php artisan migrate:fresh --seed
This will also migrate dummy data.

Note: Make sure the **bcci_dtr** app is inside the htdocs or www of your apache server.
--------------------
