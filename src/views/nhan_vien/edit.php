<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php

    use App\Models\NhanVien;

    require_once __DIR__ . "/../layouts/styles.php" ?>
    <title>Cập nhật nhân viên</title>
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
                    <div class="d-flex justify-content-center">
                        <div class=" col-lg-8 my-3">
                            <div class="card shadow">
                                <div class="card-header">
                                    <h3 class="text-center text-primary">Cập nhật Nhân Viên</h3>
                                </div>
                                <div class="card-body">
                                    <form action="/nhan-vien/edit/<?= $nhan_vien['ma_nv'] ?>" method="post" id="update_form">
                                        <div class="mb-3 row">
                                            <label for="ho_ten" class="col-sm-3 col-form-label">Tên nhân viên</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="ho_ten" type="text" id="ho_ten" value="<?= $nhan_vien['ho_ten'] ?>" />
                                            </div>
                                        </div>


                                        <div class="mb-3 row">
                                            <label for="so_dien_thoai" class="col-sm-3 col-form-label">Số điện thoại</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="so_dien_thoai" type="text" id="so_dien_thoai" value="<?= $nhan_vien['so_dien_thoai'] ?>" />
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="ngay_sinh" class="col-sm-3 col-form-label">Ngày sinh</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="ngay_sinh" type="date" id="ngay_sinh" value="<?= $nhan_vien['ngay_sinh'] ?>" />
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="email" id="email" value="<?= $nhan_vien['email'] ?>" disabled />
                                            </div>
                                        </div>
                                        <div class="mb-3 d-flex justify-content-center">
                                            <button class="btn btn-primary px-5" type="submit">Cập nhật</button>
                                        </div>

                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>


            </div>
            </main>
        </div>
    </div>
    </div>



    <?php require_once __DIR__ . "/../layouts/toast_success.php" ?>
    <?php require_once __DIR__ . "/../layouts/toast_error.php" ?>
    <?php require_once __DIR__ . "/../layouts/script.php" ?>
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
            $("#update_form").validate({
                rules: {
                    ho_ten: {
                        required: true,
                    },
                    so_dien_thoai: {
                        required: true,
                    },
                    ngay_sinh: {
                        required: true,
                        date: true,
                        minAge: 18,
                    },


                },
                messages: {
                    ho_ten: {
                        required: "Bạn chưa nhập vào tên đăng nhập!"
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