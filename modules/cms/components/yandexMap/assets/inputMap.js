
$(function(){
    var container = ".b-ivphpan-container";
    var mapId = 'ivphpanYandexMapArea';
    var cords = $("#ivphpanYandexMapCords").val();

    ivphpanYandexMap.init(mapId);

    if(cords.length>0)
    {
        cords = cords.split(',');
        ivphpanYandexMap.resetPoints();
        ivphpanYandexMap.cords = cords;
        ivphpanYandexMap.addPoint(cords);
        ivphpanYandexMap.setEvent("panTo");
        ivphpanYandexMap.setEvent("drawPoints");
    }

    $("#ivphpanYandexMapAddress").change(function(){
        var timerId = null;
        var elem = $(this);
        var val = elem.val();
        ivphpanYandexMap.getCordsByAddress(val);
        ivphpanYandexMap.setEvent("panTo");
    });

    $("#ivphpanYandexMapCords").change(function () {
       var elem = $(this);
        var point = {};
        var val = elem.val();
        val = val.split(',');
        ivphpanYandexMap.resetPoints();
        ivphpanYandexMap.addPoint(val);
        ivphpanYandexMap.setEvent("drawPoints");
    });
});
