<div class="modal fade" id="modal-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/the-loai/create" id="the_loai_form" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Thêm thể loại</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="ten_tl" class="col-form-label">Tên thể loại</label>
                        <input class="form-control" name="ten_tl" type="text" id="ten_tl" value="<?= flash('ten_tl') ?>" />
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