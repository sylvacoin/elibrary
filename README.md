# Elibrary system.

An elibrary system is an automated library management system that enables automates the problems of normal library system which
includes sorting and classifying books for librarians. It makes use of a data sieving algorithm to analyse books and determine the
type of book based on a specific set of rules indicated in the dictionary by the developer.

# Features
1. Auto sort and add author and edition of books on book upload
1. QRcode login system for students and admin
1. Ability for students to share books and mark books as favorites.
1. Ability to add friends
    
# How to install
1. In your local server visit loaclhost/phpmyadmin
1. import database `ci_elib.sql`. A database will be created with default user details.
1. Copy the extracted file to htdocs if you using xampp or www
1. Open `htdocs/elibrary/applications/config/database.php`
1. Update database settings if yours is passworded
1. Visit `http://localhost/elibrary/`

# User Log in details

administrator:
   email: `admin@admin.com`
   password: `admin`

User create an account
