/**
 * for menu selected - start, about, us
 * Store in localstorage
 **/

function menuSelected(menuCheckboxId){
    var checkval = menuCheckboxId.value;
    $(menuCheckboxId).change(function(){
    if($(this).is(":checked")){
        localStorage.setItem(checkval, '1');
        if(checkval == "Start") $("[Start]").show();
        if(checkval == "About Us") $("[About-Us]").show();
        if(checkval == "Services") $("[Services]").show();
        if(checkval == "Gallery References") $("[Gallery_References]").show();
        if(checkval == "Contact") $("[Contact]").show();
        if(checkval == "Sunny") $("[Sunny]").show();
        checkboxCounter();
        }
    else if($(this).is(":not(:checked)")){
        localStorage.removeItem(checkval);
        if(checkval == "Start") $("[Start]").hide();
        if(checkval == "About Us") $("[About-Us]").hide();
        if(checkval == "Services") $("[Services]").hide();
        if(checkval == "Gallery References") $("[Gallery_References]").hide();
        if(checkval == "Contact") $("[Contact]").hide();
        if(checkval == "Sunny") $("[Sunny]").hide();
        checkboxCounter();
        }
    });
}

function checkboxCounter()
{
    var total_check = $(".siteMenu:checkbox:checked").length;
    if(total_check == 0){
        $(".submit").prop('disabled', true);
    }else {
        $(".submit").prop('disabled', false);
    }
    $("#selected_message").html(`You Selected ${total_check} Menu`);
}