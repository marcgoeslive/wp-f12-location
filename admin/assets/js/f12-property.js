(function ($) {
    $(document).ready(function () {
        function show_property_boxes(name) {
            $(document).find(".custom-metabox").each(function () {
                var categories = $(this).attr("data-name");
                var hit = false;
                if (typeof(categories) !== "undefined") {
                    categories = categories.split(",");
                    for (var i = 0; i < categories.length; i++) {
                        if (categories[i] == name) {
                            hit = true;
                        }
                    }
                }

                if (hit) {
                    $(this).parent().parent().show();
                } else {
                    $(this).parent().parent().hide();
                }
            });
        }

        $(".f12-property-category").on("click", function () {
            var name = $(this).attr("id");

            show_property_boxes(name);
        });

        // loading the right fields after loading the page
        $(document).find("input[name='f12cl_category']").each(function () {
            if ($(this).attr("checked")) {
                var name = $(this).attr("id");
                show_property_boxes(name);
            }
        });
    });
})(jQuery);