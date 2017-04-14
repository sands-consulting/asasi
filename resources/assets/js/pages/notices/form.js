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
        submissionRequirements: {},
        evaluationRequirements: {},
        placeholders: {
          event: {
            id: null,
            name: '',
            schedule_at: '',
            location: '',
            required: false,
            type_id: null
          },
          file: {
            id: null,
            name: '',
            type: '',
            file: null,
          },
          allocation: {
            id: "",
            amount: null,
          },
          evaluationRequirement: {
            id: null,
            required: false,
            title: '',
            full_score: ''
          },
          submissionRequirement: {
            id: null,
            title: '',
            field_required: false,
            field_type: ''
          },
          qualification: {
            id: null,
            join_rule: 'and',
            inner_rule: 'and',
            codes: []
          },
          qualificationCode: {
            id: null,
            code_id: ''
          }
        }
      },
      methods: {
        initialize: function() {
          if( 'notice' in window ) {
            this.notice = window.notice;
          }

          if ( 'evaluationTypes' in window ) {
            this.evaluationTypes = window.evaluationTypes;

            for (var i = 0; i < this.evaluationTypes.length; i++) {
              slug = this.evaluationTypes[i].slug;
              this.$set(this.submissionRequirements, slug, []);
              this.$set(this.evaluationRequirements, slug, []);
            }
          }

          if ( 'notice' in window ) {
            this.notice = window.notice;
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
        addEvaluationRequirement: function(type) {
          this.evaluationRequirements[type].push(jQuery.extend(true, {}, this.placeholders.evaluationRequirement));
        },
        addSubmissionRequirement: function(type) {
          this.submissionRequirements[type].push(jQuery.extend(true, {}, this.placeholders.submissionRequirement));
        },
        addFile: function() {
          this.files.push(jQuery.extend(true, {}, this.placeholders.file));
        },
        addQualification: function() {
          qualification = jQuery.extend(true, {}, this.placeholders.qualification);
          qualification.codes.push(jQuery.extend(true, {}, this.placeholders.qualificationCode))
          this.qualifications.push(qualification);
        },
        addQualificationCode: function(index) {
          this.qualifications[index]['codes'].push(jQuery.extend(true, {}, this.placeholders.qualificationCode));
        },
        deleteEvent: function(index) {
          this.events.splice(index, 1);
        },
        deleteFile: function(index) {
          this.files.splice(index, 1);
        },
        deleteAllocation: function(index) {
          this.allocations.splice(index, 1);
        },
        deleteEvaluationRequirement: function(type, index) {
          this.evaluationRequirements[type].splice(index, 1);
        },
        deleteSubmissionRequirement: function(type, index) {
          this.submissionRequirements[type].splice(index, 1);
        },
        deleteQualification: function(index) {
          this.qualifications.splice(index, 1);
        },
        deleteQualificationCode: function(index, codeIndex) {
          this.qualifications[index].codes.splice(codeIndex, 1);
        }
      },
      mounted: function() {
        this.initialize();
      },
    });
  }
});
