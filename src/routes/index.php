<?php
$router->get("/login", 'AuthController@loginForm');
$router->post("/login", 'AuthController@login');
$router->get("/register", 'AuthController@registerForm');
$router->post("/register", 'AuthController@register');
$router->get("/logout", 'AuthController@logout');


$router->get('/', 'HomeController@homeView');
$router->get('/nhan-vien', 'NhanVienController@nhanVienView');
$router->get('/doc-gia', 'DocGiaController@docGiaView');
$router->get('/sach', 'SachController@sachView');
$router->get('/tac-gia', 'TacGiaController@tacGiaView');
$router->get('/the-thu-vien', 'TheThuVienController@theThuVienView');
$router->get('/the-loai', 'TheLoaiController@theLoaiView');
$router->get('/nha-xuat-ban', 'NhaXuatBanController@nhaXuatBanView');




$router->get('/sach/them', 'SachController@themSachView');
