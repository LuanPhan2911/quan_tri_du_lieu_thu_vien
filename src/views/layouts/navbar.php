<div class="container">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-brand">
                <?php if (isset($breadcrumb)) {
                ?>
                    <nav style="--bs-breadcrumb-divider: '>';">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/" class="text-decoration-none">Trang chủ</a>
                            </li>
                            <?php foreach ($breadcrumb as $each) { ?>
                                <li class="breadcrumb-item">
                                    <a href="<?= $each['url'] ?>" class="text-decoration-none"><?= $each['name'] ?></a>
                                </li>
                            <?php } ?>

                        </ol>
                    </nav>
                <?php
                }
                ?>
            </div>
            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Xin chào, <?= nhan_vien()['ho_ten'] ?>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="
                    nhan-vien/edit/<?= ma_nv() ?>">Cập nhật tài khoản</a></li>
                    <li><button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#modal-change-password">Đổi mật khẩu</button></li>
                    <li><a class="dropdown-item logout" href="/logout">Thoát</a></li>
                </ul>
            </div>
    </nav>
</div>
<?php require_once __DIR__ . "/../nhan_vien/change_password.php" ?>