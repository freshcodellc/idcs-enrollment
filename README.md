# See Your Score

Laravel application for Credit Reporting and Scores

####Initial Setup
1. Clone the repo

2. Ensure that `mod_rewrite` is enabled so the `.htaccess` file will be honored.

3. From the base directory, run `composer install` from command line.

4. Create a database to be used for the application

5. Copy the `.env.example` file in the base directory and create a `.env` file with the necessary configuration details, including DB credentials

6. If the application key has not been set in the .env file, you can generate one by running `php artisan key:generate` from command line.

6. Get the latest database migrations by running `php artisan migrate` from command line.
