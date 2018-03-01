(function($) {

    var w = {}

    w.width = $(window).width();

    var wb = {
        exampleScript: {
            test: function() {

            },
            run: function() {

            },
        },
    };

    function runObject() {
        for (var key in wb) {
            if (wb[key].test()) {
                wb[key].run();
            }
        }
    }

    runObject();

}(jQuery));
