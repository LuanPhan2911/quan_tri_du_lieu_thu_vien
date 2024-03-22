<?php

namespace App\Controllers;

use App\Models\NhanVien;

class AuthController
{
    public function loginForm()
    {
        return view('login');
    }
    public function registerForm()
    {
        return view("register");
    }
    public function login()
    {

        $email = htmlspecialchars($_POST["email"]) ?? NULL;
        $mat_khau = htmlspecialchars($_POST["mat_khau"]) ?? NULL;

        $errorMessage = "Email hoặc mật khẩu không đúng";

        if (empty($email) || empty($mat_khau)) {
            $_SESSION["err"] = $errorMessage;
            $_SESSION['email'] = $email;
            redirect("/login");
            exit;
        }

        $NhanVien = new NhanVien();

        $nhan_vien = $NhanVien->exist($email);


        if (!empty($nhan_vien)) {

            // verify password
            $mat_khau_hash = $nhan_vien['mat_khau'];
            if (!password_verify($mat_khau, $mat_khau_hash)) {
                $_SESSION["err"] = $errorMessage;
                $_SESSION["email"] = $email;
                redirect("/login");
                exit;
            }



            $_SESSION["ma_nv"] = $nhan_vien["ma_nv"];
            $_SESSION["ho_ten"] = $nhan_vien["ho_ten"];
            $_SESSION['vai_tro'] = $nhan_vien['vai_tro'];
            $_SESSION["msg"] = "Bạn đã đăng nhập thành công!";
            redirect("/");
            exit;
        } else {
            $_SESSION["err"] = $errorMessage;
            $_SESSION["email"] = $email;
            redirect("/login");
            exit;
        }
    }

    public function register()
    {
        $ho_ten = htmlspecialchars($_POST["ho_ten"]) ?? NULL;
        $ngay_sinh = htmlspecialchars($_POST["ngay_sinh"]) ?? NULL;
        $so_dien_thoai = htmlspecialchars($_POST["so_dien_thoai"]) ?? NULL;
        $email = htmlspecialchars($_POST["email"]) ?? NULL;
        $mat_khau = htmlspecialchars($_POST["mat_khau"]) ?? NULL;



        if (!$ho_ten || !$ngay_sinh || !$so_dien_thoai || !$email || !$mat_khau) {
            $_SESSION["err"] = "Một vài trường dữ liệu bị trống!";
            $_SESSION["ho_ten"] = $ho_ten;
            $_SESSION["ngay_sinh"] = $ngay_sinh;
            $_SESSION["so_dien_thoai"] = $so_dien_thoai;
            $_SESSION["email"] = $email;

            redirect("/register");
            exit;
        }

        //check email exist



        $NhanVien = new NhanVien();

        $data = $NhanVien->exist($email);


        if (!empty($data)) {
            $_SESSION["err"] = "Email đã tồn tại";

            $_SESSION["ho_ten"] = $ho_ten;
            $_SESSION["ngay_sinh"] = $ngay_sinh;
            $_SESSION["so_dien_thoai"] = $so_dien_thoai;
            $_SESSION["email"] = $email;

            redirect("/register");
            exit;
        }

        $mat_khau_hash = password_hash($mat_khau, PASSWORD_BCRYPT);

        $ma_nv = $NhanVien->insert([
            'ho_ten' => $ho_ten,
            'ngay_sinh' => $ngay_sinh,
            'so_dien_thoai' => $so_dien_thoai,
            'email' => $email,
            'mat_khau' => $mat_khau_hash
        ]);

        if (isset($ma_nv)) {
            $_SESSION["msg"] = "Bạn đã đăng ký thành công!";
            redirect("/nhan-vien");
            exit;
        } else {
            $_SESSION['err'] = "Có lỗi xảy ra!";
            redirect("/register");
            exit;
        }
    }
    public function logout()
    {
        session_unset();
        redirect("/");
        exit;
    }
}
