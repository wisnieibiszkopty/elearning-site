final project created for classes at the university using Laravel.

Rember to run Apache and mysql servers, and make sure that you have database called 'e-learning'. After that run: 
```bash
npm run dev
```
or
```bash
yarn dev
```
```bash
php artisan storage:link
```
to link public and storage directories
```
php artisan db:seed
```
to add example data to database

and
```bash
php artisan migrate
```
to create all tables in that database.

To serve app go to project directory and run: 
```bash
yarn dev
```
```bash
php artisan serve
```

Then enter [http://127.0.0.1:8000/](http://127.0.0.1:8000/)
