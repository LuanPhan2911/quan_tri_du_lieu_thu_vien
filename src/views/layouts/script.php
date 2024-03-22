<script src="/assets/js/jquery-3.7.0.min.js"></script>
<script src="/assets/js/moment-with-locales.js"></script>
<script src="/assets/bootstrap/js/bootstrap.bundle.js"></script>
<script src="/assets/js/jquery-confirm.min.js"></script>
<script src="/assets/js/jquery.validate.min.js"></script>
<script src="/assets/js/notify.min.js"></script>
<script src="/assets/js/jquery.mark.min.js"></script>
<!-- admin -->

<script src="/assets/js/chart.umd.js"></script>
<script>
    moment.locale('vi');
    $(function() {
        $(".date-from-now").each(function(_, item) {
            let time = $(this).text();
            $(this).text(moment(time).fromNow())
        })
    })
    $.notify.defaults({
        globalPosition: 'bottom right',
    })
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
<script>
    $(".logout").confirm({

        title: 'Thoát?',
        content: 'Sau 10 giây sẽ tự động đăng xuất. Bạn có chắc là muốn đăng xuất không?',
        autoClose: 'logoutUser|10000',
        buttons: {
            logoutUser: {
                text: 'Đăng xuất',
                action: function() {
                    location.href = this.$target.attr('href');
                }
            },
            cancel: function() {

            }
        }
    });
    $(".destroy").confirm({
        title: 'Bạn có chắc chắn muốn thực hiện hành động xóa?',
        content: 'Sau 10 giây sẽ tự động bỏ qua!',
        autoClose: 'cancel|10000',
        buttons: {
            action: {
                text: 'OK',
                action: function() {
                    location.href = this.$target.attr('href');
                }
            },
            cancel: function() {

            }
        }
    });
</script>