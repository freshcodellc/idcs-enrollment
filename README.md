# See Your Score

Laravel application for Credit Reporting and Scores

#### Initial Setup
1. Clone the repo

2. Ensure that `mod_rewrite` is enabled so the `.htaccess` file will be honored.

3. Directories within the `storage` and the `bootstrap/cache` directories should be writable by your web server or Laravel will not run.

4. From the base directory, run `composer install` from command line.

5. Create a database to be used for the application

6. Copy the `.env.example` file in the base directory and create a `.env` file with the necessary configuration details, including DB credentials

7. If the application key has not been set in the .env file, you can generate one by running `php artisan key:generate` from command line.

8. Get the latest database migrations by running `php artisan migrate` from command line.
