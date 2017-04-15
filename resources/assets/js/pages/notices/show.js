

  var eligibleEl = '#modal-eligible';

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

            console.log(repo);

            return repo.registration_number + " - " + repo.name;
          }
        }).on('select2:select', function(event) {
          _vm.vendorId = event.params.data.id;
        });
      },
      methods: {
        onFileChanged: function(event) {
          console.log(event.target);
        }
      }
    });

