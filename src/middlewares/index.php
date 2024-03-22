<?php
$router->before("GET|POST", "/.*", function () {

    if ($_SERVER['REQUEST_URI'] != '/login' && !check_login()) {
        redirect("/login");
        exit;
    }
});
$router->before("GET", "/login", function () {
    if (check_login()) {
        redirect("/");
        exit;
    }
});
$router->before("GET|POST", "/nhan-vien/edit/{ma_nv}", function ($ma) {
    if (!is_admin()) {
        if (ma_nv() != $ma) {
            notify_no_permission();
            redirect("/nhan-vien");
            exit;
        }
    }
});
$router->before("GET", "/the-loai/destroy/{ma}", function ($ma) {
    if (!is_admin()) {
        notify_no_permission();
        redirect("/the-loai");
        exit;
    }
});
$router->before("GET", "/nhan-vien/destroy/{ma}", function ($ma) {
    if (!is_admin()) {
        notify_no_permission();
        redirect("/nhan-vien");
        exit;
    }
});
$router->before("GET", "/nha-xuat-ban/destroy/{ma}", function ($ma) {
    if (!is_admin()) {
        notify_no_permission();
        redirect("/nha-xuat-ban");
        exit;
    }
});
$router->before("GET", "/tac-gia/destroy/{ma}", function ($ma) {
    if (!is_admin()) {
        notify_no_permission();
        redirect("/tac-gia");
        exit;
    }
});
