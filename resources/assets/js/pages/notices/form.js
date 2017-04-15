
  var formEl = '#form-notice';

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
            join_rule: 'and',
            group_rule: 'and',
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
          $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            length = $(e.target).parents('ul').children().length;
            iteration = $(e.target).parents('ul').index($(e.target).parents('li')) + 1;
            if( iteration == length ) {
              this.submit = true;
              console.log(this.submit);
            } else {
              this.submit = false;
            }
          });

          if( 'notice' in window ) {
            for(var key in window.notice) {
              if(window.notice.hasOwnProperty(key)) {
                this.$set(this.notice, key, window.notice[key]);
              }
            }
          }

          if( 'settings' in window ) {
            for (var i = 0; i < window.settings.length; i++) {
              this.$set(this.settings, window.settings[i].key, window.settings[i].value);
            }
          }

          if ( 'evaluationTypes' in window ) {
            this.evaluationTypes = window.evaluationTypes;

            for (var i = 0; i < this.evaluationTypes.length; i++) {
              id = this.evaluationTypes[i].id;
              slug = this.evaluationTypes[i].slug;
              this.$set(this.submissionRequirements, slug, []);
              this.$set(this.evaluationRequirements, slug, []);

              this.$set(this.noticeEvaluations, slug, {
                type_id: id,
                start_at: '',
                end_at: ''
              });
            }
          }

          if( 'noticeEvaluations' in window ) {
            for (var i = 0; i < this.noticeEvaluations.length; i++) {
              var evaluation = this.noticeEvaluations[i];
              type = this.evaluationTypes.filter(function(item) {
                return item.id == evaluation.type_id;
              });

              if ( type ) {
                this.$set(this.noticeEvaluations[type.slug], 'start_at', window.noticeEvaluations[i].start_at);
                this.$set(this.noticeEvaluations[type.slug], 'end_at', window.noticeEvaluations[i].end_at);
              }
            }
          }

          if( 'events' in window ) {
            for (var i = 0; i < window.events.length; i++) {
              this.events.push(window.events[i]);
            }
          }

          if( 'allocations' in window ) {
            for (var i = 0; i < window.allocations.length; i++) {
              this.allocations.push({
                id: window.allocations[i].id,
                amount: window.allocations[i].pivot.amount
              });
            }
          }

          if( 'submissionRequirements' in window ) {
            for(var slug in window.submissionRequirements) {
              if(window.submissionRequirements.hasOwnProperty(slug)) {
                data = window.submissionRequirements[slug];
                for(var i = 0; i < data.length; i++) {
                  this.submissionRequirements[slug].push({
                    id: data[i].id,
                    title: data[i].title,
                    field_required: data[i].field_required,
                    field_type: data[i].field_type
                  });
                }
              }
            }
          }

          if( 'evaluationRequirements' in window ) {
            for(var slug in window.evaluationRequirements) {
              if(window.evaluationRequirements.hasOwnProperty(slug)) {
                data = window.evaluationRequirements[slug];
                for(var i = 0; i < data.length; i++) {
                  this.evaluationRequirements[slug].push({
                    id: data[i].id,
                    title: data[i].title,
                    required: data[i].required,
                    full_score: data[i].full_score
                  });
                }
              }
            }
          }

          if( 'qualificationCodes' in window ) {
            for(var group in window.qualificationCodes ) {
              if(window.qualificationCodes.hasOwnProperty(group)) {
                qualification = jQuery.extend(true, {}, this.placeholders.qualification);
                data = window.qualificationCodes[group];
                
                for(var i = 0; i < data.length; i++) {
                  if(i == 0) {
                    qualification.inner_rule = data.inner_rule;
                    qualification.join_rule = data.join_rule;
                  }

                  qualification.codes.push(jQuery.extend(true, {}, {
                    id: data[i].id,
                    code_id: data[i].code_id
                  }));
                }

                this.qualifications.push(qualification);
              }
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
