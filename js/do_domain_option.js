$("[do-domain]").change(function (event) {
    var selected = $(this).val();
    if (selected == "No") {
        $("[domain-name]").hide();
        $("[domain-new]").show();
    } else if (selected == "Yes") {
        $("[domain-name]").show();
        $("[domain-new]").hide();
    } else {
        $("[domain-name]").hide();
        $("[domain-new]").hide();
    }
})