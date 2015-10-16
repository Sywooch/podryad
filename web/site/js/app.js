Basket = {
    'selector':{
        'productItemContainer':'._product-list',
        'productItem':'._product-item',
        'count':'._basket-count',
        'checkbox':'._product-checkbox',
        'counterValue':'._counter-value',
        'orderForm':'._order-form',
        'orderItem':'._order-item',
        'orderItemJs':'_order-item',
        'orderClass':'OrderItem'
    },
    'items':[],
    'init':function(){
        Basket.calculate();
    },
    'minus':function(element,min){
        var element = $(element);
        var counterElement = element.next('span').find(Basket.selector.counterValue);
        var counterValue = parseInt(counterElement.val());
        if((counterValue-1) <= min)
            counterValue = min;
        else
            counterValue-=1;
        counterElement.val(counterValue);
        Basket.calculate();
    },
    'plus':function(element){
        var element = $(element);
        var counterElement = element.prev('span').find(Basket.selector.counterValue);
        var counterValue = parseInt(counterElement.val());
        counterValue++;
        counterElement.val(counterValue);
        Basket.calculate();
    },
    'select':function()
    {
        Basket.calculate();
    },
    'calculate':function(){
        var total = {
            'count':0,
            'price':0
        };
        $(Basket.selector.orderForm+' '+Basket.selector.orderItem).remove();


        var i = 0;
        $(Basket.selector.productItemContainer+' ' +Basket.selector.productItem).each(function(){
            var element = this;

            var productId = $(element).data("product-id");
            var checkbox = $(Basket.selector.checkbox,element);

            if(checkbox.prop('checked'))
            {
                var countElement = $(Basket.selector.counterValue,element);
                var count = countElement.val();
                total.count += parseInt(count);

                $("<input>",{
                    'type':'hidden',
                    'value':productId,
                    'name':Basket.selector.orderClass+'['+i+'][productId]',
                    'class':Basket.selector.orderItemJs
                }).appendTo(Basket.selector.orderForm);

                $("<input>",{
                    'type':'hidden',
                    'value':count,
                    'name':Basket.selector.orderClass+'['+i+'][quantity]',
                    'class':Basket.selector.orderItemJs
                }).appendTo(Basket.selector.orderForm);

                i++;
            }
        });
        $(Basket.selector.count).text(total.count);
    }
};