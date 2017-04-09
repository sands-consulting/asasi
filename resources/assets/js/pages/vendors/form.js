$(function() {
  if( $('#form-vendor').length > 0 ) {
    vmVendor.$mount('#form-vendor');
  }
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
        file: null,
        upload: null
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
            start_at: '',
            end_at: '',
            reference_one: '',
            reference_two: ''
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

        if('files' in window.vendor) {
          for (var i = window.vendor.files.length - 1; i >= 0; i--) {
            this.files.push({
              id: window.vendor.files[i].id,
              type_id: window.vendor.files[i].type_id,
              file: null,
              upload: window.vendor.files[i].upload
            });
          }
        }

        if('qualifications' in window.vendor) {
          for (var i = window.vendor.qualifications.length - 1; i >= 0; i--) {
            code = window.vendor.qualifications[i].type.code;

            this.qualifications[code].reference_one = window.vendor.qualifications[i].reference_one;
            this.qualifications[code].reference_two = window.vendor.qualifications[i].reference_two;
            this.qualifications[code].start_at = window.vendor.qualifications[i].start_at;
            this.qualifications[code].end_at = window.vendor.qualifications[i].end_at;
          }
        }

        if('qualification_codes' in window.vendor) {
          for (var i = window.vendor.qualification_codes.length - 1; i >= 0; i--) {
            type = window.vendor.qualification_codes[i].type.type
            code = window.vendor.qualification_codes[i].type.code;
            id = window.vendor.qualification_codes[i].id;
            codeId = window.vendor.qualification_codes[i].code_id;
            children = [];

            if(type == 'list') {
              if('children' in window.vendor.qualification_codes[i]) {
                for (var ii = window.vendor.qualification_codes[i].children.length - 1; ii >= 0; ii--) {
                  children.push({
                    id: window.vendor.qualification_codes[i].children[ii].id,
                    code_id: window.vendor.qualification_codes[i].children[ii].code_id
                  });
                }
              }

              this.qualifications[code].codes.push({
                id: id,
                code_id: codeId,
                children: children
              });
            }
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
      this.qualifications[code]['codes'].push(jQuery.extend(true, {}, this.placeholders.code));
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
      this.qualifications[code]['codes'].splice(index, 1);
    },
    deleteChildCode: function(code, index, childIndex) {
      this.qualifications[code]['codes'][index]['children'].splice(childIndex, 1);
    }
  },
  mounted: function() {
    this.initialize();
  },
});
