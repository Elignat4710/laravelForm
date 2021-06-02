<template>
  <div class="container-fluid">
    <div class="row justify-content-center mt-0">
      <div class="col-11 col-sm-9 col-md-7 col-lg-6 p-0 mt-3 mb-2">
        <div class="px-0 pt-4 pb-0 mt-3 mb-3">
          <h2 class="text-center">
            <strong
              >To participate in the conference, please fill out the
              form</strong
            >
          </h2>
          <form>
            <div class="step">
              <fieldset class="form-group">
                <a
                  class="btn btn-block btn-social btn-twitter full text-center"
                  :href="
                    'http://twitter.com/share?text=' +
                    share['text'] +
                    '&url=' +
                    share['link']
                  "
                >
                  <i class="fab fa-twitter"></i>
                  Share with your friends on twitter
                </a>
              </fieldset>
              <fieldset class="form-group">
                <a
                  class="btn btn-block btn-social btn-facebook full text-center"
                  :href="
                    'http://www.facebook.com/sharer.php?u=' + share['link']
                  "
                >
                  <i class="fa fa-twitter"></i>
                  Share with your friends on facebook
                </a>
              </fieldset>
              <fieldset class="form-group">
                <router-link
                  :to="'listprofiles'"
                  class="btn btn-danger btn-block text-center"
                  >All Members: {{ count }}</router-link
                >
              </fieldset>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Third",
  data() {
    return {
      count: null,
      share: null,
    };
  },
  mounted() {
    axios.get("api/count").then((response) => {
      this.count = response.data.count;
      this.share = response.data.share;
    });
  },
};
</script>