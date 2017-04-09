$(function() {
  if( $('#form-subscription').length > 0 ) {
    const vmSubscription = new Vue({
      el: '#form-subscription',
      data: {
        selectedPackage: null,
        paymentMethod: null,
        packages: [],
        startDate: null,
        endDate: null,
        fee: 0.00,
        tax: 0.00,
        amount: 0.00,
        gateways: [],
        gateway_id: null,
      },
      methods: {
        initialize: function() {
          if ('packages' in window) {
            for (var i = window.packages.length - 1; i >= 0; i--) {
              this.packages.push(window.packages[i]);
            }
          }

          if('gateways' in window) {
            for (var i = window.gateways.length - 1; i >= 0; i--) {
              this.gateways.push(window.gateways[i]);
            }
          }

          if('startDate' in window) {
            this.startDate = moment(window.startDate);
          }
        },
        selectPackage: function(package) {
          this.selectedPackage = package;
          this.endDate = moment(this.startDate).add(package.validity_quantity, package.validity_type);
          this.fee = numeral(package.fee);
          this.tax = numeral(package.fee).multiply(package.tax_code.rate).divide(100);
          this.amount = numeral(package.fee).add(this.tax.value());
        },
        cancelPackage: function() {
          this.selectedPackage = null
          this.endDate = null;
          this.fee = 0.00;
          this.tax = 0.00;
          this.amount = 0.00;
          this.gateway = null;
        }
      },
      mounted: function() {
        this.initialize();
      }
    });
  }
});
