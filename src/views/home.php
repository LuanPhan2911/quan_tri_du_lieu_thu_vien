    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once __DIR__ . "/layouts/styles.php" ?>
        <title>Trang chủ</title>
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
                        <div class="mb-3">
                            <div class="text-primary fw-bold fs-5 mb-3">Thống kê mượn trả</div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <canvas id="muon_tra_trong_ngay"></canvas>
                                </div>
                                <div class="col-lg-4">
                                    <canvas id="muon_tra_trong_tuan"></canvas>
                                </div>
                                <div class="col-lg-4">
                                    <canvas id="muon_tra_trong_thang"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="text-primary fw-bold fs-5 mb-3">Thống kê độc giả</div>
                                    <canvas id="doc_gia"></canvas>
                                </div>
                                <div class="col-lg-1"></div>
                                <div class="col-lg-3">
                                    <div class="text-primary fw-bold fs-5 mb-3">Thống kê chung</div>
                                    <div class="shadow p-3">
                                        <div class="text-primary">Tổng nhân viên:
                                            <span class="fw-bold"><?= $thong_ke_chung['count_nhan_vien'] ?></span>
                                        </div>
                                        <div class="text-primary">Tổng sách:
                                            <span class="fw-bold"><?= $thong_ke_chung['count_sach'] ?></span>
                                        </div>
                                        <div class="text-primary">Tổng tác giả:
                                            <span class="fw-bold"><?= $thong_ke_chung['count_tac_gia'] ?></span>
                                        </div>
                                        <div class="text-primary">Tổng thể loại:
                                            <span class="fw-bold"><?= $thong_ke_chung['count_the_loai'] ?></span>
                                        </div>
                                        <div class="text-primary">Tổng nhà xuất bản:
                                            <span class="fw-bold"><?= $thong_ke_chung['count_nha_xuat_ban'] ?></span>
                                        </div>
                                        <div class="text-primary">Tổng độc giả:
                                            <span class="fw-bold"><?= $thong_ke_chung['count_doc_gia'] ?></span>
                                        </div>
                                        <div class="text-primary">Tổng mượn trả:
                                            <span class="fw-bold"><?= $thong_ke_chung['count_muon_tra'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1"></div>
                                <div class="col-lg-3">
                                    <div class="text-primary fw-bold fs-5 mb-3">Xuất CSV</div>
                                    <div class="shadow p-3">
                                        <a href="/download/nhan-vien" class="link-primary d-block">Nhân viên</a>
                                        <a href="/download/doc-gia" class="link-primary d-block">Đọc giả</a>
                                        <a href="/download/nha-xuat-ban" class="link-primary d-block">Nhà xuất bản</a>
                                        <a href="/download/tac-gia" class="link-primary d-block">Tác giả</a>
                                        <a href="/download/sach" class="link-primary d-block">Sách</a>
                                        <a href="/download/muon-tra" class="link-primary d-block">Mượn trả</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>



        <?php require_once __DIR__ . "/layouts/toast_success.php" ?>
        <?php require_once __DIR__ . "/layouts/toast_error.php" ?>
        <?php require_once __DIR__ . "/layouts/script.php" ?>
        <script>
            $(function() {

                function renderThongKeMuonTra({
                    type = 'day',
                    id,
                    label,
                    backgroundColor = "#9BD0F5"
                }) {
                    $.ajax({
                        type: 'get',
                        url: `/muon-tra/thong-ke?type=${type}`,
                        success: function(response) {
                            response = JSON.parse(response);
                            if (response?.success) {
                                let data = response.data;

                                new Chart(
                                    document.getElementById(id), {
                                        type: 'bar',
                                        data: {
                                            labels: ["Đã mượn", "Đã trả"],
                                            datasets: [{
                                                label: label,
                                                data: Object.values(data),
                                                backgroundColor: backgroundColor,
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    max: Object.values(data).reduce((t, a) => t + a, 0)
                                                }
                                            },
                                            plugins: {

                                                title: {
                                                    display: true,
                                                    text: `Tổng lượt mượn trả ${Object.values(data).reduce((t, a) => t + a, 0)}`,
                                                    color: 'blue',


                                                }
                                            }
                                        },

                                    }
                                )
                            }
                        }
                    })
                }

                function renderThongKeDocGia({
                    id,
                    label,
                }) {
                    $.ajax({
                        type: 'get',
                        url: `/doc-gia/thong-ke`,
                        success: function(response) {
                            response = JSON.parse(response);
                            if (response?.success) {
                                let data = response.data;

                                new Chart(
                                    document.getElementById(id), {
                                        type: 'pie',
                                        data: {
                                            labels: ["Còn hạn", "Quá hạn"],
                                            datasets: [{
                                                label: label,
                                                data: Object.values(data),

                                            }]
                                        },
                                        options: {
                                            plugins: {

                                                title: {
                                                    display: true,
                                                    text: `Tổng độc giả ${Object.values(data).reduce((t, a) => t + a, 0)}`,
                                                    color: 'blue',


                                                }
                                            }
                                        }

                                    }
                                )
                            }
                        }
                    })
                }

                renderThongKeMuonTra({
                    type: 'day',
                    id: 'muon_tra_trong_ngay',
                    label: "Trong ngày"
                });
                renderThongKeMuonTra({
                    type: 'week',
                    id: 'muon_tra_trong_tuan',
                    label: "Trong tuần",
                    backgroundColor: '#FFB1C1'
                });
                renderThongKeMuonTra({
                    type: 'month',
                    id: 'muon_tra_trong_thang',
                    label: "Trong tháng",
                    backgroundColor: '#36A2EB'
                });
                renderThongKeDocGia({
                    id: "doc_gia",
                    label: "Độc giả"
                })

            })
        </script>

    </body>

    </html>