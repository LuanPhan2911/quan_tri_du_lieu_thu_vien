<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/layouts/styles.php" ?>
    <title>Quản lý tác giả</title>
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create">
                            Thêm tác giả
                        </button>
                        <form action="/tac-gia" method="get" class="col-lg-6" id="form-search">
                            <div class="d-flex gap-0">
                                <input type="search" class="form-control" placeholder="Tên tác giả..." name="q" value="<?= $_GET['q'] ?? '' ?>">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>

                    </div>

                    <?php require_once __DIR__ . "/tac_gia/create.php" ?>

                    <?php if (empty($ds_tg)) : ?>
                        <div class="fs-4 text-primary">Danh sách tác giả trống!</div>
                    <?php else : ?>
                        <table class="table table-hover shadow caption-top">
                            <caption>
                                <h3 class="text-primary">DS. Tác giả</h3>
                            </caption>
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Tên tác giả</th>
                                    <th>Đường dẫn website</th>
                                    <th>Ghi chú</th>
                                    <th>Hành động</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php foreach ($ds_tg as $each) { ?>
                                    <tr>
                                        <td><?= $each['ma_tg'] ?></td>
                                        <td class="col-3"><?= $each['ten_tg'] ?></td>
                                        <td class="col-3">
                                            <?php if (empty($each['website'])) : ?>
                                                Đường dẫn trống
                                            <?php else : ?>
                                                <a href="<?= $each['website'] ?>" target="_blank">
                                                    <?= $each['website'] ?>
                                                </a>
                                            <?php endif;  ?>
                                        </td>
                                        <td class="col-3"><?= empty($each['ghi_chu']) ? "Ghi chú trống" : $each['ghi_chu'] ?></td>
                                        <td>
                                            <?php if (is_admin()) : ?>
                                                <a class="m-1 btn btn-warning" href="/tac-gia/edit/<?= $each['ma_tg'] ?>">Sửa</a>
                                                <a class="m-1 btn btn-danger destroy" href="/tac-gia/destroy/<?= $each['ma_tg'] ?>">Xóa</a>
                                            <?php else : ?>
                                                <a class="m-1 btn btn-warning" href="/tac-gia/edit/<?= $each['ma_tg'] ?>">Sửa</a>
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

            $("#tac_gia_form").validate({
                rules: {
                    ten_tg: {
                        required: true,
                    },
                    website: {
                        url: true
                    }

                },
                messages: {
                    ten_tg: {
                        required: "Tên tác giả bắt buộc phải điền!",
                    },
                    website: {
                        url: "Đường dẫn website không hợp lệ"
                    }
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            })
            $('input[type=search]').on('search', function(e) {
                $('#form-search').submit();
            });
        })
    </script>

</body>

</html>