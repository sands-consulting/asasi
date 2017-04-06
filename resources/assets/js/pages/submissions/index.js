
const vm = new Vue({
  el: '#submission-wrapper',
  data: {},
  mounted: function () {
    this.getRequirementType();
  },
  methods: {
    getRequirementType: function () {
      axios.get('/user?ID=12345')
        .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  }
});