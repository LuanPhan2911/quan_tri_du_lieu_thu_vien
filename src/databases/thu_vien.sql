create database quan_ly_thu_vien;
use quan_ly_thu_vien;
create table tac_gia(
	ma_tg int primary key auto_increment,
    ten_tg varchar(100),
    website varchar(255) null,
    ghi_chu varchar(255) null
);

create table the_loai(
	ma_tl int primary key auto_increment,
    ten_tl varchar(100),
    slug varchar(100)
);

create table nha_xuat_ban(
	ma_nxb int primary key auto_increment,
    ten_nxb varchar(100),
    dia_chi varchar(100),
    email varchar(100),
    thong_tin_nguoi_dai_dien text null
);

create table sach(
	ma_sach int primary key auto_increment,
    ten_sach varchar(100),
    slug varchar(100),
    ma_tg int,
    ma_tl int,
    ma_nxb int,
    nam_xuat_ban char(4),
    hinh_anh varchar(255) null,
    
    foreign key(ma_tg) references tac_gia(ma_tg),
	foreign key(ma_tl) references the_loai(ma_tl),
	foreign key(ma_nxb) references nha_xuat_ban(ma_nxb)
);

create table the_thu_vien(
	so_the int primary key auto_increment,
    ngay_bat_dau date null,
    ngay_het_han date null,
    ghi_chu varchar(255) null
);

create table doc_gia(
	ma_dg int primary key auto_increment,
    ten_dg  varchar(100),
    dia_chi varchar(100),
    so_the int,
    foreign key(so_the) references the_thu_vien(so_the)
);

create table nhan_vien(
	ma_nv int primary key auto_increment,
    ho_ten varchar(50),
    ngay_sinh date,
    so_dien_thoai varchar(15),
    email varchar(255) unique,
    mat_khau varchar(255),
    vai_tro int default 0
);

create table muon_tra(
	ma_mt int auto_increment,
    so_the int,
    ma_nv int null,
    ngay_muon date default(CURRENT_DATE),
    primary key(ma_mt),
	foreign key(so_the) references the_thu_vien(so_the),
	foreign key(ma_nv) references nhan_vien(ma_nv) on delete set null
);
create table chi_tiet_muon_tra(
	ma_mt int,
    ma_sach int,
    ghi_chu varchar(255) null,
    da_tra bool default(false),
    ngay_tra date null,
    primary key(ma_mt, ma_sach),
    foreign key(ma_mt) references muon_tra(ma_mt) on delete cascade,
    foreign key(ma_sach) references sach(ma_sach) on delete cascade
);
