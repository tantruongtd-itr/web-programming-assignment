<?php
    $myfile = fopen("./public/text/test.txt", "r");
    echo fread($myfile,filesize("./public/text/test.txt"));
    fclose($myfile);
    // echo "No tasks found!";
?>