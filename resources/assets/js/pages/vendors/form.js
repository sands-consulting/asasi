$(function() {
  var formEl = '#form-vendor';
  if( $(formEl).length > 0 ) {
    const vmVendor = new Vue({
      el: formEl,
      data: {
        submit: false,
        admin: false,
        vendor: {},
        address: {
          line_one: '',
          line_two: '',
          postcode: '',
          city_id: "",
          state_id: "",
          country_id: ""
        },
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
      computed: {
        countries: function() {
          return window.places.filter(function(place) {
            return place.type == 'country';
          }).sort(function(p0, p1) {
            return p0.name.localeCompare(p1.name);
          });
        },
        states: function() {
          var _vm = this;
          if(!this.address.country_id || this.address.country_id.length == 0) {
            return [];
          } else {
            return window.places.filter(function(place) {
              return place.type == 'state' && place.parent_id == _vm.address.country_id;
            }).sort(function(p0, p1) {
              return p0.name.localeCompare(p1.name);
            });
          }
        },
        cities: function() {
          var _vm = this;
          if(!this.address.state_id || this.address.state_id.length == 0) {
            return [];
          } else {
            return window.places.filter(function(place) {
              return place.type == 'city' && place.parent_id == _vm.address.state_id;
            }).sort(function(p0, p1) {
              return p0.name.localeCompare(p1.name);
            });
          }
        }
      },
      methods: {
        initialize: function() {
          if( 'admin' in window ) {
            this.admin = window.admin;
          }

          if(!this.admin) {
            $(formEl).find('.list-vendor[role="tablist"] > li').each(function(index, element) {
              if(index > 0) {
                $(element).find('a').addClass('disabled');
              }
            });

            $(formEl).find('.list-vendor[role="tablist"] a').click(function(event) {
              if($(this).hasClass('disabled')) {
                event.stopPropagation();
              }
            });
          }

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

            if('address' in window.vendor) {
              for(key in this.address) {
                this.address[key] = window.vendor.address[key];
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

          if(trigger.attr('href') == '#tab-vendor-files') {
            this.enableSubmit();
          } else {
            this.disableSubmit();
          }
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
        },
        enableSubmit: function() {
          this.submit = true;
        },
        disableSubmit: function() {
          this.submit = false;
        }
      },
      mounted: function() {
        this.initialize();
      },
    });
  }
});
