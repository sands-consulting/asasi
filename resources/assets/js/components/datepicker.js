Vue.component('datepicker-single', {
  template: '<input type="text" v-bind:class="klass" v-bind:name="name">',
  data: function() {
    return {
      options: {
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true
      }
    }
  },
  props: ['name', 'klass', 'single', 'date'],
  mounted: function() {
    var _vm = this;
    
    $(this.$el).daterangepicker(_vm.options).on('apply.daterangepicker', function(event, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD'));
      _vm.$emit('input', $(this).val());
    });

    if(this.date) {
      $(this.$el).val(this.date);
      $(this.$el).data('daterangepicker').setStartDate(moment(this.date));
      $(this.$el).data('daterangepicker').setEndDate(moment(this.date));
    }
  }
});

Vue.component('datetimepicker-single', {
  template: '<input type="text" v-bind:class="klass" v-bind:name="name" v-model="date">',
  data: function() {
    return {
      options: {
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        timePicker: true
      }
    }
  },
  props: ['name', 'klass', 'single', 'date'],
  mounted: function() {
    var _vm = this;
    
    $(this.$el).daterangepicker(_vm.options).on('hide.daterangepicker', function(event, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm:00'));
      _vm.$emit('input', $(this).val());
    });

    if(this.date) {
      $(this.$el).val(this.date);
      $(this.$el).data('daterangepicker').setStartDate(moment(this.date));
      $(this.$el).data('daterangepicker').setEndDate(moment(this.date));
    }
  }
});
