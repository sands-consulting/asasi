$(function() {
  var cartEl = '#cart';
  if( $(cartEl).length > 0 ) {
    const vmCart = new Vue({
      el: cartEl,
      data: {
        items: [],
        checkout: false,
        subTotal: 0.00,
        tax: 0.00,
        total: 0.00,
        gateways: [],
        gatewayId: null,
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

              this.subTotal = this.subTotal.add(item.price);
              this.tax = this.tax.add(item.tax);
              this.total = this.total.add(item.total);
            }
          }

          if('gateways' in window) {
            for (var i = 0; i < window.gateways.length; i++) {
              this.gateways.push(window.gateways[i]);
            }
          }
        },
        checkout: function() {
          this.checkout = true;
        },
        cancelCheckout: function() {
          this.checkout = false;
          this.gatewayId = null;
        }
      },
      mounted: function() {
        this.initialize();
      }
    });
  }
});
