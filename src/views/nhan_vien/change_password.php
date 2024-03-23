<div class="modal fade modal-md" id="modal-change-password">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/change-password" id="change_password_form" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Đổi mật khẩu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="mat_khau_cu" class="col-form-label">Mật khẩu củ</label>
                        <input class="form-control" name="mat_khau_cu" type="password" id="mat_khau_cu" />
                    </div>
                    <div class="mb-3">
                        <label for="mat_khau_moi" class="col-form-label">Mật khẩu mới</label>
                        <input class="form-control" name="mat_khau_moi" type="password" id="mat_khau_moi" />
                    </div>
                    <div class="mb-3">
                        <label for="xac_nhan_mat_khau_moi" class="col-form-label">Xác nhận mật khẩu mới</label>
                        <input class="form-control" name="xac_nhan_mat_khau_moi" type="password" id="xac_nhan_mat_khau_moi" />
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