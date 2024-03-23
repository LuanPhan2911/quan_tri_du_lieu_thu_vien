<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/../layouts/styles.php" ?>
    <title>Đăng ký mượn sách</title>
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
                        <div class="col-lg-8 my-3">
                            <form action="/muon-tra/create" id="muon_tra_form" method="post">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <div class="fs-5 card-title text-primary">
                                            Đăng ký mượn sách
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3 row">
                                            <div class="col-sm-2">
                                                Độc giả:
                                            </div>
                                            <div class="col-lg-8">
                                                <select name="so_the" id="so_the" class="form-select">
                                                    <?php foreach ($ds_dg as $each) { ?>
                                                        <option value="<?= $each['so_the'] ?>"><?= $each['ten_dg'] ?> - <?= $each['dia_chi'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-sm-2">
                                                Sách:
                                            </div>
                                            <div class="col-lg-8">
                                                <select name="ds_ma_sach[]" id="ds_ma_sach" class="form-select" multiple="multiple">
                                                    <?php foreach ($ds_sach as $each) { ?>
                                                        <option value="<?= $each['ma_sach'] ?>"><?= $each['ten_sach'] ?> - <?= $each['ten_tg'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-sm-2">
                                                <label for="ghi_chu" class="col-form-label">Ghi chú</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input class="form-control" name="ghi_chu" type="text" id="ghi_chu" value="<?= flash('ghi_chu') ?>" />
                                            </div>

                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-success">Đăng ký mượn</button>
                                    </div>
                                </div>
                            </form>
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

            $("#muon_tra_form").validate({
                rules: {
                    so_the: {
                        required: true,
                    },
                    ds_ma_sach: {
                        required: true,
                    },
                },
                messages: {
                    so_the: {
                        required: "Vui lòng chọn độc giả!",
                    },
                    ds_ma_sach: {
                        required: "Vui lòng chọn sách!",
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
            $('#so_the').select2();
            $('#ds_ma_sach').select2();
        })
    </script>

</body>

</html>