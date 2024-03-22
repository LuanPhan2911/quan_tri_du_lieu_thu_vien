<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/../layouts/styles.php" ?>
    <title>Cập nhật sách</title>
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
                                    <h3 class="text-center text-primary">Cập nhật Sách</h3>
                                </div>
                                <div class="card-body">
                                    <form action="/sach/edit/<?= $sach['ma_sach'] ?>" method="post" id="sach_form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="hinh_anh" class="d-flex justify-content-center mb-3 cursor-pointer">
                                                        <img src="/assets/images/<?= $sach['hinh_anh'] ?>" class="img-fluid anh-sach">
                                                    </label>
                                                    <div class="fst-italic fw-light text-center">Nhấn vào ảnh trên để thêm ảnh đại diện</div>
                                                    <input class="form-control" name="hinh_anh" type="file" id="hinh_anh" accept="image/*" />
                                                    <input type="hidden" name="hinh_anh" value="<?= $sach['hinh_anh'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">
                                                        <i class="bi bi-book"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="Tên sách" name="ten_sach" id="ten_sach" value="<?= $sach['ten_sach'] ?>">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">
                                                        <i class="bi bi-clock-history"></i>
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="Năm xuất bản" name="nam_xuat_ban" id="nam_xuat_ban" value="<?= $sach['nam_xuat_ban'] ?>">
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-2">
                                                        Thể loại:
                                                    </div>
                                                    <div class="col">
                                                        <select name="ma_tl" id="ma_tl" class="form-select">
                                                            <?php foreach ($ds_tl as $each) { ?>
                                                                <option value="<?= $each['ma_tl'] ?>" <?php if ($each['ma_tl'] == $sach['ma_tl']) : ?> selected <?php endif;  ?>><?= $each['ten_tl'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-2">
                                                        Nhà xuất bản:
                                                    </div>
                                                    <div class="col">
                                                        <select name="ma_nxb" id="ma_nxb" class="form-select">
                                                            <?php foreach ($ds_nxb as $each) { ?>
                                                                <option value="<?= $each['ma_nxb'] ?>" <?php if ($each['ma_nxb'] == $sach['ma_nxb']) : ?> selected <?php endif;  ?>><?= $each['ten_nxb'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-2">
                                                        Tác giả:
                                                    </div>
                                                    <div class="col">
                                                        <select name="ma_tg" id="ma_tg" class="form-select">
                                                            <?php foreach ($ds_tg as $each) { ?>
                                                                <option value="<?= $each['ma_tg'] ?>" <?php if ($each['ma_tg'] == $sach['ma_tg']) : ?> selected <?php endif;  ?>><?= $each['ten_tg'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <button class="btn btn-primary px-5" type="submit">Cập nhật</button>
                                    </form>
                                    <div class="mb-3 d-flex justify-content-center">

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
            $("#sach_form").validate({
                rules: {
                    hinh_anh: {
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