$(document).ready(function(){
  
  var eligibleEl = '#modal-eligible';

  if($(eligibleEl).length > 0 ) {
    const vmEligible = new Vue({
      el: eligibleEl,
      data: {
        vendorId: -1,
        remarks: ""
      },
      mounted: function() {
        selectField = eligibleEl + ' #vendor_id';
        var _vm = this;
        $(selectField).select2({
          ajax: {
            url: $(selectField).data('url'),
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
          minimumInputLength: 3,
          placeholder: {
            id: -1,
            text: $(selectField).data('placeholder')
          },
          templateResult: function(repo) {
            if(repo.loading) {
              return repo.text;
            }

            if(repo.id === '') {
              return $(selectField).data('placeholder');
            }

            return repo.registration_number + " - " + repo.name;
          },
          templateSelection: function(repo) {
            if(repo.id === '') {
              return $(selectField).data('placeholder');
            }

            return repo.registration_number + " - " + repo.name;
          }
        }).on('select2:select', function(event) {
          _vm.vendorId = event.params.data.id;
        });
      }
    });
  }

  var invitationEl = '#modal-invitation';

  if($(invitationEl).length > 0) {
    const vmInvitation = new Vue({
      el: invitationEl,
      data: {
        vendorIds: []
      },
      mounted: function() {
        selectField = invitationEl + ' #vendor_ids';
        var _vm = this;
        $(selectField).select2({
          ajax: {
            url: $(selectField).data('url'),
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
          minimumInputLength: 3,
          placeholder: {
            id: -1,
            text: $(selectField).data('placeholder')
          },
          templateResult: function(repo) {
            if(repo.loading) {
              return repo.text;
            }

            if(repo.id === '') {
              return $(selectField).data('placeholder');
            }

            return repo.registration_number + " - " + repo.name;
          },
          templateSelection: function(repo) {
            if(repo.id === '') {
              return $(selectField).data('placeholder');
            }

            return repo.registration_number + " - " + repo.name;
          }
        }).on('select2:select', function(event) {
          _vm.vendorIds.push(event.params.data.id);
        });
      }
    });
  }
});



 var submissionsEl = '#form-submissions';

  if($(submissionsEl).length > 0 ) {
    const vmSubmissions = new Vue({
      el: submissionsEl,
      data: {
        submissions: []
      },
      mounted: function() {
        if('submissions' in window) {
          for(var i = 0; i < window.submissions.length; i++) {
            data = window.submissions[i];
            data.price = numeral(data.price);

            if(data.submitted_at) {
              data.submitted_at = moment(data.submitted_at);
            } else {
              data.submitted_at = null;
            }

            this.submissions.push(data);
          }
        }

        this.$nextTick(function() {
          $(submissionsEl + ' select.evaluators').each(function() {
            $(this).select2({
              containerCssClass: 'bg-slate-300',
              dropdownCssClass: 'bg-slate-300',
              width: '100%'
            });
          });

          $(submissionsEl + ' #status_submission').each(function() {
            $(this).select2({
              containerCssClass: 'bg-blue-700',
              dropdownCssClass: 'bg-blue-700',
              width: '250px'
            });
          });
        });
      },
      methods: {
        save: function() {
          $(this.$el).submit();
        }
      }
    });
  }