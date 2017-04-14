$(function() {
  var formEl = '#form-notice';
  if( $(formEl).length > 0 ) {
    const vmNotice = new Vue({
      el: formEl,
      data: {
        submit: false,
        evaluationTypes: [],
        notice: {},
        settings: {
          purchase: false,
          submission: false,
          award: false,
          evaluation: false,
        },
        noticeEvaluations: {},
        events: [],
        qualifications: [],
        files: [],
        allocations: [],
        submissionRequirements: [],
        evaluationRequirements: [],
        placeholders: {
          event: {
            id: null,
            name: '',
            schedule_at: '',
            location: '',
            required: false,
            type_id: null
          },
          evaluationRequirement: {
            id: null,
            required: false,
            title: '',
            full_score: '',
            type_id: '',
          },
          submissionRequirement: {
            id: null,
            title: '',
            field_required: false,
            field_type: '',
            type_id: null
          },
          qualification: {
            group: '',
            join_rule: '',
            inner_rule: '',
            codes: []
          },
          file: {
            id: null,
            file: null,
            upload: null
          },
        }
      },
      methods: {
        initialize: function() {
          if( 'notice' in window ) {
            this.notice = window.notice;
          }

          if ( 'evaluationTypes' in window ) {
            this.evaluationTypes = window.evaluationTypes
          }

          if( 'noticeEvaluations' in window ) {
            for (var i = 0; i < this.evaluationTypes.length; i++) {
              type = this.evaluationTypes.filter(function(item) {
                return item.id == window.noticeEvaluations[i].type_id;
              });

              if ( type ) {
                this.noticeEvaluations[type.slug] = window.noticeEvaluations[i];
              }
            }
          }

          if ( 'vendor' in window ) {
            this.vendor = window.vendor;
          }

          if( 'events' in window ) {
            for (var i = 0; i < window.events.length; i++) {
              this.events.push(window.events[i]);
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
        addEvent: function() {
          this.events.push(jQuery.extend(true, {}, this.placeholders.event))
        },
        addAllocation: function() {
          this.allocations.push(jQuery.extend(true, {}, this.placeholders.allocation))
        },
        addEvaluationRequirement: function() {
          this.evaluationRequirements.push(jQuery.extend(true, {}, this.placeholders.evaluationRequirement));
        },
        addSubmissionRequirement: function() {
          this.submissionRequirements.push(jQuery.extend(true, {}, this.placeholders.submissionRequirement));
        },
        addFile: function() {
          this.files.push(jQuery.extend(true, {}, this.placeholders.file));
        },
        addQualification: function() {
          this.qualifications.push(jQuery.extend(true, {}, this.placeholders.qualification));
        },
        addQualificationCode: function(index, codeId) {
          this.qualifications[index]['codes'].push(codeId);
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
        }
      },
      mounted: function() {
        this.initialize();
      },
    });
  }
});
