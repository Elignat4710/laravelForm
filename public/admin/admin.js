$(document).ready(function () {
    $(".nav-treeview .nav-link, .nav-link").each(function () {
        var location2 = window.location.protocol + '//' + window.location.host + window.location.pathname;
        var link = this.href;
        if (link == location2) {
            $(this).addClass('active');
            $(this).parent().parent().parent().addClass('menu-is-opening menu-open');

        }
    });

    $('.delete-btn').click(function () {
        var res = confirm('Подтвердите действия');
        if (!res) {
            return false;
        }
    });

    $('#phone').inputmask('+9 (999) 999-9999');

    $('#photo').bind('change', function () {
        if (this.files[0].size >= 2000000) {
            alert('File size must be up to 2 mb');
            this.value = ''
        }
    });
})
