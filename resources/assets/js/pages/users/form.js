
  var formEl = '#form-admin-user';

    const vmAdminUser = new Vue({
      el: formEl,
      data: {
        hasOrganization: false,
        hasVendor: false,
        roleIds: [],
      },
      methods: {
        initialize() {
          this.roleIds = $(formEl + ' select#roles').val();
          this.updateHas();

          this.$nextTick(function() {
            var _vm = this;
            $(formEl + ' select#roles').select2({
              containerCssClass: 'bg-slate-300',
              dropdownCssClass: 'bg-slate-300',
              width: '100%'
            }).on('select2:close', function(event) {
              _vm.roleIds = $(this).val();
              _vm.updateHas();
            });

            this.mountOrganization();
            this.mountVendor();

            $(formEl + ' select#vendors').select2({
              containerCssClass: 'bg-slate-300',
              dropdownCssClass: 'bg-slate-300',
              width: '100%'
            });
          });
        },
        updateHas() {
          this.hasOrganization = false;
          this.hasVendor = false;

          for(var i = 0; i < this.roleIds.length; i++) {
            roleId = this.roleIds[i];

            if(window.roles[roleId].indexOf('has:organization') > -1 && !this.hasOrganization) {
              this.hasOrganization = true;
              
              this.$nextTick(function() {
                this.mountOrganization();
              });
            }

            if(window.roles[roleId].indexOf('has:vendor') > -1 && !this.hasVendor) {
              this.hasVendor = true;

              this.$nextTick(function() {
                this.mountVendor();
              });
            }
          }
        },
        mountOrganization() {
          var _vm = this;
          var selectField = formEl + ' select#organizations';

          if( $(selectField).hasClass('select2-hidden-accessible') ) {
            return;
          }

          $(selectField).select2({
            containerCssClass: 'bg-slate-300',
            dropdownCssClass: 'bg-slate-300',
            width: '100%',
            minimumInputLength: 2,
            ajax: {
              url: $(selectField).data('url'),
              headers: {
                'Authorization': 'Bearer ' + window.Laravel.apiToken
              },
              dataType: 'json',
              delay: 250,
              data: function(params) {
                return {
                  q: params.term
                }
              },
              processResults: function(data, params) {
                return {
                  results: data
                }
              },
            },
            escapeMarkup: function (markup) {
              return markup;
            },
            templateResult: function(repo) {
              if(repo.loading) {
                return repo.text;
              }

              if(repo.id === '') {
                return '';
              }

              return repo.name;
            },
            templateSelection: function(repo) {
              if(repo.id === '') {
                return '';
              }

              if(repo.text) {
                return repo.text
              }

              return repo.name;
            }
          });
        },
        mountVendor() {
          var _vm = this;
          var selectField = formEl + ' select#vendors';

          if( $(selectField).hasClass('select2-hidden-accessible') ) {
            return;
          }

          $(selectField).select2({
            containerCssClass: 'bg-slate-300',
            dropdownCssClass: 'bg-slate-300',
            width: '100%',
            minimumInputLength: 3,
            ajax: {
              url: $(selectField).data('url'),
              headers: {
                'Authorization': 'Bearer ' + window.Laravel.apiToken
              },
              dataType: 'json',
              delay: 250,
              data: function(params) {
                return {
                  q: params.term
                }
              },
              processResults: function(data, params) {
                return {
                  results: data
                }
              },
            },
            escapeMarkup: function (markup) {
              return markup;
            },
            templateResult: function(repo) {
              if(repo.loading) {
                return repo.text;
              }

              if(repo.id === '') {
                return '';
              }

              return repo.registration_number + " - " + repo.name;
            },
            templateSelection: function(repo) {
              if(repo.id === '') {
                return '';
              }

              if(repo.text) {
                return repo.text
              }

              return repo.registration_number + " - " + repo.name;
            }
          });
        }
      },
      mounted() {
        this.initialize();
      },
    });
