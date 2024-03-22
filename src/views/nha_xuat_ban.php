<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/layouts/styles.php" ?>
    <title>Quản lý nhà xuất bản</title>
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
                        Tạo nhà xuất bản
                    </button>
                    <?php require_once __DIR__ . "/nha_xuat_ban/create.php" ?>

                    <?php if (empty($ds_nxb)) : ?>
                        <div class="fs-4 text-primary">Danh sách nhà xuất bản trống!</div>
                    <?php else : ?>
                        <table class="table table-hover shadow caption-top">
                            <caption>
                                <h3 class="text-primary">DS. Nhà xuất bản</h3>
                            </caption>
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Tên nhà xuất bản</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Hành động</th>
                                </tr>
                            <tbody>
                                <?php foreach ($ds_nxb as $each) { ?>
                                    <tr>
                                        <td><?php echo $each['ma_nxb'] ?></td>
                                        <td class="col-3"><?php echo $each['ten_nxb'] ?></td>
                                        <td class="col-3"><?php echo $each['email'] ?></td>
                                        <td class="col-3"><?php echo $each['dia_chi'] ?></td>
                                        <td>
                                            <?php if (is_admin()) : ?>
                                                <a class="m-1 btn btn-warning" href="/nha-xuat-ban/edit/<?= $each['ma_nxb'] ?>">Sửa</a>
                                                <a class="m-1 btn btn-danger destroy" href="/nha-xuat-ban/destroy/<?= $each['ma_nxb'] ?>">Xóa</a>
                                            <?php else : ?>
                                                <a class="m-1 btn btn-warning" href="/nha-xuat-ban/edit/<?= $each['ma_nxb'] ?>">Sửa</a>
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

            $("#nha_xuat_ban_form").validate({
                rules: {
                    ten_nxb: {
                        required: true,
                    },
                    dia_chi: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    thong_tin_nguoi_dai_dien: {
                        required: true,
                        minlength: 30
                    },



                },
                messages: {
                    ten_nxb: {
                        required: "Tên nhà xuất bản bắt buộc phải điền!",
                    },
                    dia_chi: {
                        required: "Địa chỉ bắt buộc phải điền!",
                    },
                    email: {
                        required: "Email bắt buộc phải điền!",
                        email: "Địa chỉ email không hợp lệ!"
                    },
                    thong_tin_nguoi_dai_dien: {
                        required: "Thông tin người đại diện bắt buộc phải điền!",
                        minlength: "Thông tin người đại diện tối thiểu 30 ký tự!"
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