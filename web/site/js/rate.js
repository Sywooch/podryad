/**
 * Created by ivphpan on 12.10.15.
 */
$(function(){
    $(".__item-rating").click(function(){

        var element = $(this),
            rateId = element.data("id"),
            parent = element.parents(".contractor-block-info__rating"),
            model = $(".__item-rating_classname", parent).val(),
            csrf = $(".__item-rating_csrf", parent).val(),
            primaryKey = $(".__item-rating_primaryKey", parent).val();

        $.post("/cms/rate",{'Rate':{
            'id':rateId,
            'model':model,
            'primaryKey':primaryKey
        },'_csrf': csrf},function(json){
            console.log(json);
            if(json.message != 'undefined' && json.count != 'undefined')
            {
                showMessage($('.contractor-block-info__rating--message',parent),json.message);
                $('._count',element).html(json.count);
            }

            if(json.error != 'undefined')
            {
                showMessage($('.contractor-block-info__rating--message', parent), json.error);
            }

        },'json');

        return false;
    });

    function showMessage(element,message)
    {
        element.html(message);
        element.show();
        setTimeout(function () {
            element.hide("fast");
        }, 3000);
    }
});