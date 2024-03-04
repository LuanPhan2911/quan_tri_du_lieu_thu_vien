<?php
$router->before("GET", "/login", function () {
    if (check_login()) {
        redirect("/");
    }
});
$router->before("GET|POST", "/", function () {
    if (!check_login()) {
        redirect("/login");
    }
});
