$(function() {
  vmVendor.$mount('#form-vendor');
});

const vmVendor = new Vue({
  data: {
    submit: false,
    admin: true,
    vendor: {},
    qualifications: {},
    shareholders: [],
    employees: [],
    accounts: [],
    files: [],
    placeholders: {
      account: {
        id: null,
        account_name: '',
        account_number: '',
        bank_name: '',
        bank_iban: '',
        bank_address: ''
      },
      employee: {
        id: null,
        name: '',
        designation: '',
        role: '',
        nationality_id: null
      },
      shareholder: {
        id: null,
        name: '',
        identity_number: '',
        nationality_id: null,
        percentage: 0.00
      },
      file: {
        id: null,
        type_id: null,
        file: null
      },
      code: {
        id: null,
        code_id: null,
        children: []
      }
    }
  },
  methods: {
    initialize: function() {
      this.admin = $(this.$el).hasClass('admin');

      if(!this.admin) {
        $(this.$el).find('.list-vendor[role="tablist"] > li').each(function(index, element) {
          if(index > 0) {
            $(element).find('a').addClass('disabled');
          }
        });

        $(this.$el).find('.list-vendor[role="tablist"] a').click(function(event) {
          if($(this).hasClass('disabled')) {
            event.stopPropagation();
          }
        });
      }

      var _vm = this;
      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        length = $(this).parents('ul').children().length;
        iteration = $(this).parents('li').index() + 1;

        if( iteration == length ) {
          _vm.$data.submit = true;
        } else {
          _vm.$data.submit = false;
        }
      });

      for (var i = window.qualifications.length - 1; i >= 0; i--) {
        id = window.qualifications[i].id;
        type = window.qualifications[i].type;
        depth = window.qualifications[i].depth;
        code = window.qualifications[i].code;

        if(depth == 0) {
          newType = {};
          newType[code] = {
            id: id,
            start_at: null,
            end_at: null,
            reference_one: null,
            reference_two: null
          };

          if(type == 'list') {
            newType[code]['codes'] = [];
          }
          this.qualifications = Object.assign({}, this.qualifications, newType);
        }
      }

      if('vendor' in window) {
        if('accounts' in window.vendor) {
          for (var i = window.vendor.accounts.length - 1; i >= 0; i--) {
            this.accounts.push({
              id: window.vendor.accounts[i].id,
              account_name: window.vendor.accounts[i].account_name,
              account_number: window.vendor.accounts[i].account_number,
              bank_name: window.vendor.accounts[i].bank_name,
              bank_iban: window.vendor.accounts[i].bank_iban
            });
          }
        }

        if('employees' in window.vendor) {
          for (var i = window.vendor.employees.length - 1; i >= 0; i--) {
            this.employees.push({
              id: window.vendor.employees[i].id,
              name: window.vendor.employees[i].name,
              designation: window.vendor.employees[i].designation,
              role: window.vendor.employees[i].role,
              nationality_id: window.vendor.employees[i].nationality_id
            });
          }
        }

        if('shareholders' in window.vendor) {
          for (var i = window.vendor.shareholders.length - 1; i >= 0; i--) {
            this.shareholders.push({
              id: window.vendor.shareholders[i].id,
              name: window.vendor.shareholders[i].name,
              identity_number: window.vendor.shareholders[i].identity_number,
              nationality_id: window.vendor.shareholders[i].nationality_id,
              percentage: window.vendor.shareholders[i].percentage
            });
          }
        }
      }
    },
    next: function() {
      trigger = $('[role="tablist"] > .active').next('li').find('a');

      if(trigger.hasClass('disabled')) {
        trigger.removeClass('disabled')
      }

      trigger.trigger('click');
    },
    addShareholder: function() {
      this.shareholders.push(jQuery.extend(true, {}, this.placeholders.shareholder));
    },
    addEmployee: function() {
      this.employees.push(jQuery.extend(true, {}, this.placeholders.employee));
    },
    addAccount: function() {
      this.accounts.push(jQuery.extend(true, {}, this.placeholders.account));
    },
    addFile: function() {
      this.files.push(jQuery.extend(true, {}, this.placeholders.code));
    },
    addCode: function(code) {
      this.qualifications[code].push(jQuery.extend(true, {}, this.placeholders.code));
    },
    addChildCode: function(code, index) {
      this.qualifications[code]['codes'][index]['children'].push(jQuery.extend(true, {}, this.placeholders.code));
    },
    deleteShareholder: function(index) {
      this.shareholders.splice(index, 1);
    },
    deleteEmployee: function(index) {
      this.employees.splice(index, 1);
    },
    deleteAccount: function(index) {
      this.accounts.splice(index, 1);
    },
    deleteFile: function(index) {
      this.files.splice(index, 1);
    },
    deleteCode: function(code, index) {
      this.qualifications[code].splice(index, 1);
    },
    deleteChildCode: function(code, index, childIndex) {
      this.qualifications[code]['codes'][index]['children'].splice(childIndex, 1);
    }
  },
  mounted: function() {
    this.initialize();
  },
});
