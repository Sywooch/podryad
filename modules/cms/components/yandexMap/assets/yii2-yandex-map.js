
ivphpanYandexMap = {
    id:'',
    idCords:'#ivphpanYandexMapCords',
    options: {
        center: [],
        zoom: 16,
        controls: ["zoomControl", "fullscreenControl","geolocationControl"]
    },
    map:'',
    cords:[],
    points:[],
    events:[],

    init:function(id,options) {

        ivphpanYandexMap.reset();
        ivphpanYandexMap.id=id;

        if(typeof options != 'undefined')
        {
            ivphpanYandexMap.options = options;
        }

        ymaps.ready(function(){
            ivphpanYandexMap.map = new ymaps.Map(ivphpanYandexMap.id,ivphpanYandexMap.options);

            ivphpanYandexMap.map.events.add('click', function (e) {
                    // Получение координат щелчка
                    ivphpanYandexMap.cords = e.get('coords');
                    $(ivphpanYandexMap.idCords).val(ivphpanYandexMap.cords).change();
            });

            var timerId = setInterval(function(){
                if(ivphpanYandexMap.cords)
                {
                    for(var i = 0;i<ivphpanYandexMap.events.length;i++)
                    {
                        var event = ivphpanYandexMap.events[i];

                        if(event == "setCenter")
                        {
                            ivphpanYandexMap.setCenter();
                        }

                        if(event == "panTo")
                        {
                            ivphpanYandexMap.panTo();
                        }

                        if(event == "drawPoints")
                        {
                            ivphpanYandexMap.drawPoints();
                        }
                    }
                    ivphpanYandexMap.reset();
                }
            },1000);
        });
    },
    setEvent:function(event){
        ivphpanYandexMap.events.push(event);
    },
    resetPoints:function(){
        ivphpanYandexMap.points = [];
    },
    addPoint:function(coords,title){
        var point = {};
        point.main = {
            // Описание геометрии.
            geometry: {
                type: "Point",
                coordinates: coords
            },
            // Свойства.
            properties: {
                // Контент метки.
                iconContent: title||'Местоположение на карте'
            }
        };
        point.options = {
            // Опции.
            // Иконка метки будет растягиваться под размер ее содержимого.
            preset: 'islands#blackStretchyIcon',
            // Метку можно перемещать.
            draggable: false
        };
        ivphpanYandexMap.points.push(point);
    },

    drawPoints: function () {
        ivphpanYandexMap.map.geoObjects.removeAll();
        for(var i = 0;i<ivphpanYandexMap.points.length;i++)
        {
            var point = ivphpanYandexMap.points[i];
            var main = point.main;
            var options = point.options;
            myGeoObject = new ymaps.GeoObject(main,options);
            ivphpanYandexMap.map.geoObjects.add(myGeoObject);
        }
    },

    getBackgroundCordsByAddress:function(address)
    {
        var geocoder = ymaps.geocode(address);
        geocoder.then(
            function (res) {
                ivphpanYandexMap.cords = res.geoObjects.get(0).geometry.getCoordinates();
            },
            function (err) {
                ivphpanYandexMap.cords = [55.76, 37.64];
            }
        );
    },

    getCordsByAddress:function(address)
    {
        ivphpanYandexMap.getBackgroundCordsByAddress(address);
    },

    setCenter:function(){
        ivphpanYandexMap.map.setCenter(
            ivphpanYandexMap.cords
        );
    },

    reset:function()
    {
        ivphpanYandexMap.cords = [];
        ivphpanYandexMap.events = [];
    },

    panTo:function(cords)
    {
        var cords = typeof cords!='undefined' ? cords : ivphpanYandexMap.cords;
        for(key in cords)
        {
            cords[key]=parseFloat(cords[key]);
        }
        ivphpanYandexMap.map.panTo(cords);
    }

};

