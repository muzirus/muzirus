import 'jquery';
import 'bootstrap-sass';
import 'jquery-slimscroll';
import 'datatables.net';
import 'datatables.net-bs';
import 'jquery.are-you-sure';
import '../../node_modules/select2/dist/js/select2.min';
import 'admin-lte';

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
        $('form').areYouSure();

        //$('[data-toggle="popover"]').popover();
        //$('[data-toggle="tooltip"]').tooltip();
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });
    });
})(jQuery);
