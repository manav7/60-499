<?php
session_start(); 
if(session_destroy())
{
print"<h2>you have logged out successfully</h2>";
print "<h3><a href='Login.html'>back to main page</a></h3>";
}
?>