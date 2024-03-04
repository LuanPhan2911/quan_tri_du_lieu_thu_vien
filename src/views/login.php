<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once  __DIR__ . "/layouts/styles.php" ?>

    <title>Đăng nhập</title>
</head>

<body>

    <?php require_once __DIR__ . "/layouts/header.php" ?>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 my-3">
                    <div class="card shadow">
                        <div class="card-header">
                            <h3 class="text-center text-primary">Đăng nhập</h3>
                        </div>
                        <div class="card-body">
                            <form action="/login" method="post" id="login_form">
                                <div class="mb-3 row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="email" type="email" id="email" value="<?= flash("email") ?>" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="mat_khau" class="col-sm-3 col-form-label">Mật khẩu</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="mat_khau" type="password" id="mat_khau" />
                                    </div>

                                </div>
                                <div class="mb-3 d-flex justify-content-center">
                                    <button class="btn btn-primary px-5 d-block" type="submit">Đăng nhập</button>
                                </div>
                                <div class="mb-3">
                                    <p class="text-center">Bạn chưa có tài khoản?
                                        <a href="/register" class="link-primary text-decoration-none">Đăng ký</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>


        </div>

        <?php require_once __DIR__ . "/layouts/toast_error.php"; ?>
    </main>
    <?php require_once __DIR__ . "/layouts/footer.php" ?>
    <?php require_once __DIR__ . "/layouts/script.php" ?>
    <script>
        $(function() {

            $("#login_form").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    mat_khau: {
                        required: true,
                        minlength: 5
                    },


                },
                messages: {
                    email: {
                        required: "Bạn chưa nhập vào địa chỉ email!",
                        email: "Địa chỉ email không hợp lệ!"
                    },
                    mat_khau: {
                        required: "Bạn chưa nhập vào mật khẩu!",
                        minlength: "Mật khẩu ít nhất 5 ký tự!"
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