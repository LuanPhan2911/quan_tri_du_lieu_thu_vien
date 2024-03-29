<?php
$router->get("/login", 'AuthController@loginForm');
$router->post("/login", 'AuthController@login');
$router->get("/register", 'AuthController@registerForm');
$router->post("/register", 'AuthController@register');
$router->get("/logout", 'AuthController@logout');
$router->post('/change-password', 'AuthController@changePassword');


$router->get('/', 'HomeController@homeView');




$router->get('/nha-xuat-ban', 'NhaXuatBanController@nhaXuatBanView');
$router->post('/nha-xuat-ban/create', 'NhaXuatBanController@create');
$router->get('/nha-xuat-ban/edit/{ma_nxb}', 'NhaXuatBanController@edit');
$router->post('/nha-xuat-ban/edit/{ma_nxb}', 'NhaXuatBanController@update');
$router->get('/nha-xuat-ban/destroy/{ma_nxb}', 'NhaXuatBanController@destroy');


$router->get('/the-loai', 'TheLoaiController@theLoaiView');
$router->post("/the-loai/create", "TheLoaiController@create");
$router->get("/the-loai/edit/{ma_tl}", "TheLoaiController@edit");
$router->post("/the-loai/edit/{ma_tl}", "TheLoaiController@update");
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


$router->get('/doc-gia', 'DocGiaController@docGiaView');
$router->post("/doc-gia/create", "DocGiaController@create");
$router->get("/doc-gia/edit/{ma_dg}", "DocGiaController@edit");
$router->post("/doc-gia/edit/{ma_dg}/the-thu-vien/{so_the}", "DocGiaController@update");
$router->get("/doc-gia/destroy/{ma_dg}/the-thu-vien/{so_the}", "DocGiaController@destroy");
$router->get("/doc-gia/thong-ke", "DocGiaController@thongKeDocGia");

$router->get('/sach', 'SachController@sachView');
$router->post('/sach/create', 'SachController@create');
$router->get('/sach/edit/{ma_sach}', 'SachController@edit');
$router->post('/sach/edit/{ma_sach}', 'SachController@update');
$router->get('/sach/destroy/{ma_sach}', 'SachController@destroy');

$router->get('/muon-tra', 'MuonTraController@muonTraView');
$router->get('/muon-tra/create', 'MuonTraController@create');
$router->post('/muon-tra/create', 'MuonTraController@store');
$router->get('/muon-tra/edit/{ma_mt}/sach/{ma_sach}', 'MuonTraController@update');
$router->get('/muon-tra/destroy/{ma_mt}/sach/{ma_sach}', 'MuonTraController@destroy');
$router->get('/muon-tra/thong-ke', 'MuonTraController@thongKeMuonTra');


$router->get("/download/nhan-vien", "HomeController@downloadNhanVienCSV");
$router->get("/download/nha-xuat-ban", "HomeController@downloadNhaXuatBanCSV");
$router->get("/download/muon-tra", "HomeController@downloadMuonTraCSV");
$router->get("/download/sach", "HomeController@downloadSachCSV");
$router->get("/download/doc-gia", "HomeController@downloadDocGiaCSV");
$router->get("/download/tac-gia", "HomeController@downloadTacGiaCSV");
