<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/../layouts/styles.php" ?>
    <title>Cập nhật thể loại</title>
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
                    <div class="d-flex justify-content-center my-3">
                        <div class="col-lg-8">
                            <form action="/the-loai/edit/<?= $the_loai['ma_tl'] ?>" id="the_loai_form" method="post">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <div class="fs-5 card-title text-primary">
                                            Chỉnh sửa thể loại
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="ten_tl" class="col-form-label">Tên thể loại</label>
                                            <input class="form-control" name="ten_tl" type="text" id="ten_tl" value="<?= $the_loai['ten_tl'] ?>" />
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-success" type="submit">Cập nhật</button>
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

            $("#the_loai_form").validate({
                rules: {
                    ten_tl: {
                        required: true,
                    },
                },
                messages: {
                    ten_tl: {
                        required: "Tên thể loại không được để trống!",
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