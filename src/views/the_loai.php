<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/layouts/styles.php" ?>
    <title>Quản lý thể loại</title>
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
                        Thêm thể loại
                    </button>
                    <?php require_once __DIR__ . "/the_loai/create.php" ?>

                    <?php if (empty($ds_tl)) : ?>
                        <div class="fs-4 text-primary">Danh sách thể loại trống!</div>
                    <?php else : ?>
                        <table class="table table-hover shadow caption-top">
                            <caption>
                                <h3 class="text-primary">DS. Thể loại</h3>
                            </caption>
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Tên thể loại</th>
                                    <th>Slug</th>
                                    <th>Hành động</th>
                                </tr>
                            <tbody>
                                <?php foreach ($ds_tl as $each) { ?>
                                    <tr>
                                        <td><?php echo $each['ma_tl'] ?></td>
                                        <td><?php echo $each['ten_tl'] ?></td>
                                        <td><?php echo $each['slug'] ?></td>
                                        <td>
                                            <a class="btn btn-danger" href="/the-loai/destroy/<?= $each['ma_tl'] ?>">Xóa</a>
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