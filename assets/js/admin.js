(function ($) {
    $(function () {
        // defaults for dataTable
        $.extend(true, $.fn.dataTable.defaults, {
            scrollX: true,
            responsive: true,
            autoWidth: false,
            stateSave: true,
            stateDuration: 60 * 60 * 24 // default: 7200
        });

        $('.js-data-table').DataTable();

        // select2
        //$('.js-select2').select2();
        $('[data-select="select2"]').select2();

        // jquery.are-you-sure
        $('.js-are-you-sure').areYouSure();

        //$('[data-toggle="popover"]').popover();
        //$('[data-toggle="tooltip"]').tooltip();
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });
    });
})(jQuery);
