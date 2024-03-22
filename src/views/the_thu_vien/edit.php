<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/../layouts/styles.php" ?>
    <title>Cập nhật thẻ thư viện</title>
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
                    <form action="/the-thu-vien/edit/<?= $ttv['so_the'] ?>" id="the_thu_vien_form" method="post">
                        <div class="card">
                            <div class="card-header">
                                <div class="fs-5 card-title text-primary">
                                    Chỉnh sửa thẻ thư viện
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="ngay_bat_dau" class="col-form-label">Ngày bắt đầu</label>
                                    <input class="form-control" name="ngay_bat_dau" type="date" id="ngay_bat_dau" value="<?= $ttv['ngay_bat_dau'] ?>" />
                                </div>
                                <div class="mb-3">
                                    <label for="ngay_het_han" class="col-form-label">Ngày hết hạn</label>
                                    <input class="form-control" name="ngay_het_han" type="date" id="ngay_het_han" value="<?= $ttv['ngay_het_han'] ?>" />
                                </div>
                                <div class="mb-3">
                                    <label for="ghi_chu" class="col-form-label">Ghi chú</label>
                                    <input class="form-control" name="ghi_chu" type="text" id="ghi_chu" value="<?= $ttv['ghi_chu'] ?>" />
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
    </script>

</body>

</html>