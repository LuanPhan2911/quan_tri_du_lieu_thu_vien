<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/layouts/styles.php" ?>
    <title>Quản lý nhân viên</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php require_once __DIR__ . "/layouts/sidebar.php" ?>
            <div class="col">
                <header>
                    <?php require_once __DIR__ . "/layouts/navbar.php" ?>
                </header>
                <main>
                    <div class="d-flex gap-0 justify-content-between">
                        <a class="btn btn-primary" href="/register">
                            Thêm nhân viên
                        </a>
                        <form action="/nhan-vien" method="get" class="col-lg-6" id='form-search'>
                            <div class="d-flex gap-0">
                                <input type="search" class="form-control" placeholder="Tên nhân viên..." name="q" value="<?= $_GET['q'] ?? '' ?>">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>

                    </div>
                    <?php if (empty($ds_nv)) : ?>
                        <div class="fs-4 text-primary">Danh sách nhân viên trống!</div>
                    <?php else : ?>
                        <table class="table table-hover shadow caption-top">
                            <caption>
                                <h3 class="text-primary">DS. Nhân viên</h3>
                            </caption>
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Họ tên
                                        <?php if ($qs['order'] == 'asc') : ?>
                                            <a class="btn btn-outline-success" href="?order=desc&q=<?= $qs['q'] ?>"><i class="bi bi-sort-down"></i></a>
                                        <?php else : ?>
                                            <a class="btn btn-outline-success" href="?order=asc&q=<?= $qs['q'] ?>"><i class="bi bi-sort-up"></i></a>
                                        <?php endif;  ?>
                                    </th>
                                    <th>Email</th>
                                    <th>Ngày sinh</th>
                                    <th>Số điện thoại</th>
                                    <th>Hành động</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php foreach ($ds_nv as $each) { ?>
                                    <tr class="<?= ma_nv() == $each['ma_nv'] ? "table-success" : "" ?>">
                                        <td><?= $each['ma_nv'] ?></td>
                                        <td><?= $each['ho_ten'] ?></td>
                                        <td><?= $each['email'] ?></td>
                                        <td><?= $each['ngay_sinh'] ?></td>
                                        <td><?= $each['so_dien_thoai'] ?></td>
                                        <td>
                                            <?php if (is_admin()) : ?>
                                                <a href="/nhan-vien/edit/<?= $each['ma_nv'] ?>" class="m-1 btn btn-warning">
                                                    Sửa
                                                </a>
                                                <?php if ($each['ma_nv'] != ma_nv()) : ?>
                                                    <a href="/nhan-vien/destroy/<?= $each['ma_nv'] ?>" class="m-1 btn btn-danger destroy">
                                                        Xóa
                                                    </a>
                                                <?php endif;  ?>
                                            <?php else : ?>
                                                <span class="fw-bold text-center">None</span>
                                            <?php endif;  ?>


                                        </td>
                                    </tr>
                                <?php } ?>


                            </tbody>
                        </table>
                    <?php endif;  ?>
                </main>
            </div>
        </div>
    </div>



    <?php require_once __DIR__ . "/layouts/toast_success.php" ?>
    <?php require_once __DIR__ . "/layouts/toast_error.php" ?>
    <?php require_once __DIR__ . "/layouts/script.php" ?>
    <script>
        $(function() {
            $('input[type=search]').on('search', function(e) {
                $('#form-search').submit();
            });

        })
    </script>

</body>

</html>