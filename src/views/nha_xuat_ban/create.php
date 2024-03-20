<div class="modal fade modal-lg" id="modal-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/nha-xuat-ban/create" id="nha_xuat_ban_form" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tạo nhà xuất bản</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="ten_nxb" class="col-form-label">Tên nhà xuất bản</label>
                        <input class="form-control" name="ten_nxb" type="text" id="ten_nxb" value="<?= flash('ten_nxb') ?>" />
                    </div>
                    <div class="mb-3">
                        <label for="dia_chi" class="col-form-label">Địa chỉ</label>
                        <input class="form-control" name="dia_chi" type="text" id="dia_chi" value="<?= flash('dia_chi') ?>" />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="col-form-label">Email</label>
                        <input class="form-control" name="email" type="email" id="email" value="<?= flash('email') ?>" />
                    </div>
                    <div class="mb-3">
                        <label for="thong_tin_nguoi_dai_dien" class="col-form-label">Thông tin người đại diện</label>
                        <textarea class="form-control" name="thong_tin_nguoi_dai_dien" type="text" id="thong_tin_nguoi_dai_dien" rows="3"><?= flash('thong_tin_nguoi_dai_dien') ?></textarea>
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