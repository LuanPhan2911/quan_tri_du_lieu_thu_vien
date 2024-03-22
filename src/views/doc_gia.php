<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/layouts/styles.php" ?>
    <title>Quản lý độc giả</title>
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
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create">
                            Thêm đọc giả
                        </button>
                        <form action="/doc-gia" method="get" class="col-lg-6" id='form-search'>
                            <div class="d-flex gap-0">
                                <input type="search" class="form-control" placeholder="Tên đọc giả..." name="q" value="<?= $_GET['q'] ?? '' ?>">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <?php require_once __DIR__ . "/doc_gia/create.php" ?>

                    <?php if (empty($ds_dg)) : ?>
                        <div class="fs-4 text-primary">Danh sách đọc giả trống!</div>
                    <?php else : ?>
                        <table class="table table-hover shadow caption-top">
                            <caption>
                                <h3 class="text-primary">DS. Độc giả</h3>
                            </caption>
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Tên đọc giả</th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày hết hạn</th>
                                    <th>Ghi chú</th>
                                    <th>Hành động</th>
                                </tr>
                            <tbody>
                                <?php foreach ($ds_dg as $each) { ?>
                                    <tr>
                                        <td><?= $each['ma_dg'] ?></td>
                                        <td><?= $each['ten_dg'] ?></td>
                                        <td><?= $each['dia_chi'] ?></td>
                                        <td><?= $each['ngay_bat_dau'] ?></td>
                                        <td><?= $each['ngay_het_han'] ?></td>
                                        <td><?= empty($each['ghi_chu']) ? "None" : $each['ghi_chu'] ?></td>

                                        <td>
                                            <?php if (is_admin()) : ?>
                                                <a class="btn btn-warning " href="/doc-gia/edit/<?= $each['ma_dg'] ?>">Sửa</a>
                                                <a class="btn btn-danger destroy" href="/doc-gia/destroy/<?= $each['ma_dg'] ?>/the-thu-vien/<?= $each['so_the'] ?>">Xóa</a>
                                            <?php else : ?>
                                                <a class="btn btn-warning " href="/doc-gia/edit/<?= $each['ma_dg'] ?>">Sửa</a>
                                            <?php endif;  ?>
                                        </td>

                                    </tr>
                                <?php } ?>


                            </tbody>
                            </thead>
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
            $.validator.addMethod("minDate", function(value, element, params) {
                var curDate = new Date($(params).val());
                var inputDate = new Date(value);
                if (inputDate > curDate)
                    return true;
                return false;
            }, "Invalid Date!");
            $("#the_thu_vien_form").validate({
                rules: {
                    ten_dg: {
                        required: true,
                    },
                    dia_chi: {
                        required: true,
                    },
                    ngay_bat_dau: {
                        required: true,
                    },
                    ngay_het_han: {
                        required: true,
                        minDate: "#ngay_bat_dau"
                    },
                },
                messages: {
                    ten_dg: {
                        required: "Tên độc giả không được để trống!",
                    },
                    dia_chi: {
                        required: "Địa chỉ không được để trống!",

                    },
                    ngay_bat_dau: {
                        required: "Ngày bắt đầu không được để trống!",
                    },
                    ngay_het_han: {
                        required: "Ngày kết thúc không được để trống!",
                        minDate: "Ngày hết hạn không hợp lệ"
                    },
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

        })
    </script>
</body>

</html>