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
        nationality_id: null
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
        type = window.qualifications[i].type;
        depth = window.qualifications[i].depth;
        code = window.qualifications[i].code;

        if(type == 'list' && depth == 0) {
          newType = {};
          newType[code] = [];
          this.qualifications = Object.assign({}, this.qualifications, newType);
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
      this.qualifications[code][index]['children'].push(jQuery.extend(true, {}, this.placeholders.code));
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
      this.qualifications[code][index]['children'].splice(childIndex, 1);
    }
  },
  mounted: function() {
    this.initialize();
  },
});
