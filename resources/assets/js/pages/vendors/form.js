$(function() {
  vmVendor.$mount('#form-vendor');
});

const vmVendor = new Vue({
  data: {
    submit: false,
    admin: true,
    vendor: {},
    qualifications: [],
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
      }
    }
  },
  methods: {
    initialize: function() {
      this.admin = $(this.$el).hasClass('admin');

      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        tab = $(this).attr('href');
        length = $(this).parents('ul').children().length;
        iteration = parseInt($(this).parents('li').index()) + 1;

        if( iteration == length ) {
          this.submit = true;
        } else {
          this.submit = false;
        }
      });

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
    },
    next: function() {
      trigger = $('[role="tablist"] > .active').next('li').find('a');

      if(trigger.hasClass('disabled')) {
        trigger.removeClass('disabled')
      }

      trigger.trigger('click');
    },
    addShareholder: function() {
      this.shareholders.push(this.placeholders.shareholder);
    },
    addEmployee: function() {
      this.employees.push(this.placeholders.employee);
    },
    addAccount: function() {
      this.accounts.push(this.placeholders.account);
    },
    deleteShareholder: function(index) {
      this.shareholders.splice(index, 1);
    },
    deleteEmployee: function(index) {
      this.employees.splice(index, 1);
    },
    deleteAccount: function(index) {
      this.accounts.splice(index, 1);
    }
  },
  mounted: function() {
    this.initialize();
  },
});
