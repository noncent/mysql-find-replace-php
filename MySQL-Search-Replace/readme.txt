------------------------------------------------------------------------
MySQL Search & Replace Tool
------------------------------------------------------------------------

AUTHOR INFO
------------------------------------------------------------------------
The original PHP for this script was written by Mark Jackson @ MJDIGITAL
http://www.mjdigital.co.uk/blog

Front end markup, CSS, and additional PHP by Eric Amundson @sewmyheadon
http://sewmyheadon.com

Update from MySQL to MySQLi Neeraj Singh
https://github.com/neerajsinghsonu/MySQL-Search-Replace-PHP

WHAT DOES THIS SCRIPT DO?
------------------------------------------------------------------------
This MySQL Search & Replace tool provides an easy way to search an 
existing MySQL database for any string and, if you wish, replace it with
another string. 


WHY WOULD I NEED THIS?
------------------------------------------------------------------------
There are all sorts of reasons to use this tool.  My main goal was to 
find a tool that helped replace certain strings so I can move MySQL 
databases from one server to another.

This is especially helpful for large WordPress databases that are
unwieldy when exported to a .sql file and opened in a text editor.


WHERE SHOULD I PUT THE SCRIPT?
------------------------------------------------------------------------
In order to use this tool, you'll either need to place it on the server 
that contains the database you need to search, or if you're using it 
remotely, make sure you have remote access to the database.  


HOW DO I USE MySQL SEARCH & REPLACE?
------------------------------------------------------------------------

It's pretty darn easy, just:

1.  Copy the "MySQL-Search-Replace" folder in a directory on your web server. 

2.  Open a browser and browse to the "MySQL-Search-Replace" folder.  You'll be 
    presented with a form containing all the fields needed to search 
    for, or search and replace, strings in your database.

3.  Complete the form, making sure to double-check all of your entries.

4.  Click 'Start' to begin.


TIPS
------------------------------------------------------------------------
It's a good idea to attempt a search before attempting a full replace.
This way, you'll see the number of times the string is found in your
database before actually making changes to it.


DISCLAIMER
------------------------------------------------------------------------
This is a powerful tool, so please be careful.  If you use this tool, 
you're doing so at your own risk.

Before attempting search and replace, please make sure you have a backup
of your database.

Please make sure you understand how it works before using it on real 
databases.


QUESTIONS
------------------------------------------------------------------------
Feel free to direct questions to:

    Eric Amundson
    sewmyheadon@gmail.com
    http://sewmyheadon.com
    PO Box 1331
    Gig Harbor, WA 98335
    USA

COPYRIGHT
------------------------------------------------------------------------
MySQL Search & Replace is released under the GPL (see license.txt).
