vm_vendor = new Vue({
  el: '.form-vendor',
  data: {
    last_tab: false,
    accounts: [],
    employees: [],
    shareholders: [],
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
        role: ''
      },
      shareholder: {
        id: null,
        name: '',
        identity_number: '',
        nationality_id: null
      }
    }
  },
  ready: function() {
    for (var i = Vendor.accounts.length - 1; i >= 0; i--) {
      this.accounts.push(Vendor.accounts[i]);
    }

    for (var i = Vendor.employees.length - 1; i >= 0; i--) {
      this.employees.push(Vendor.employees[i]);
    }

    for (var i = Vendor.shareholders.length - 1; i >= 0; i--) {
      this.shareholders.push(Vendor.shareholders[i]);
    }
  },
  methods: {
    next: function() {
      active = $(this.$el).find('.nav').find('[role=presentation].active');
      active.removeClass('active');
      $(active.find('a').attr('href')).hide('tab');

      next = active.next();
      next.addClass('active');
      $(next.find('a').attr('href')).show('tab');

      this.$nextTick(function () {
        this.last_tab = this.updateLastTab();
      });
    },
    show: function(event) {
      active = $(this.$el).find('.nav').find('[role=presentation].active');
      active.removeClass('active');
      $(active.find('a').attr('href')).hide('tab');

      selected = $(event.target);
      selected.parents('[role=presentation]').addClass('active');
      $(selected.attr('href')).show('tab');

      this.$nextTick(function () {
        this.last_tab = this.updateLastTab();
      });

      return false;
    },
    updateLastTab: function() {
      nav       = $(this.$el).find('.nav');
      num_tabs  = nav.find('[role=presentation]').length;
      current   = nav.find('.active');

      return current.index() == (num_tabs - 1);
    },
    deleteItem: function(collections, index) {
      collections.splice(index, 1);
    },
    addAccount: function() {
      this.accounts.push(JSON.parse(JSON.stringify(this.placeholders.account)));
    },
    addEmployee: function() {
      this.employees.push(JSON.parse(JSON.stringify(this.placeholders.employee)));
    },
    addShareholder: function() {
      this.shareholders.push(JSON.parse(JSON.stringify(this.placeholders.shareholder)));
    }
  }
});