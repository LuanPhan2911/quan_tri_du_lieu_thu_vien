<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/layouts/styles.php" ?>
    <title>Quản lý sách</title>
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
                    <div class="d-flex gap-0 justify-content-between mb-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create">
                            Thêm sách
                        </button>
                        <form action="/sach" method="get" class="col-lg-6" id='form-search'>
                            <div class="d-flex gap-0">
                                <input type="search" class="form-control" placeholder="Tên sách..." name="q" value="<?= $_GET['q'] ?? '' ?>">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>

                    </div>
                    <?php require_once __DIR__ . "/sach/create.php" ?>
                    <?php if (empty($ds_sach)) : ?>
                        <div class="fs-4 text-primary">Tủ sách trống!</div>
                    <?php else : ?>
                        <table class="table table-hover shadow caption-top">
                            <caption>
                                <h3 class="text-primary">DS. Sách</h3>
                            </caption>
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên sách</th>
                                    <th>Năm xuất bản</th>
                                    <th>Thể loại</th>
                                    <th>Tác giả</th>
                                    <th>Nhà xuất bản</th>
                                    <th>Hành động</th>
                                </tr>
                            <tbody>
                                <?php foreach ($ds_sach as $each) { ?>
                                    <tr>
                                        <td><?= $each['ma_sach'] ?></td>
                                        <td>
                                            <img src="/assets/images/<?= $each['hinh_anh'] ?>" alt="" width="60px" height="70px">
                                        </td>
                                        <td><?= $each['ten_sach'] ?></td>
                                        <td><?= $each['nam_xuat_ban'] ?></td>
                                        <td><?= $each['ten_tl'] ?></td>
                                        <td><?= $each['ten_tg'] ?></td>
                                        <td><?= $each['ten_nxb'] ?></td>
                                        <td>
                                            <?php if (is_admin()) : ?>
                                                <a class="m-1 btn btn-warning" href="/sach/edit/<?= $each['ma_sach'] ?>">Sửa</a>
                                                <a class="m-1 btn btn-danger destroy" href="/sach/destroy/<?= $each['ma_sach'] ?>">Xóa</a>
                                            <?php else : ?>
                                                <a class="m-1 btn btn-warning" href="/sach/edit/<?= $each['ma_sach'] ?>">Sửa</a>
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
            $('input[type=search]').on('search', function(e) {
                $('#form-search').submit();
            });
            $("#sach_form").validate({
                rules: {
                    hinh_anh: {
                        required: true,
                        accept: "image/",
                    },
                    ten_sach: {
                        required: true,
                    },
                    nam_xuat_ban: {
                        required: true,
                        maxlength: 4
                    },
                    ma_tl: {
                        required: true,
                    },
                    ma_tg: {
                        required: true,
                    },
                    ma_nxb: {
                        required: true,
                    },

                },
                messages: {
                    hinh_anh: {
                        required: "Vui lòng chọn ảnh",
                        accept: "Vui lòng chọn ảnh thích hợp",
                    },
                    ten_sach: {
                        required: "Tên sách không được để trống",
                    },
                    nam_xuat_ban: {
                        required: "Năm xuất bản không được để trống",
                        maxlength: "Năm xuất bản tối đa 4 số"
                    },
                    ma_tl: {
                        required: "Vui lòng chọn thể loại",
                    },
                    ma_tg: {
                        required: "Vui lòng chọn tác giả",
                    },
                    ma_nxb: {
                        required: "Vui lòng chọn nhà xuất bản",
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
            let avatarUrl = null;
            $("#hinh_anh").change(function(e) {

                let file = e.target.files[0];
                if (avatarUrl) {
                    URL.revokeObjectURL(avatarUrl);
                }
                avatarUrl = URL.createObjectURL(file);
                $(".anh-sach").attr("src", avatarUrl);


            })
        })
    </script>

</body>

</html>