$(document).ready(function() {
  var cartEl = '#cart';
  if($(cartEl).length > 0) {
    const vmCart = new Vue({
      el: cartEl,
      data: {
        items: [],
        payment: false,
        subTotal: 0.00,
        tax: 0.00,
        total: 0.00,
        gateways: [],
        gatewayId: "",
      },
      methods: {
        initialize: function() {
          this.subTotal = numeral(this.subTotal);
          this.tax = numeral(this.tax);
          this.total = numeral(this.total);
          
          if ('items' in window) {
            for(var i = 0; i < window.items.length; i++) {
              item = window.items[i];
              item.price = numeral(item.price);
              item.tax = numeral(item.tax);
              item.total = numeral(item.total);
              this.items.push(item);

              this.subTotal = this.subTotal.add(item.price.format('0.00'));
              this.tax = this.tax.add(item.tax.format('0.00'));
              this.total = this.total.add(item.total.format('0.00'));
            }
          }

          if('gateways' in window) {
            for (var i = 0; i < window.gateways.length; i++) {
              this.gateways.push(window.gateways[i]);
            }
          }
        },
        checkout: function() {
          this.payment = true;
        },
        cancelCheckout: function() {
          this.payment = false;
          this.gatewayId = "";
        }
      },
      mounted: function() {
        this.initialize();
      }
    });
  }
});
