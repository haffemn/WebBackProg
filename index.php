<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            ini_set("display_errors", "On");
            ERROR_REPORTING(E_ALL); // See all exceptions
            include './database/dbparams.inc.php'; // Goes first because dbconnect uses content in this
            include './database/dbconnect.inc.php';
            $title = 'Read and display ...'; // if the above fails, this is not executed
            
            printf("<h1>Marianne Nielsen - Assignment BE.2.0 and BE.2.1</h1>");
            
            // BE.2.0
            $sql  = "select name, capital, population ";
            $sql .= "from country ";
            $sql .= "order by name limit 10";
            
            try {
                $q = $dbh->prepare($sql);
                $q->execute();
                print("<table border='1px solid black;'>\n");
                while ($row = $q->fetch()) {
                    printf("<tr><td>%s</td><td>%s</td><td class='num'>%s</td></tr>\n", 
                            $row['name'], $row['capital'],
                            number_format($row['population']));
                }
                print("</table>\n");
                
                print("*******************************\n");
                
                // BE.2.1
                $sql2  = "SELECT c.name, cl.countrycode, cl.language ";
                $sql2 .= "FROM countrylanguage cl ";
                $sql2 .= "inner join country c on c.code = cl.countrycode ";
                $sql2 .= "order by countrycode limit 10";
                
                $q2 = $dbh->prepare($sql2);
                $q2->execute();
                print("<table border='1px solid black;'>\n");
                while ($row = $q2->fetch()) {
                    printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>\n", 
                            $row['countrycode'], $row['language'], $row['name']);
                }
                print("</table>\n");
            
            } catch(PDOException $e) {
                printf("<p>%s</p>\n", $e->getMessage());
            }
        ?>
    </body>
</html>
