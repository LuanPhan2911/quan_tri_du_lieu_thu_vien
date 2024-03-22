<?php
$router->get("/login", 'AuthController@loginForm');
$router->post("/login", 'AuthController@login');
$router->get("/register", 'AuthController@registerForm');
$router->post("/register", 'AuthController@register');
$router->get("/logout", 'AuthController@logout');


$router->get('/', 'HomeController@homeView');
$router->get('/doc-gia', 'DocGiaController@docGiaView');
$router->get('/sach', 'SachController@sachView');



$router->get('/nha-xuat-ban', 'NhaXuatBanController@nhaXuatBanView');
$router->post('/nha-xuat-ban/create', 'NhaXuatBanController@create');
$router->get('/nha-xuat-ban/edit/{ma_nxb}', 'NhaXuatBanController@edit');
$router->post('/nha-xuat-ban/edit/{ma_nxb}', 'NhaXuatBanController@update');
$router->get('/nha-xuat-ban/destroy/{ma_nxb}', 'NhaXuatBanController@destroy');


$router->get('/the-loai', 'TheLoaiController@theLoaiView');
$router->post("/the-loai/create", "TheLoaiController@create");
$router->get("/the-loai/destroy/{ma_tl}", "TheLoaiController@destroy");

$router->get('/tac-gia', 'TacGiaController@tacGiaView');
$router->post("/tac-gia/create", 'TacGiaController@create');
$router->get("/tac-gia/edit/{ma_tg}", 'TacGiaController@edit');
$router->post('/tac-gia/edit/{ma_tg}', 'TacGiaController@update');
$router->get('/tac-gia/destroy/{ma_tg}', 'TacGiaController@destroy');


$router->get('/nhan-vien', 'NhanVienController@nhanVienView');
$router->get('/nhan-vien/edit/{ma_nv}', 'NhanVienController@edit');
$router->post('/nhan-vien/edit/{ma_nv}', 'NhanVienController@update');
$router->get('/nhan-vien/destroy/{ma_nv}', 'NhanVienController@destroy');

$router->get('/the-thu-vien', 'TheThuVienController@theThuVienView');
$router->post('/the-thu-vien/create', 'TheThuVienController@create');
$router->get('/the-thu-vien/edit/{so_the}', 'TheThuVienController@edit');
$router->post('/the-thu-vien/edit/{so_the}', 'TheThuVienController@update');
$router->get('/the-thu-vien/destroy/{so_the}', 'TheThuVienController@destroy');


$router->get('/sach/them', 'SachController@themSachView');
