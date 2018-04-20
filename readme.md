# Chicopee Asset System

A standalone system to mangage Chicopee's Assets.

## Laravel Setup

PHP version needed is v5.6


Copy & rename the **.env.example** file to **.env** and update the database settings to the specific ones of the current environment along with the **APP_URL** variable to the dev/live url e.g. ```APP_URL=http://chicopee-asset-system.dev```. The .env file is not committed to version control and will need to be reproduced on the live server with all the live site settings.

For testing email locally either change the mail driver to log e.g. ```MAIL_DRIVER=log``` which will write to the local log file (```storage/laravel.log```) that an email has been sent or use something like [Mailtrap](https://mailtrap.io/) and enter your API details into the ```MAIL_USERNAME``` & ```MAIL_PASSWORD``` variables.

Run ```php artisan key:generate``` which will update the **APP_KEY** .env variable.

Run ```composer install``` which will install all required PHP libraries.

Run ```php artisan migrate``` which will create all the database tables. This will need to be ran after every pull incase there have been any database changes.
