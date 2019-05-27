****Basic Laravel Form Page:****<br>
Contains a form with 3 fields (Name,E-mail,Pincode)<br>
**Validations added:**<br>
E-mail is checked for unique<br>
Pincode for 6 digits<br>
Any field cannot be submitted empty<br>
Currently configured to work with Xampp+Mysql<br>
DB_NAME=formpagewebsite<br>
Add your database details in .env file for username,password,port etc.<br>
Migration file create_form_data_table creates the required table<br>
**Run Commands**-<br> 
php artisan migrate<br>
php artisan serve<br>
Demo link- https://lit-oasis-61240.herokuapp.com/ <br>
