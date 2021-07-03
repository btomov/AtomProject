- Installation:
- Requires PHP 7.3 or higher, MySQL & composer
- Create a DB in MySQL (copy over .env and change the DB details accordingly)
- Install the composer packages (php composer.phar install)
- Install the npm packages & compile the CSS (npm install && npm run dev)
- Run the migrations (requires an active DB connection) - php artisan migrate (Possible issue #1)
- Start the server with php artisan serve . It should run on http://127.0.0.1:8000


Potential installation issues: 

#1: PDOException::("SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes")
    
Solution: https://stackoverflow.com/a/42245921
