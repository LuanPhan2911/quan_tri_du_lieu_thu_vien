<div class="modal fade modal-lg" id="modal-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/tac-gia/create" id="nha_xuat_ban_form" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Thêm tác giả</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="ten_tg" class="col-form-label">Tên tác giả</label>
                        <input class="form-control" name="ten_tg" type="text" id="ten_tg" value="<?= flash('ten_tg') ?>" />
                    </div>
                    <div class="mb-3">
                        <label for="website" class="col-form-label">Địa chỉ website</label>
                        <input class="form-control" name="website" type="text" id="website" value="<?= flash('website') ?>" />
                    </div>
                    <div class="mb-3">
                        <label for="ghi_chu" class="col-form-label">Ghi chú</label>
                        <input class="form-control" name="ghi_chu" type="text" id="ghi_chu" value="<?= flash('ghi_chu') ?>" />
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