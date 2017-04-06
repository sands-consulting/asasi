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

        $(tab).find('.vue-select2').each(function(index, element) {
          $(element).select2();
        });
      });

      $('a[data-toggle="tab"]').on('hidden.bs.tab', function (e) {
        tab = $(this).attr('href');
        $(tab).find('.vue-select2').each(function(index, element) {
          $(element).select2('destroy');
        });
      });

      if(!this.admin) {
        $('.list-vendor[role="tablist"] > li').each(function(index, element) {
          if(index > 0) {
            $(element).find('a').addClass('disabled');
          }
        });

        $('.list-vendor[role="tablist"] a').click(function(event) {
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
    }
  },
  mounted: function() {
    this.initialize();
  },
});
