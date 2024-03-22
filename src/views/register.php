<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/layouts/styles.php" ?>

    <title>Đăng ký</title>
</head>

<body>
    <?php require_once __DIR__ . "/layouts/header.php" ?>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 my-3">
                    <div class="card shadow">
                        <div class="card-header">
                            <h3 class="text-center text-primary">Đăng ký Nhân Viên</h3>
                        </div>
                        <div class="card-body">
                            <form action="/register" method="post" id="register_form">
                                <div class="mb-3 row">
                                    <label for="ho_ten" class="col-sm-3 col-form-label">Tên nhân viên</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="ho_ten" type="text" id="ho_ten" value="<?= flash('ho_ten') ?>" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="email" type="email" id="email" value="<?= flash('email') ?>" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="mat_khau" class="col-sm-3 col-form-label">Mật khẩu</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="mat_khau" type="password" id="mat_khau" />
                                    </div>

                                </div>
                                <div class="mb-3 row">
                                    <label for="xac_nhan_mat_khau" class="col-sm-3 col-form-label">Nhập lại mật khẩu</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="xac_nhan_mat_khau" type="password" id="xac_nhan_mat_khau" />
                                    </div>

                                </div>
                                <div class="mb-3 row">
                                    <label for="so_dien_thoai" class="col-sm-3 col-form-label">Số điện thoại</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="so_dien_thoai" type="text" id="so_dien_thoai" value="<?= flash('so_dien_thoai') ?>" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="ngay_sinh" class="col-sm-3 col-form-label">Ngày sinh</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="ngay_sinh" type="date" id="ngay_sinh" value="<?= flash('ngay_sinh') ?>" />
                                    </div>
                                </div>
                                <div class="mb-3 d-flex justify-content-center">
                                    <button class="btn btn-primary px-5" type="submit">Đăng ký</button>
                                </div>
                                <div class="mb-3">
                                    <p class="text-center">Bạn đã có tài khoản?
                                        <a href="login" class="link-primary text-decoration-none">Đăng nhập</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>


            </div>
            <?php
            require_once __DIR__ . "/layouts/toast_error.php";
            ?>
    </main>
    <?php require_once __DIR__ . "/layouts/footer.php" ?>
    <?php require_once __DIR__ . "/layouts/script.php" ?>

    <script>
        $(function() {
            $.validator.addMethod("minAge", function(value, element, min) {
                var today = new Date();
                var birthDate = new Date(value);
                var age = today.getFullYear() - birthDate.getFullYear();

                if (age > min + 1) {
                    return true;
                }

                var m = today.getMonth() - birthDate.getMonth();

                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                return age >= min;
            }, "You are not old enough!");
            $("#register_form").validate({
                rules: {
                    ho_ten: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    mat_khau: {
                        required: true,
                        minlength: 5
                    },
                    xac_nhan_mat_khau: {
                        required: true,
                        minlength: 5,
                        equalTo: "#mat_khau"
                    },
                    so_dien_thoai: {
                        required: true,


                    },
                    ngay_sinh: {
                        required: true,
                        date: true,
                        minDate: 18

                    },


                },
                messages: {
                    ho_ten: {
                        required: "Bạn chưa nhập vào tên đăng nhập!"
                    },
                    email: {
                        required: "Bạn chưa nhập vào địa chỉ email!",
                        email: "Địa chỉ email không hợp lệ!"
                    },
                    mat_khau: {
                        required: "Bạn chưa nhập vào mật khẩu!",
                        minlength: "Mật khẩu ít nhất 5 ký tự!"
                    },
                    xac_nhan_mat_khau: {
                        required: "Bạn chưa nhập vào mật khẩu!",
                        minlength: "Tên đăng nhập ít nhất 5 ký tự!",
                        equalTo: "Mật khẩu xác nhận không trùng khớp với mật khẩu đã nhập!"
                    },
                    so_dien_thoai: {
                        required: "Số điện thoại bắt buộc phải điền",


                    },
                    ngay_sinh: {
                        required: "Ngày sinh bắt buộc phải điền",
                        date: "Ngày sinh không hợp lệ",
                        minAge: "Ngày sinh không hợp lệ, không đủ 18 tuổi!"
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