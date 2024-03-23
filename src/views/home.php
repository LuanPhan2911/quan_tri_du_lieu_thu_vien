<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/layouts/styles.php" ?>
    <title>Trang chủ</title>
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
                    <div class="d-flex gap-0 justify-content-between mb-3">
                        <a class="btn btn-primary" href="/muon-tra/create">
                            Mượn sách
                        </a>
                        <form action="/" method="get" class="col-lg-6" id='form-search'>
                            <div class="d-flex gap-0">
                                <input type="search" class="form-control" placeholder="Tên độc giả... Tên sách..." name="q" value="<?= $_GET['q'] ?? '' ?>">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>

                    </div>

                    <?php if (empty($ds_mt)) : ?>
                        <div class="fs-4 text-primary">Danh sách mượn trả trống!</div>
                    <?php else : ?>
                        <table class="table table-hover shadow caption-top">
                            <caption>
                                <h3 class="text-primary">DS. Mượn trả</h3>
                            </caption>
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Tên sách</th>
                                    <th>Tên đọc giả</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày trả</th>
                                    <th>Hành động</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php foreach ($ds_mt as $each) { ?>
                                    <tr class="<?= $each['da_tra'] == 0 ? 'table-warning' : 'table-success' ?>">
                                        <td><?= $each['ma_mt'] ?></td>
                                        <td class="col-3"><?= $each['ten_sach'] ?></td>
                                        <td><?= $each['ten_dg'] ?></td>
                                        <td class="fw-bold"><?= $each['da_tra'] == 0 ? "Chưa trả" : "Đã trả" ?></td>
                                        <td class="fw-bold"><?= $each['ngay_tra'] == NULL ? "Chưa trả" : $each['ngay_tra'] ?></td>
                                        <td>
                                            <?php if (is_admin()) : ?>
                                                <a class="m-1 btn btn-warning confirm" href="/muon-tra/edit/<?= $each['ma_mt'] ?>/sach/<?= $each['ma_sach'] ?>">Trả sách</a>
                                                <?php if ($each['da_tra'] != 0) : ?>
                                                    <a class="m-1 btn btn-danger destroy" href="/muon-tra/destroy/<?= $each['ma_mt'] ?>/sach/<?= $each['ma_sach'] ?>">Xóa</a>
                                                <?php endif;  ?>
                                            <?php else : ?>
                                                <a class="m-1 btn btn-warning confirm" href="/muon-tra/edit/<?= $each['ma_mt'] ?>/sach/<?= $each['ma_sach'] ?>">Trả sách</a>
                                            <?php endif;  ?>
                                        </td>
                                    </tr>
                                <?php } ?>


                            </tbody>
                        </table>
                        <?php require_once __DIR__ . "/layouts/paginate_navigation.php" ?>
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