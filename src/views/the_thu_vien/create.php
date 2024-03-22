<div class="modal fade modal-lg" id="modal-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/the-thu-vien/create" id="the_thu_vien_form" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Thêm thẻ thư viện</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="ngay_bat_dau" class="col-form-label">Ngày bắt đầu</label>
                        <input class="form-control" name="ngay_bat_dau" type="date" id="ngay_bat_dau" value="<?= flash('ngay_bat_dau') ?>" />
                    </div>
                    <div class="mb-3">
                        <label for="ngay_het_han" class="col-form-label">Ngày kết thúc</label>
                        <input class="form-control" name="ngay_het_han" type="date" id="ngay_het_han" value="<?= flash('ngay_het_han') ?>" />
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