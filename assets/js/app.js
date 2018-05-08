import 'jquery';
import 'bootstrap';

(function ($) {
    $(function () {
        //$('[data-toggle="popover"]').popover();
        //$('[data-toggle="tooltip"]').tooltip();
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });
    });
})(jQuery);
