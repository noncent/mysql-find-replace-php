------------------------------------------------------------------------
#MySQL Search & Replace Tool
------------------------------------------------------------------------
Find and Replace a 'string' in entire MySQL database as PHP script, PHP Class. Use as class or html form.


#AUTHOR INFO
------------------------------------------------------------------------
The original PHP for this script was written by Mark Jackson @ MJDIGITAL
http://www.mjdigital.co.uk/blog

Front end markup, CSS, and additional PHP by Eric Amundson @sewmyheadon
http://sewmyheadon.com

Update from MySQL to MySQLi Neeraj Singh
https://github.com/neerajsinghsonu/MySQL-Search-Replace-PHP


#WHAT DOES THIS SCRIPT DO?
------------------------------------------------------------------------
This MySQL Search & Replace tool provides an easy way to search an 
existing MySQL database for any string and, if you wish, replace it with
another string.


#WHY WOULD I NEED THIS?
------------------------------------------------------------------------
There are all sorts of reasons to use this tool.  My main goal was to 
find a tool that helped replace certain strings so I can move MySQL 
databases from one server to another.

This is especially helpful for large WordPress databases that are
unwieldy when exported to a .sql file and opened in a text editor.


#WHERE SHOULD I PUT THE SCRIPT?
------------------------------------------------------------------------
In order to use this tool, you'll either need to place it on the server 
that contains the database you need to search, or if you're using it 
remotely, make sure you have remote access to the database. 


#HOW DO I USE MySQL SEARCH & REPLACE?
------------------------------------------------------------------------

It's pretty darn easy, just:

1.  Copy the "MySQL-Search-Replace" folder in a directory on your web server. 

2.  Open a browser and browse to the "MySQL-Search-Replace" folder.  You'll be 
    presented with a form containing all the fields needed to search 
    for, or search and replace, strings in your database.

3.  Complete the form, making sure to double-check all of your entries.

4.  Click 'Start' to begin.


#TIPS
------------------------------------------------------------------------
It's a good idea to attempt a search before attempting a full replace.
This way, you'll see the number of times the string is found in your
database before actually making changes to it.


#DISCLAIMER
------------------------------------------------------------------------
This is a powerful tool, so please be careful.  If you use this tool, 
you're doing so at your own risk.

Before attempting search and replace, please make sure you have a backup
of your database.

Please make sure you understand how it works before using it on real 
databases.

COPYRIGHT
------------------------------------------------------------------------
MySQL Search & Replace is released under the GPL (see license.txt).


#Example as PHP include
```php
<?php

// add class file
require_once 'MySQLSearchReplace.php';

// settings
$config = array
(
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

#Example as HTML

![alt tag](https://raw.githubusercontent.com/neerajsinghsonu/MySQL-Search-Replace-PHP/master/MySQL-Search-Replace/mysql-search-replace-form.PNG)

#Class File (MySQLSearchReplace)

```php
<?php
/**
 * Find and replace for complete MySQL database
 * -----------------------------------------------------
 *
 * Written by Mark Jackson @ MJDIGITAL
 * Can be used by anyone - but give me a nod if you do!
 * http://www.mjdigital.co.uk/blog
 * http://mj7.co.uk/am03,
 * http://mjdigital.co.uk/search-and-replace-text-in-whole-mysql-database/
 * UI From: https://launchpad.net/~sewmyheadon
 * UI @author: Eric Amundson
 *
 * @update: Neeraj Singh
 *
 * ++++++++++++++++++++++++++++++++++++++++++++++++++++++
 *
 * CHANGE LOG:
 * remove mysql and using mysqli
 * function to PHP Class
 * page to manage mysql config
 * report updated UI
 */
class MySQLSearchReplace
{
    /**
     * MySQL Action, search or replace
     * @var string
     */
    private $action = 'replace';
    /**
     * Db Connection
     * @var null
     */
    private $con = null;
    /**
     * All db tables
     * @var array
     */
    private $tables = array();
    /**
     * Tables columns
     * @var array
     */
    private $fields = array();
    /**
     * string to search
     * @var string
     */
    private $search = '';
    /**
     * string to replace
     * @var string
     */
    private $replace = '';
    /**
     * [__construct description]
     * @param array $config [description]
     */
    public function __construct($config = array(), $search = '', $replace = '')
    {

        if (isset($config['server'], $config['user'], $config['password'], $config['db'], $search, $replace)) {
            $this->mysql_server   = $config['server'];
            $this->mysql_user     = $config['user'];
            $this->mysql_password = $config['password'];
            $this->mysql_db       = $config['db'];
            $this->search         = $search;
            $this->replace        = $replace;

            if (isset($config['action'])) {
                $this->action = $config['action'];
            }

            /**
             * Connect MySQL Host and Create Connection Link
             * @var mysqli object
             */
            $this->con = new mysqli($this->mysql_server, $this->mysql_user, $this->mysql_password, $this->mysql_db);
            /**
             * If any connection error occurs
             */

            if ($this->con->connect_errno) {
                printf("Connection failed: %s \n", $this->con->connect_error);
                exit();
            }

            /**
             * Set Character Set
             */
            $this->con->set_charset("utf8");
            /**
             * return self object
             */
            return $this;
        } else {
            die('Application Error: Required Parameter missing.');
        }

    }

    /**
     * Get all table from requested database
     * @return [type] [description]
     */
    public function getAllTables()
    {
        // get list of tables
        $result = $this->con->query('SHOW TABLES');
        // if error

        if ($result === false) {
            die('Wrong SQL: ' . $this->con->error);
        }

        // set class property with table array
        $this->tables = $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Start find and replace in all table and all column
     * @return [type] [description]
     */
    public function startFindReplace()
    {
        // list of all tables to find replace
        $this->getAllTables();
        // output in html table format
        $output    = "<tr><th>STATUS</th><th>ROWS AFFECTED</th><th>TABLE/FIELD</th><th>ERROR</th><th>QUERY</th></tr>";
        $key       = 'Tables_in_' . strtolower($this->mysql_db);
        $occurence = 0;
        $no_of_tbl = count($this->tables);
        // scan each table each column except primary key column

        foreach ($this->tables as $table) {
            // get a list of fields
            $table       = $table[$key];
            $query       = "SHOW FIELDS FROM `$table`";
            $result      = $this->con->query($query);
            $field_array = $result->fetch_assoc();
            // compile + run sql

            do {
                $field = $field_array['Field'];
                $type  = $field_array['Type'];

                switch (true) {
                    // set which column types can be replaced/searched
                    case stristr(strtolower($type), 'char'): $is_changable = true;
                        break;
                    case stristr(strtolower($type), 'text'): $is_changable = true;
                        break;
                    case stristr(strtolower($type), 'blob'): $is_changable = true;
                        break;
                    case stristr(strtolower($field_array['Key']), 'pri'): $is_changable = false;
                        // do not replace on primary keys
                        break;
                    default:$is_changable = false;
                        break;
                }

                // field type is ok do replacement

                if ($is_changable) {
                    // create unique handle for update_sql array
                    $handle = "{$table}_{$field}";

                    if ($this->action === 'replace') {
                        $sql[$handle]['sql'] = "UPDATE `{$table}` SET `{$field}` = REPLACE(`{$field}`, '{$this->search}', '{$this->replace}')";
                    } else {
                        $sql[$handle]['sql'] = "SELECT * FROM `{$table}` WHERE `{$field}` REGEXP('{$this->search}')";
                    }

                    $error = false;
                    // execute sql
                    $query = $this->con->query($sql[$handle]['sql']);

                    if ($query === false) {
                        $error = 'Wrong SQL: ' . $sql[$handle]['sql'] . ' Error: ' . $this->con->error;
                    }

                    if ($this->con->affected_rows) {
                        $row_count = $this->con->affected_rows;
                        $occurence = ($occurence + $row_count);
                    } else {
                        $row_count = 0;
                    }

                    // store the output (just in case)
                    $sql[$handle]['result']   = $query;
                    $sql[$handle]['affected'] = $row_count;
                    $sql[$handle]['error']    = $error;
                    // write out results into $output
                    $output .= "<tr>";
                    $output .= ($query) ? '<td>OK</td>' : '<td>--</td>';
                    $output .= ($row_count > 0) ? '<td><strong>' . $row_count . '</strong></td>' : '<td><span style="color:#CCC">' . $row_count . '</span></td>';
                    $fieldName = $table . '`.`' . $field . '`';
                    $output .= '<td>' . $fieldName . '</td>';
                    $erTab = $fieldName;
                    $output .= ($error) ? '<td>' . $erTab . '(ERROR: ' . $error . ') </td>' : '<td>0</td>';
                    $output .= '<td>' . (($row_count > 0) ? $sql[$handle]['sql'] : "Affected rows 0") . '</td>';
                    $output .= "</tr>";
                }

            } while ($field_array = $result->fetch_assoc());

        }

        if ($this->action === 'replace') {
            $summery = "<p>" . "Summery: REPLACED '$this->search' with '$this->replace' in database '$this->mysql_db' and found {$occurence} result in $no_of_tbl tables.</p>";
            $summery = str_repeat('+', strlen($summery)) . $summery . str_repeat('+', strlen($summery));
        } else {
            $summery = "<p>" . "Summery: SEARCH '$this->search' in database '$this->mysql_db' and found {$occurence} result in $no_of_tbl tables.</p>";
            $summery = str_repeat('+', strlen($summery)) . $summery . str_repeat('+', strlen($summery));
        }

        echo "<pre>$summery<table border='1'>", $output, "</table>---ACTION END HERE</pre>";
    }

}

```

Big Thanks To *Mark Jackson, who have written this php utility. Say thanks to Mark http://mjdigital.co.uk/search-and-replace-text-in-whole-mysql-database/

Cheers!!
