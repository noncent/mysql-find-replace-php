# MySQL Search & Replace Tool

Find and replace a string in your entire MySQL database using this PHP script or PHP class. You can utilize it either as a class or via an HTML form.

## AUTHOR INFO

- Original PHP script by Mark Jackson [@MJDIGITAL](http://www.mjdigital.co.uk/blog)
- Front end markup, CSS, and additional PHP by Eric Amundson [@sewmyheadon](http://sewmyheadon.com)
- Update from MySQL to MySQLi by Neeraj Singh [@neerajsinghsonu](https://github.com/neerajsinghsonu/MySQL-Search-Replace-PHP)

## WHAT DOES THIS SCRIPT DO?

This MySQL Search & Replace tool provides an easy way to search an existing MySQL database for any string and, if you wish, replace it with another string.

## WHY WOULD I NEED THIS?

There are several reasons to use this tool. It's particularly handy for replacing strings when migrating MySQL databases from one server to another. This is especially helpful for large WordPress databases that are cumbersome when exported to a .sql file and opened in a text editor.

## WHERE SHOULD I PUT THE SCRIPT?

To use this tool, you'll need to place it either on the server that contains the database you need to search or, if you're using it remotely, ensure you have remote access to the database.

## HOW DO I USE MySQL SEARCH & REPLACE?

It's straightforward:

1. Copy the "MySQL-Search-Replace" folder to a directory on your web server.

2. Open a browser and navigate to the "MySQL-Search-Replace" folder. You'll find a form containing all the fields needed to search for, or search and replace, strings in your database.

3. Fill out the form, ensuring to double-check all your entries.

4. Click 'Start' to begin.

## TIPS

Before attempting a full replace, it's a good idea to attempt a search. This way, you can see the number of times the string is found in your database before actually making changes to it.

## DISCLAIMER

This is a powerful tool, so please be careful. If you use this tool, you're doing so at your own risk. Before attempting search and replace, please make sure you have a backup of your database. Ensure you understand how it works before using it on real databases.

## COPYRIGHT

MySQL Search & Replace is released under the GPL (see license.txt).

## Example Usage as PHP Include

```php
// add class file
require_once 'MySQLSearchReplace.php';

// settings
$config = array(
    'server'   => 'localhost',
    'user'     => 'root',
    'password' => '',
    'db'       => 'my_db_name',
    //'action'   => 'search'
);

// search text
$search = 'http://www.oldsite.com';

// replace text
$replace = 'http://www.newsite.com';

// do now..
$tool = (new MySQLSearchReplace($config, $search, $replace))->startFindReplace();
```

## Example Usage as HTML

![MySQL Search & Replace Form](https://raw.githubusercontent.com/neerajsinghsonu/MySQL-Search-Replace-PHP/master/MySQL-Search-Replace/mysql-search-replace-form.PNG)

## Class File (MySQLSearchReplace.php)

[View Class File](./MySQL-Search-Replace/Class.MySQLSearchReplace.php)
