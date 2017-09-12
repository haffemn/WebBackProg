<?php
try {
    $dbh = new PDO(DSN, DBUSER, USERPWD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    printf("<p>Connect failed for following reason: <br/>%s</p>\n",
        $e->getMessage());
}