<?php

function requireRole($roles)
{
    if(!in_array($_SESSION['role'],$roles))
    {
        die("Access Denied");
    }
}