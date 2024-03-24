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
##################################################
delimiter $
drop function if exists da_qua_han $
create function da_qua_han(
	ngay_het_han date
)
returns bool deterministic
begin
	return ngay_het_han < curdate();
end $
delimiter ;

delimiter $
drop function if exists count_tac_gia $
create function count_tac_gia()
returns int deterministic
begin
	return (select count(*) from tac_gia);
end $
delimiter ;

delimiter $
drop function if exists count_nhan_vien $
create function count_nhan_vien()
returns int deterministic
begin
	return (select count(*) from nhan_vien);
end $
delimiter ;

delimiter $
drop function if exists count_the_loai $
create function count_the_loai()
returns int deterministic
begin
	return (select count(*) from the_loai);
end $
delimiter ;

delimiter $
drop function if exists count_sach $
create function count_sach()
returns int deterministic
begin
	return (select count(*) from sach);
end $
delimiter ;

delimiter $
drop function if exists count_nha_xuat_ban $
create function count_nha_xuat_ban()
returns int deterministic
begin
	return (select count(*) from nha_xuat_ban);
end $
delimiter ;

delimiter $
drop function if exists count_doc_gia $
create function count_doc_gia()
returns int deterministic
begin
	return (select count(*) from doc_gia);
end $
delimiter ;


delimiter $
drop function if exists count_muon_tra $
create function count_muon_tra()
returns int deterministic
begin
	return (select count(*) from chi_tiet_muon_tra);
end $
delimiter ;

#############################################

delimiter $
drop procedure if exists phan_trang_sach $
create procedure phan_trang_sach(
	in q varchar(100),
	in n_limit int,
    in n_offset int,
	inout total_record int,
    inout total_page int
)
begin
	set total_record= (select count(*) from sach where ten_sach like concat('%', q, '%'));
    set total_page= ceil(total_record / n_limit);
    select * from sach
        join the_loai
        on the_loai.ma_tl = sach.ma_tl
        join tac_gia
        on tac_gia.ma_tg= sach.ma_tg
        join nha_xuat_ban
        on nha_xuat_ban.ma_nxb= sach.ma_nxb
        where ten_sach like concat('%', q, '%')
        limit n_limit
        offset n_offset
        ;
end $
delimiter ;

delimiter $
drop procedure if exists phan_trang_doc_gia $
create procedure phan_trang_doc_gia(
	in q varchar(100),
	in n_limit int,
    in n_offset int,
	inout total_record int,
    inout total_page int
)
begin
	set total_record= (select count(*) from doc_gia where 
        ten_dg like concat('%', q, '%')
        or
        dia_chi like concat('%', q, '%'));
    set total_page= ceil(total_record / n_limit);
	select *, da_qua_han(ngay_het_han) as da_qua_han
        from doc_gia
        join the_thu_vien
        on doc_gia.so_the= the_thu_vien.so_the
        where 
        ten_dg like concat('%', q, '%')
        or
        dia_chi like concat('%', q, '%')
        order by da_qua_han desc
        limit n_limit
        offset n_offset
        ;
end $
delimiter ;


delimiter $
drop procedure if exists phan_trang_muon_tra $
create procedure phan_trang_muon_tra(
	in q varchar(100),
	in n_limit int,
    in n_offset int,
	inout total_record int,
    inout total_page int
)
begin
	set total_record= (
		select count(*) from muon_tra
		join chi_tiet_muon_tra
        on muon_tra.ma_mt = chi_tiet_muon_tra.ma_mt
        join sach
        on chi_tiet_muon_tra.ma_sach=sach.ma_sach
        join doc_gia
        on doc_gia.so_the= muon_tra.so_the
		where
        ten_sach like concat('%', q, '%')
        or
        ten_dg like concat('%', q, '%')
    );
    set total_page= ceil(total_record / n_limit);
 select 
        muon_tra.*,
        chi_tiet_muon_tra.*,
        sach.ten_sach,
        doc_gia.ten_dg
        from muon_tra
        join chi_tiet_muon_tra
        on muon_tra.ma_mt = chi_tiet_muon_tra.ma_mt
        join sach
        on chi_tiet_muon_tra.ma_sach=sach.ma_sach
        join doc_gia
        on doc_gia.so_the= muon_tra.so_the
        where
        ten_sach like concat('%', q, '%')
        or
        ten_dg like concat('%', q, '%')
        order by da_tra asc, ngay_tra desc
        limit n_limit
        offset n_offset
        ;
end $
delimiter ;



delimiter $
drop procedure if exists muon_tra_trong_ngay $
create procedure muon_tra_trong_ngay(
inout count_muon int,
inout count_tra int
) 
begin
	set count_muon= (select count(*) 
		from muon_tra
		join chi_tiet_muon_tra
		on chi_tiet_muon_tra.ma_mt = muon_tra.ma_mt
		where ngay_muon = curdate()
        );
	set count_tra=(select count(*) 
		from muon_tra
		join chi_tiet_muon_tra
		on chi_tiet_muon_tra.ma_mt = muon_tra.ma_mt
		where ngay_tra = curdate()
        );
    
end $
delimiter ;

delimiter $
drop procedure if exists muon_tra_trong_tuan $
create procedure muon_tra_trong_tuan(
inout count_muon int,
inout count_tra int
) 
begin
	set count_muon= (select count(*) 
		from muon_tra
		join chi_tiet_muon_tra
		on chi_tiet_muon_tra.ma_mt = muon_tra.ma_mt
		where ngay_muon > date_sub(now(), interval 1 week)
        );
	set count_tra=(select count(*) 
		from muon_tra
		join chi_tiet_muon_tra
		on chi_tiet_muon_tra.ma_mt = muon_tra.ma_mt
		where ngay_tra > date_sub(now(), interval 1 week)
        );
end $
delimiter ;

delimiter $
drop procedure if exists muon_tra_trong_thang $
create procedure muon_tra_trong_thang(
inout count_muon int,
inout count_tra int
) 
begin
	set count_muon= (select count(*) 
		from muon_tra
		join chi_tiet_muon_tra
		on chi_tiet_muon_tra.ma_mt = muon_tra.ma_mt
		where ngay_muon > date_sub(now(), interval 1 month)
        );
	set count_tra=(select count(*) 
		from muon_tra
		join chi_tiet_muon_tra
		on chi_tiet_muon_tra.ma_mt = muon_tra.ma_mt
		where ngay_tra > date_sub(now(), interval 1 month)
        );
end $
delimiter ;

delimiter $
drop procedure if exists thong_ke_doc_gia $
create procedure thong_ke_doc_gia(
inout count_con_han int,
inout count_qua_han int
) 
begin
	set count_con_han= (select count(*) 
		from doc_gia
		join the_thu_vien
		on the_thu_vien.so_the = doc_gia.so_the
		where ngay_het_han >= curdate()
        );
	set count_qua_han=(select count(*) 
		from doc_gia
		join the_thu_vien
		on the_thu_vien.so_the = doc_gia.so_the
		where ngay_het_han < curdate()
        );
end $
delimiter ;

delimiter $
drop procedure if exists thong_ke_chung $
create procedure thong_ke_chung() 
begin
    select count_muon_tra() as count_muon_tra,
			count_doc_gia() as count_doc_gia,
            count_the_loai() as count_the_loai,
            count_tac_gia() as count_tac_gia,
            count_sach() as count_sach,
            count_nhan_vien() as count_nhan_vien,
            count_nha_xuat_ban() as count_nha_xuat_ban
            ;
end $
delimiter ;

