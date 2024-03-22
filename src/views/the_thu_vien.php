<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/layouts/styles.php" ?>
    <title>Quản lý thẻ thư viện</title>
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create">
                        Thêm thẻ thư viện
                    </button>
                    <?php require_once __DIR__ . "/the_thu_vien/create.php" ?>

                    <?php if (empty($ds_ttv)) : ?>
                        <div class="fs-4 text-primary">Danh sách thẻ thư viện trống!</div>
                    <?php else : ?>
                        <table class="table table-hover shadow caption-top">
                            <caption>
                                <h3 class="text-primary">DS. Thẻ thư viện</h3>
                            </caption>
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Ghi chú</th>
                                    <th>Hành động</th>
                                </tr>
                            <tbody>
                                <?php foreach ($ds_ttv as $each) { ?>
                                    <tr>
                                        <td><?= $each['so_the'] ?></td>
                                        <td><?= $each['ngay_bat_dau'] ?></td>
                                        <td><?= $each['ngay_het_han'] ?></td>
                                        <td><?= empty($each['ghi_chu']) ? "None" : $each['ghi_chu'] ?></td>
                                        <td>
                                            <?php if (is_admin()) : ?>
                                                <a class="btn btn-warning " href="/the-thu-vien/edit/<?= $each['so_the'] ?>">Sửa</a>
                                                <a class="btn btn-danger destroy" href="/the-thu-vien/destroy/<?= $each['so_the'] ?>">Xóa</a>
                                            <?php else : ?>
                                                <a class="btn btn-warning " href="/the-thu-vien/edit/<?= $each['so_the'] ?>">Sửa</a>
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
            $.validator.addMethod("minDate", function(value, element, params) {
                var curDate = new Date($(params).val());
                var inputDate = new Date(value);
                if (inputDate > curDate)
                    return true;
                return false;
            }, "Invalid Date!");
            $("#the_thu_vien_form").validate({
                rules: {
                    ngay_bat_dau: {
                        required: true,
                    },
                    ngay_het_han: {
                        required: true,
                        minDate: "#ngay_bat_dau"
                    },
                },
                messages: {
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