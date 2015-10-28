$(document).ready(function () {
    
    $('.contractor-block-info-show').click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active').parent().children('span').empty();
            $(this).html($(this).text().replace('скрыть', 'показать'));
        } else {
            var dataShow = $(this).data('show');
            $(this).addClass('active').parent().append('<span>' + dataShow + '</span>');
            $(this).html($(this).text().replace('показать', 'скрыть'));
        }
        return false;
    });
    $('.contractor-tabs-control__item').click(function () {
        var indexTab = $(this).index();
        $(this).addClass('active').siblings().removeClass('active');
        $('.contractor-tabs-box__item').eq(indexTab).addClass('active').siblings().removeClass('active');
        return false;
    });
    $('.slider-big').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: false,
        asNavFor: '.slider-small',
        lazyLoad: 'ondemand'
    });
    $('.slider-small').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        asNavFor: '.slider-big',
        dots: false,
        centerMode: false,
        focusOnSelect: true,
        lazyLoad: 'ondemand'
    });
    $('.portfolio-album').click(function () {
        $('.slider-big').slick('unslick');
        $('.slider-small').slick('unslick');
        var indexTab = $(this).index();
        $(this).addClass('active').siblings().removeClass('active');
        $('.portfolio-slider').eq(indexTab).addClass('active').siblings().removeClass('active');
        $('.portfolio-slider').children('.portfolio-slider-big').removeClass('slider-big');
        $('.portfolio-slider').children('.portfolio-slider-small').removeClass('slider-small');
        $('.portfolio-slider').eq(indexTab).children('.portfolio-slider-big').addClass('slider-big');
        $('.portfolio-slider').eq(indexTab).children('.portfolio-slider-small').addClass('slider-small');
        $('.slider-big').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: false,
            asNavFor: '.slider-small',
            lazyLoad: 'ondemand'
        });
        $('.slider-small').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            asNavFor: '.slider-big',
            dots: false,
            centerMode: false,
            focusOnSelect: true,
            lazyLoad: 'ondemand'
        });
    });
});

;(function ($) {
    $('.swipebox').swipebox({
        useSVG: false
    });
})(jQuery);
$(document).ready(function () {
    var currentValue = $('.header-city-select__current').html();
    $('.header-city-select__input').val(currentValue);
    $('.header-city-select').click(function () {
        $(this).children('.header-city-select__list').slideToggle();
    });
    $('.header-city-select__option').click(function () {
        var optionValue = $(this).data('id');
        var titleValue = $(this).html();
        var thisValue = $('.header-city-select__current').html();
        $('.header-city-select__input').val(optionValue).change();
        $('.header-city-select__current').html(titleValue);
        // destroy
        $(this).remove();
        $('.header-city-select__list').append('<div class="header-city-select__option">' + thisValue + '</div>');
			
   });
$(document).mouseup(function (e) {
    var container = $(".header-city-select__list");
    if (container.has(e.target).length === 0){
        container.hide();
    }
});
});

$(".header-city-select__input").change(function(){
    console.log('test');
   $(this).parents('form').submit();
});

$(document).ready(function () {
    $('a[data-click="modal"]').click(function () {
        var itemWindow = $(this).data('item');
        if ($(itemWindow).hasClass('active')) {
            $('.mask, .modal__close, .modal, body').removeClass('active');
        } else {
            $(itemWindow).addClass('active');
            $('.mask, body').addClass('active');
        }
    });

    $('.mask, .modal__close').click(function () {
        $('.mask, .modal__close, .modal, body').removeClass('active');
    });
    $('.specialization-item a').click(function () {
        var countSpec = $(this).data('type');
        void 0;
        var equallySpec = 10;
        if ($(this).hasClass('foo')) {
            void 0;
        } else {
            $(this).toggleClass('active');
        }
        var item = $('#specialization').find('a.active');
        if (countSpec == 'five-spec') {
            var equallySpec = 5;
        }
        var countItem = item.length;
        if (countItem == equallySpec) {
            $('.specialization-item a').addClass('foo');
            if ($('.specialization-item a').hasClass('active')) {
                $(item).removeClass('foo');
            }
        } else {
            $('.specialization-item a').removeClass('foo');
        }
    });

    $('.specialization__btn').click(function () {
        var item = $('#specialization').find('a.active');
        $('.specialization-list-selected').html(' ');
        $('.mask, .modal__close, .modal, body').removeClass('active');
        if (item.length != 0) {
            $('.registration-contractor-form__btn').html('Изменить специализацию');
        } else {
            $('.registration-contractor-form__btn').html('Выбрать специализацию');
        }
        var model = $(this).data("model");
        $(model + '-specialization').remove();

        if(model == 'RegisterForm') {
            name = '[specialization][]';
        }else if(model == 'Tender'){
            name = '[specializationIds][]';
        }else if(model == 'Contactor'){
            name = '[specializationIds][]';
        }
        console.log(name);
        item.each(function (index, element) {
            $('.specialization-list-selected').append('<div class="specialization-list-selected__item">' + $(element).html() + '</div>');
            $("<input>", {
                'type':'hidden',
                'class':model+'-specialization',
                'name':model+name,
                'value':$(element).data('id')
            }).appendTo(".specialization-list-selected");
        });
    });
});


var slider = document.getElementById('cost-line');
var priceMinElement = document.getElementById('cost-line-min'),
    priceMaxElement = document.getElementById('cost-line-max'),
    valueMin = document.getElementById('cost-line-value-min'),
    valueMax = document.getElementById('cost-line-value-max');

var priceMin = parseInt($(priceMinElement).val());
var priceMax = parseInt($(priceMaxElement).val());
var numberMin = parseInt($(valueMin).val());
var numberMax = parseInt($(valueMax).val());
if(slider)
{
    noUiSlider.create(slider, {
        start: [numberMin, numberMax],
        connect: true,
        range: {
            'min': priceMin,
            'max': priceMax
        }
    });


// When the slider value changes, update the input and span
    slider.noUiSlider.on('update', function (values, handle) {
        if (handle) {
            valueMin.value = values[handle];
        } else {
            valueMax.value = values[handle];
        }
    });
}


    //// When the input changes, set the slider value
    //valueInput.addEventListener('change', function () {
    //     slider.noUiSlider.set([null, this.value]);
    //});
$(document).ready(function () {
    $('.filter__title').click(function () {
        if ($(this).parent().hasClass('active')) {
            $(this).parent().removeClass('active');
            $(this).parent().children('.filter__list').removeClass('active').slideUp();
            $(this).parent().children('.filter__select-all').hide();
        } else {
            $(this).parent().addClass('active');
            $(this).parent().children('.filter__list').addClass('active').slideDown();
            $(this).parent().children('.filter__select-all').show();
        }
    });
    $('.filter-item').click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $(this).children('input[type=checkbox]').attr('checked', false);
        } else {
            $(this).addClass('active');
            $(this).children('input[type=checkbox]').attr('checked', true);
        }
    });
    $('.filter__select-all').click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $(this).html('Выбрать все');
            $(this).parent().children().children().removeClass('active').children().attr('checked', false);
        } else {
            $(this).addClass('active');
            $(this).html('Снять выбор');
            $(this).parent().children().children().addClass('active').children().attr('checked', true);
        }
    });

    $(".filter__title").each(function(){
       part2 = $(this);
        itemsContainer = part2.next().next();
        $('.filter-item',itemsContainer).each(function(){
            listItem = $(this);

            if(listItem.hasClass('active'))
            {
                part2.addClass("active");
                part2.parent().addClass("active");
                listItem.parent().addClass("active");
                return true;
            }
        });
    });

    $("#main-specialization-form .specialization__btn").click(function(e){
        var element = $(this),
            parent = element.parents("#main-specialization-form");

        parent.submit();
    });

    $("._tender").click(function(){
        $.get("/site/cookie",{"name":"customer"});
    });

    $("._contractor").click(function () {
        $.get("/site/cookie", {"name": "contractor"});
    });

    $("#tender-negotiable").click(function () {
        var element = $(this),
            parent = element.parents('.registration-contractor-form__row'),
            inputElement = parent.find('#tender-price');

        if(element.prop('checked') == true){
            inputElement.prop('readonly','readonly');
        }else{
            inputElement.prop('readonly','');
        }
    });

    $("._inviteToTender").click(function(){
        var element = $(this),
            url = element.attr('href');
        $.get(url,{},function(html){
           $("#inviteToTenderBody").html(html);
        });
        return false;
    });

    $("#inviteToTenderWindow").on('click','._tender_notify',function(){
        var element = $(this),
            url = element.attr('href');

        $.get(url,{},function(html){
            $("#inviteToTenderBody").html(html);
            setTimeout(function(){
                $("#inviteToTenderWindow .modal__close").click();
            },2000);
        });

        return false;
    });

    $('.steps-part li').on('click', function () {
        $('.steps-part li').removeClass('active');
        $(this).addClass('active');

    })
});