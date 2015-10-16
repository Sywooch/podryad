<?php
/** @var $this \yii\web\View */
use yii\helpers\Html;

$this->registerJs('

    $(function(){

      var imyaElem = $("#profile-imya");
      var familiyaElem = $("#profile-familiya");
      var pol = $("#profile-pol");

       $("._vkGetProfile").submit(function(){
            var form = $(this);
            var action = form.attr("action");
            $.post(action,form.serialize(),function(json){
                if(json.length == 0)
                return false;

                console.log(json);
                var item = json.response[0];

                imyaElem.val(item.first_name);
                familiyaElem.val(item.last_name);
                pol.find("[type=radio][value="+item.sex+"]").click();

                if(typeof item.country!="undefined")
                {
                    var country = item.country.title;
                    var countryOption = $("#profile-countryid option:contains("+country+")");
                    var countryId = countryOption.val();
                    $("#profile-countryid").val(countryId).change();
                    $.getJSON("/geo/default/city",{regionId:0,countryId:countryId},function(json){

                        var cityElement = $("#profile-cityid");
                        cityElement.find("option:not(:first)").remove();
                        $.each(json,function(k,v){
                            var option = $("<option>",{value:v.id,text:v.title});
                            option.data("regionId",v.regionId);
                            cityElement.append(option);
                        });
                        var cityOption = cityElement.find("option:contains("+item.city.title+")");
                        cityElement.val(cityOption.val()).change();

                        //получаем регион
                        $("#profile-regionid").val(cityOption.data("regionId"));
                    });
                }

                $("#photo-preview").attr("src",item.photo_max_orig).slideDown();
                $("#profile-photourl").val(item.photo_max_orig);

                if(typeof item.bdate != "undefined")
                {
                    dateElement = $("#profile-datarojdeniya");
                    dateElement.val(item.bdate).change();
                    dateElement.kvDatepicker("remove");
                    dateElement.kvDatepicker({format:"yyyy-mm-dd",language:"ru",startView:"decade"});
                }

                var description = "";
                if(typeof item.activities != "undefined"){
                    if(item.activities.length > 0)
                    {
                        description += "Деятельность: "+item.activities+"\r\n\r\n";
                    }
                }

                if(typeof item.interests != "undefined"){
                    if(item.interests.length > 0)
                    {
                        description += "Интересы: "+item.interests;
                    }
                }
                $("#profile-informaciya").val(description)
                $("#social-info").modal("hide");
            },"JSON");
           return false;
       });
    });
');
?>
<div class="well">
    <?=Html::beginForm(['/reviews/profile/vk-get'],'POST',['class'=>'form-inline _vkGetProfile'])?>
    <div class="form-group">
        <?=Html::textInput('vkId','',['class'=>'form-control'])?>
    </div>
    <?=Html::submitButton('Загрузить данные',['class'=>'btn btn-success'])?>
    <?=Html::endForm()?>
    <div class="clearfix"></div>
</div>

