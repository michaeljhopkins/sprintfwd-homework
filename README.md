Provided in Laravel's Jetstream is all the functionality for user and team management as well as all the necessary tests. I wrote a second set of controllers for the api endpoints (linked below) and a handful of additional tests. Additionally added is a github action that automatically creates PR's with code formatting and linting fixes when new PR's are merged in. There is also a postman collection at `./postman_collection.json` for ease of testing. To get that working see the below

### Exit Criteria

- API Endpoints to: Create/Update/Delete/Index/Show teams [link](https://github.com/michaeljhopkins/sprintfwd-homework/blob/main/app/Http/Controllers/Api/TeamsController.php)
- API Endpoints to: Create/Update/Delete/Index/Show members [link](https://github.com/michaeljhopkins/sprintfwd-homework/blob/main/app/Http/Controllers/Api/UsersController.php)
- API Endpoints to: Create/Update/Delete/Index/Show projects [link](https://github.com/michaeljhopkins/sprintfwd-homework/blob/main/app/Http/Controllers/Api/ProjectsController.php)
- API Endpoint to: Update the team of a member [link](https://github.com/michaeljhopkins/sprintfwd-homework/blob/main/app/Http/Controllers/Api/TeamUsersController.php)
- API Endpoint to: Get the members of a specific team [link](https://github.com/michaeljhopkins/sprintfwd-homework/blob/main/app/Http/Controllers/Api/TeamUsersController.php)
- API Endpoint to: Add a member to a project [link](https://github.com/michaeljhopkins/sprintfwd-homework/blob/main/app/Http/Controllers/Api/ProjectUsersController.php)
- API Endpoint to: Get the members of a specific project [link](https://github.com/michaeljhopkins/sprintfwd-homework/blob/main/app/Http/Controllers/Api/ProjectUsersController.php)
- Commit the code to a public GitHub repo for the SprintFWD team to assess. Thank you!

### Bonus

- Add tests [link](https://github.com/michaeljhopkins/sprintfwd-homework/tree/main/tests/Feature)
- Basic UI for the exit criteria above with laravel views [link](https://github.com/michaeljhopkins/sprintfwd-homework/blob/main/resources/views/livewire/user-project-manager.blade.php)
  - I created the frontend functionality for creating, viewing, and deleting a project as a demonstration of Livewire competency


```
# Edit the below file with database info
cp .env.example .env

mysql -uUSER -p;
create database DATABASENAMEHERE;
exit

composer install

# Copy the token that is kicked out by the seeders
php artisan migrate:fresh --seed

npm install
npm run dev
# Copy the below url for "host"
php artisan serve
```

In postman import the json file in this repo. Then click on the collection and go to variables. Paste in the token and update your host to the value from `php artisan serve`

<img src="https://i.imgur.com/wAo3eqt.png">
