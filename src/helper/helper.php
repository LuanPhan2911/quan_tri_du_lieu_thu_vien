<?php
session_start();

define('VIEW_DIR', __DIR__ . "/../views/");
define('SRC_DIR', __DIR__ . "/..//");

function ma_nv()
{
    return $_SESSION['ma_nv'] ?? NULL;
}
function nhan_vien()
{
    return [
        'ho_ten' => $_SESSION['ho_ten'] ?? NULL,
        'ma_nv' => $_SESSION['ma_nv'] ?? NULL,
        'vai_tro' => $_SESSION['vai_tro'] ?? NULL,
    ];
}
function flash($key)
{
    if (isset($_SESSION[$key])) {
        $message = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $message;
    }
}
function notify_no_permission()
{
    $_SESSION['err'] = "Không có quyền thực hiện hành động này";
}
function get_query_string()
{
    return $_SERVER['QUERY_STRING'];
}
function check_login(): bool
{
    return ma_nv() != NULL;
}
function is_admin(): bool
{
    $vai_tro = $_SESSION['vai_tro'] ?? 0;
    return check_login() && $vai_tro == 1;
}
function upload_file($file, $target)
{

    $dir = str_replace("\\", "/", __DIR__);

    $time = time();
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $file_name = $time . basename($file['name']);

    $path = $target . hash_hmac("sha256", $file_name, "291103") . ".$ext";
    $dir = "$dir/../../public/assets/images/" . $path;
    move_uploaded_file($file['tmp_name'], $dir);
    return $path;
}
function remove_file($target)
{
    $dir = str_replace("\\", "/", __DIR__);

    return unlink("$dir/../../public/assets/images/" . $target);
}
function redirect(string $location)
{
    header("location:" . $location);
}

function view(string $view, $data = [])
{
    extract($data);
    $view = str_replace(".", "/", $view);
    require_once VIEW_DIR . $view . ".php";
}
function post_to_session($ignores = [])
{
    foreach ($_POST as $key => $value) {
        if (count($ignores) > 0) {
            foreach ($ignores as $ignore_key) {
                if ($key != $ignore_key) {
                    $_SESSION[$key] = $value;
                }
            }
        } else {
            $_SESSION[$key] = $value;
        }
    }
}
function require_attribute($requires)
{
    $check = true;
    foreach ($requires as $key) {

        if (!array_key_exists($key, $_POST) || empty($_POST[$key])) {

            $check = false;
        }
    }
    return $check;
}
function post_to_html_escape()
{
    foreach ($_POST as $key => $value) {
        $_POST[$key] = htmlspecialchars($value);
    }
}
