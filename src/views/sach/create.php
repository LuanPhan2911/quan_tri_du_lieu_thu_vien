<div class="modal fade modal-xl" id="modal-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/sach/create" id="sach_form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Thêm sách</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="hinh_anh" class="d-flex justify-content-center mb-3 cursor-pointer">
                                    <img src="/assets/images/default.png" class="img-fluid anh-sach">
                                </label>
                                <div class="fst-italic fw-light text-center">Nhấn vào ảnh trên để thêm ảnh đại diện</div>
                                <input class="form-control" name="hinh_anh" type="file" id="hinh_anh" accept="image/*" />
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <i class="bi bi-book"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Tên sách" name="ten_sach" id="ten_sach" value="<?= flash('ten_sach') ?>">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <i class="bi bi-clock-history"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Năm xuất bản" name="nam_xuat_ban" id="nam_xuat_ban" value="<?= flash('nam_xuat_ban') ?>">
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-2">
                                    Thể loại:
                                </div>
                                <div class="col">
                                    <select name="ma_tl" id="ma_tl" class="form-select">
                                        <?php foreach ($ds_tl as $each) { ?>
                                            <option value="<?= $each['ma_tl'] ?>"><?= $each['ten_tl'] ?></option>
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
                                            <option value="<?= $each['ma_nxb'] ?>"><?= $each['ten_nxb'] ?></option>
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
                                            <option value="<?= $each['ma_tg'] ?>"><?= $each['ten_tg'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>