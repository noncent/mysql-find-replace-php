<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MySQL Database Search &amp; Replace Tool</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrap">
    <h1>MySQL Database Search &amp; Replace Tool</h1>
    <p>To get started, place this folder on your web server and enter the data below.</p>
    <p>For more info, see the <a href="readme.txt">ReadMe file</a>.</p>
    <div class="form-container">
        <div class="form">
            <form method="post" action="mysql-replace.php" class="labelsRightAligned hintsTooltip">
                <fieldset>
                <legend>Search &amp; Replace</legend>
                <div id="searchFor-D" class="oneField">
                    <label class="preField" for="searchFor">Search for: <span class="reqMark">*</span></label>
                    <input type="text" id="searchFor" name="searchFor" value="" size="40" class="required" />
                    <div class="field-hint-inactive" id="searchFor-H"><span>This should be a string of text</span></div>
                    <span class="errMsg" id="searchFor-E"> </span> </div>
                <div id="replaceWith-D" class="oneField">
                    <label class="preField" for="replaceWith">Replace with: <span class="reqMark">*</span></label>
                    <input type="text" id="replaceWith" name="replaceWith" value="" size="40" class="required" />
                    <div class="field-hint-inactive" id="replaceWith-H"><span>This should be a string of text</span></div>
                    <span class="errMsg" id="replaceWith-E"> </span> </div>
                </fieldset>
                <fieldset>
                <legend>Database Information</legend>
                <div id="hostname-D" class="oneField">
                    <label class="preField" for="hostname">Hostname: <span class="reqMark">*</span></label>
                    <input type="text" id="hostname" name="hostname" value="" size="40" class="required" />
                    <div class="field-hint-inactive" id="hostname-H"><span>Enter the database hostname.  Often, this is just 'localhost' - check with your web host to make sure.</span></div>
                    <span class="errMsg" id="hostname-E"> </span> </div>
                <div id="database-D" class="oneField">
                    <label class="preField" for="database">Database: <span class="reqMark">*</span></label>
                    <input type="text" id="database" name="database" value="" size="40" class="required" />
                    <div class="field-hint-inactive" id="database-H"><span>Enter the name of your database</span></div>
                    <span class="errMsg" id="database-E"> </span> </div>
                <div id="username-D" class="oneField">
                    <label class="preField" for="username">Username <span class="reqMark">*</span></label>
                    <input type="text" id="username" name="username" value="" size="40" class="required" />
                    <div class="field-hint-inactive" id="username-H"><span>Enter the username you use to access the database</span></div>
                    <span class="errMsg" id="username-E"> </span> </div>
                <div id="password-D" class="oneField">
                    <label class="preField" for="password">Password <span class="reqMark">*</span></label>
                    <input type="text" id="password" name="password" value="" size="40" class="required" />
                    <div class="field-hint-inactive" id="password-H"><span>Enter the password for your database user</span></div>
                    <span class="errMsg" id="password-E"> </span> </div>
                </fieldset>
                <fieldset>
                <legend>Search / Replace</legend>
                <div id="queryType" class="oneField">
                    <input name="queryType" type="radio" id="search" value="search" 
                    <?php 
                    $OK = isset($_POST['queryType']) ? true : false;
                    if ($OK && isset ($missing) && $_POST['queryType'] == 'search') { ?>
                    checked="checked"
                    <?php } ?>
                    />
                    <label class="radio" for="queryType">Search</label>
                    <input name="queryType" type="radio" id="replace" value="replace" 
                    <?php 
                    if ($OK && isset ($missing) && $_POST['queryType'] == 'replace') { ?>
                    checked="checked"
                    <?php } ?>
                    />
                    <label class="radio" for="queryType">Replace</label>
                </div>
                </fieldset>
                <div class="actions">
                    <input type="submit" class="primaryAction" id="submit" name="submitAction" value="start" />
                    <input type="button" class="secondaryAction" onclick="history.go(-1)" value="cancel" />
                </div>
            </form>
        </div>
        <ul id="site_info" class="group">
            <li>&copy; Copyright
                <?php
					ini_set('date.timezone', 'America/Los_Angeles');
					$start_year = 2009;
					$this_year = date('Y');
					if ($start_year == $this_year) {
						echo $start_year;
						}
					else {
						echo "{$start_year}-{$this_year}";
						}
				?>
                by <a href="http://www.mgdigital.co.uk/">Mark Jackson</a> &amp; <a href="http://sewmyheadon.com">Eric Amundson</a></li>
            <li class="last">Licensed under the <a href="license.txt">GPL</a></li>
        </ul>
    </div>
</div>
</body>
</html>
