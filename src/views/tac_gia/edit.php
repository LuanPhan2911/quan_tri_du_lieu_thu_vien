<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/../layouts/styles.php" ?>
    <title>Cập nhật tác giả</title>
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
                    <form action="/tac-gia/edit/<?= $tac_gia['ma_tg'] ?>" id="tac_gia_form" method="post">
                        <div class="card">
                            <div class="card-header">
                                <div class="fs-5 card-title text-primary">
                                    Chỉnh sửa tác giả
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="ten_tg" class="col-form-label">Tên tác giả</label>
                                    <input class="form-control" name="ten_tg" type="text" id="ten_tg" value="<?= $tac_gia['ten_tg'] ?>" />
                                </div>
                                <div class="mb-3">
                                    <label for="website" class="col-form-label">Địa chỉ</label>
                                    <input class="form-control" name="website" type="text" id="website" value="<?= $tac_gia['website'] ?>" />
                                </div>
                                <div class="mb-3">
                                    <label for="ghi_chu" class="col-form-label">Ghi chú</label>
                                    <input class="form-control" name="ghi_chu" type="text" id="ghi_chu" value="<?= $tac_gia['ghi_chu'] ?>" />
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

            $("#tac_gia_form").validate({
                rules: {
                    ten_tg: {
                        required: true,
                    },
                },
                messages: {
                    ten_tg: {
                        required: "Tên tác giả bắt buộc phải điền!",
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