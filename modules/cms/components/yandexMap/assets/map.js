$(function(){

    var cords = $(".b-ivphpan-map").data("cords");
    ivphpanYandexMap.init("ivphpanMap");
    if(cords.length)
    {
        cords = cords.split(',');
        ivphpanYandexMap.cords = cords;
        ivphpanYandexMap.addPoint(cords);
        ivphpanYandexMap.setEvent("panTo");
        ivphpanYandexMap.setEvent("drawPoints");
    }

});