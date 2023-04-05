# XM Test Task!!!

## Implementation details
1. Laravel v10.4.1 is used
2. PHP v8.1.16 is used
3. Solution is contained in `src` folder.
4. This is fully working containerized environment with nginx, php-fpm, and mailhog containers.
5. Solution is executable via docker composer.
6. Solution is testable via phpunit.


## Deployment instructions
1. Docker Desktop is required (please note that this was tested only on Mac).
2. Download source code and go to the root directory.
3. Execute `./local.sh start`. It may take some time to execute.
4. Access http://localhost:8198/
5. Access http://localhost:8025/ for MailHog (all emails will be visible there).
6. Execute `./local.sh test` to execute tests.
7. Execute `./local.sh stop` to delete and clean up.

## Important Project Files are
1. `sr/app/Xm/` folder
2. `src/app/Http/Controllers/Controller.php`
3. `src/app/Http/Requests/HistoryGetRequest.php`
4. `src/app/Mail/HistoryRequest.php`
5. `src/app/Providers/AppServiceProvider.php`
6. `src/config/app.php`
7. `src/resources/views/` folder
8. `src/routes/web.php`
9. `src/tests/Unit` folder
