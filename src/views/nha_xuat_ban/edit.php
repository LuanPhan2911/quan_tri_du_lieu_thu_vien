<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/../layouts/styles.php" ?>
    <title>Cập nhật nhà xuất bản</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php require_once __DIR__ . "/../layouts/sidebar.php" ?>
            <div class="col">
                <header>
                    <?php require_once __DIR__ . "/../layouts/navbar.php" ?>
                </header>
                <main>
                    <form action="/nha-xuat-ban/edit/<?= $nxb['ma_nxb'] ?>" id="nha_xuat_ban_form" method="post">
                        <div class="card">
                            <div class="card-header">
                                <div class="fs-5 card-title text-primary">
                                    Chỉnh sửa nhà xuất bản
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="ten_nxb" class="col-form-label">Tên nhà xuất bản</label>
                                    <input class="form-control" name="ten_nxb" type="text" id="ten_nxb" value="<?= $nxb['ten_nxb'] ?>" />
                                </div>
                                <div class="mb-3">
                                    <label for="dia_chi" class="col-form-label">Địa chỉ</label>
                                    <input class="form-control" name="dia_chi" type="text" id="dia_chi" value="<?= $nxb['dia_chi'] ?>" />
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="col-form-label">Email</label>
                                    <input class="form-control" name="email" type="email" id="email" value="<?= $nxb['email'] ?>" />
                                </div>
                                <div class="mb-3">
                                    <label for="thong_tin_nguoi_dai_dien" class="col-form-label">Thông tin người đại diện</label>
                                    <textarea class="form-control" name="thong_tin_nguoi_dai_dien" type="text" id="thong_tin_nguoi_dai_dien" rows="3"><?= $nxb['thong_tin_nguoi_dai_dien'] ?></textarea>
                                </div>


                            </div>
                            <div class="card-footer">
                                <button class="btn btn-success">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </main>
            </div>
        </div>
    </div>



    <?php require_once __DIR__ . "/../layouts/toast_success.php" ?>
    <?php require_once __DIR__ . "/../layouts/toast_error.php" ?>
    <?php require_once __DIR__ . "/../layouts/script.php" ?>
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