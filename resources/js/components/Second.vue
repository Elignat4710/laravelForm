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
          <form
            @submit.prevent="registerSecondStep"
            enctype="multipart/form-data"
            id="second"
          >
            <div class="step">
              <fieldset class="form-group">
                <label for="company">Company</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="form.company"
                  id="company"
                  name="company"
                  :class="{ 'is-invalid': submitted && $v.form.company.$error }"
                />
                <div
                  class="invalid-feedback"
                  v-if="submitted && $v.form.company.$error"
                >
                  <span v-if="!$v.form.company.max"
                    >This field must be less then 100 characters</span
                  >
                </div>
              </fieldset>
              <fieldset class="form-group">
                <label for="position">Position</label>
                <input
                  type="text"
                  class="form-control"
                  id="position"
                  name="position"
                  v-model="form.position"
                  :class="{
                    'is-invalid': submitted && $v.form.position.$error,
                  }"
                />
                <div
                  class="invalid-feedback"
                  v-if="submitted && $v.form.position.$error"
                >
                  <span v-if="!$v.form.position.max"
                    >This field must be less then 100 characters</span
                  >
                </div>
              </fieldset>
              <fieldset class="form-group">
                <label for="aboutMe">AboutMe</label>
                <textarea
                  name="aboutMe"
                  id="aboutMe"
                  rows="5"
                  class="form-control"
                  v-model="form.aboutMe"
                  :class="{ 'is-invalid': submitted && $v.form.aboutMe.$error }"
                ></textarea>
                <div
                  class="invalid-feedback"
                  v-if="submitted && $v.form.aboutMe.$error"
                >
                  <span v-if="!$v.form.aboutMe.max"
                    >This field must be less then 500 characters</span
                  >
                </div>
              </fieldset>
              <fieldset class="form-group">
                <label for="photo">Photo</label>
                <input
                  type="file"
                  class="form-control-file"
                  id="photo"
                  name="photo"
                  v-on:change="uploadPhoto"
                  ref="photo"
                  :class="{ 'is-invalid': submitted && $v.form.photo.$error }"
                />
                <a
                  class="float-right"
                  href="#"
                  @click="clearPhoto"
                  v-if="form.photo != null"
                  id="clear"
                  >Clear photo field</a
                >
                <div
                  class="invalid-feedback"
                  v-if="submitted && $v.form.photo.$error"
                >
                  <span v-if="!$v.form.photo.photoName"
                    >The photo format should be png, jpg and jpeg</span
                  >
                  <span v-if="!$v.form.photo.photoSize"
                    >The photo should be not more then 2 mb</span
                  >
                </div>
              </fieldset>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">Finish</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueCookies from "vue-cookies";
import { maxLength, helpers } from "vuelidate/lib/validators";
import { photoName, photoSize } from "../validators";

export default {
  name: "Second",
  data() {
    return {
      submitted: false,
      form: {
        company: null,
        position: null,
        aboutMe: null,
        photo: null,
      },
    };
  },
  methods: {
    clearPhoto() {
      document.getElementById("photo").value = null;
      this.form.photo = null;
    },
    nextStep() {
      this.$emit("nextStep", {
        step: "third",
      });
    },
    registerSecondStep() {
      this.submitted = true;

      if (this.$v.$invalid) {
        this.$v.$touch();
        return;
      }

      VueCookies.remove("step");

      var userId = VueCookies.get("id");
      let formData = new FormData(document.getElementById("second"));
      axios
        .post("api/second/" + userId, formData)
        .then((response) => {
          console.log(response);
          this.nextStep();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    uploadPhoto() {
      this.form.photo = this.$refs.photo.files[0];
    },
  },
  validations: {
    form: {
      company: { max: maxLength(100) },
      position: { max: maxLength(100) },
      aboutMe: { max: maxLength(500) },
      photo: { photoName, photoSize },
    },
  },
};
</script>