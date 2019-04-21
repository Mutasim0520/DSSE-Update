<h1>The Project</h1>
<p>
DSSE is a website of a research groups (Distributed System and Software Engineering) of the University of Dhaka to showcase all their projects, research works, members and their profile. 
</p>
## Instruction
php, XAMPP and Composer should be installed in you machine. To run the project in your local server follow the following steps.
<ol>
  <li>
  Start your local server from XAMPP Control Panel  
  </li>
  <li>
   Create a database as stated in the .env file of <b>"pustokbd repository"</b>. This file contains some data paired in key value. Find the key <b>"DB_DATABASE"</b>. It's value is the name of database.
  </li>
    <li>
      Go to your local directory where you have the project and open a command prompt in the directory.
  </li>
    <li>
  Run the following command in the command prompt <b>php artisan migarte</b>. Wait some moments to get the success message. 
  </li>
    <li>
  Run the following command in the command prompt <b>composer dump-autoload</b> 
  </li>
    <li>
  Run the following command in the command prompt <b>php artisan db:seed</b> 
  </li>
    <li>
  Run the following command in the command prompt <b>php artisan serve</b>. After this command you will ge a message "Laravel development server started:<http://127.0.0.1:8000>". Open this link in the server. Now you are ready to explore the app. For accessing to the admin panel go to the link "<http://127.0.0.1:8000/admin/login>". The email is "admin@gmail.com" and password is"654321" for admin panel.
  </li>
</ol>

