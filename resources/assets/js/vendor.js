vm_vendor = new Vue({
  el: '.form-vendor',
  data: {
    last_tab: false,
    shareholders: [],
    employees: [],
    accounts: []
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
    setDelete: function(object) {
      object._delete = true;
    },
    addShareholder: function() {
      this.shareholders.push({id: null, name: '', identity_number: '', nationality_id: null, _delete: false})
    },
    addEmployee: function() {
      this.employees.push({id: null, name: '', designation: '', role: '', _delete: false})
    },
    addAccount: function() {
      this.accounts.push({id: null, account_name: '', account_number: '', account_bank_name: '', account_bank_iban: '', account_bank_address: '', _delete: false})
    }

  }
});