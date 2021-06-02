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
          <form @submit.prevent="registerFirstStep" id="first" novalidate>
            <div class="step">
              <fieldset class="form-group">
                <label for="firstName">First Name</label>
                <input
                  type="text"
                  v-model="form.firstName"
                  class="form-control"
                  id="firstName"
                  name="firstName"
                  :class="{
                    'is-invalid': submitted && $v.form.firstName.$error,
                  }"
                />
                <div
                  v-if="submitted && $v.form.firstName.$error"
                  class="invalid-feedback"
                >
                  <span v-if="!$v.form.firstName.required"
                    >This field is required</span
                  >
                  <span v-else-if="!$v.form.firstName.max"
                    >This field must be less than 100 characters</span
                  >
                </div>
              </fieldset>

              <fieldset class="form-group">
                <label for="lastName">Last Name</label>
                <input
                  type="text"
                  v-model="form.lastName"
                  class="form-control"
                  id="lastName"
                  name="lastName"
                  :class="{
                    'is-invalid': submitted && $v.form.lastName.$error,
                  }"
                />
                <div
                  v-if="submitted && $v.form.lastName.$error"
                  class="invalid-feedback"
                >
                  <span v-if="!$v.form.lastName.required"
                    >This field is required</span
                  >
                  <span v-if="!$v.form.lastName.max"
                    >This field must be less than 100 characters</span
                  >
                </div>
              </fieldset>

              <fieldset class="form-group">
                <label for="birthdate">Birthdate</label>
                <datepicker
                  name="birthdate"
                  format="yyyy-MM-dd"
                  v-model="form.birthdate"
                  :bootstrap-styling="true"
                  id="birthdate"
                  :input-class="{
                    'is-invalid': submitted && $v.form.birthdate.$error,
                  }"
                  :disabled-dates="disabled"
                >
                </datepicker>
                <div
                  v-if="submitted && $v.form.birthdate.$error"
                  class="invalid-feedback"
                >
                  <span v-if="!$v.form.birthdate.required"
                    >This field is required</span
                  >
                </div>
              </fieldset>

              <fieldset class="form-group">
                <label for="reportSubject">Report Subject</label>
                <input
                  type="text"
                  v-model="form.reportSubject"
                  class="form-control"
                  id="reportSubject"
                  name="reportSubject"
                  :class="{
                    'is-invalid': submitted && $v.form.reportSubject.$error,
                  }"
                />
                <div
                  v-if="submitted && $v.form.reportSubject.$error"
                  class="invalid-feedback"
                >
                  <span v-if="!$v.form.reportSubject.required"
                    >This field is required</span
                  >
                  <span v-if="!$v.form.reportSubject.max"
                    >This field must be less than 100 characters</span
                  >
                </div>
              </fieldset>

              <fieldset class="form-group">
                <label for="phone">Phone</label>
                <input
                  type="tel"
                  v-model="form.phone"
                  v-mask="'+# (###) ###-####'"
                  class="form-control"
                  id="phone"
                  name="phone"
                  :class="{ 'is-invalid': submitted && $v.form.phone.$error }"
                />
                <div
                  v-if="submitted && $v.form.phone.$error"
                  class="invalid-feedback"
                >
                  <span v-if="!$v.form.phone.required"
                    >This field is required</span
                  >
                  <span v-if="!$v.form.phone.min"
                    >The field is not fully filled</span
                  >
                </div>
              </fieldset>

              <fieldset class="form-group">
                <label for="email">Email</label>
                <input
                  type="email"
                  v-model="form.email"
                  class="form-control"
                  id="email"
                  name="email"
                  :class="{ 'is-invalid': submitted && $v.form.email.$error }"
                />
                <div
                  v-if="submitted && $v.form.email.$error"
                  class="invalid-feedback"
                >
                  <span v-if="!$v.form.email.required"
                    >This field is required</span
                  >
                  <span v-else>Please enter a correct email</span>
                </div>
              </fieldset>

              <fieldset class="form-group">
                <label for="countryId">Country</label>
                <select
                  name="countryId"
                  v-model="form.countryId"
                  id="countryId"
                  class="form-control"
                  :class="{
                    'is-invalid': submitted && $v.form.countryId.$error,
                  }"
                >
                  <option
                    :value="country['id']"
                    v-for="country in countries"
                    :key="country['id']"
                  >
                    {{ country["name"] }}
                  </option>
                </select>
                <div
                  v-if="submitted && $v.form.countryId.$error"
                  class="invalid-feedback"
                >
                  <span v-if="!$v.form.countryId.required"
                    >This field is required</span
                  >
                </div>
              </fieldset>

              <div class="text-right">
                <button type="submit" class="btn btn-primary">Next</button>
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
import Datepicker from "vuejs-datepicker";
import moment from "moment";
import {
  email,
  required,
  maxLength,
  minLength,
} from "vuelidate/lib/validators";

export default {
  name: "First",
  components: {
    Datepicker,
  },
  data() {
    return {
      countries: null,
      submitted: false,
      form: {
        firstName: null,
        lastName: null,
        birthdate: null,
        reportSubject: null,
        phone: null,
        email: null,
        countryId: null,
      },
      disabled: {
        from: new Date(moment().format("YYYY-MM-DD")),
      },
    };
  },
  methods: {
    reg(event) {
      console.log(event);
      var char = /["a-zA-Z ]/;
      var test = char.test(event.key);

      if (!test) return false;
    },
    nextStep() {
      this.$emit("nextStep", {
        step: "second",
      });
    },
    registerFirstStep() {
      this.submitted = true;

      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }

      let formData = new FormData(document.getElementById("first"));
      axios
        .post("api/first", formData)
        .then((response) => {
          console.log(response);
          VueCookies.set("step", "second");
          VueCookies.set("id", response.data.id);
          this.nextStep();
        })
        .catch((error) => {
          if (error.response.status === 422) {
            alert(error.response.data.errors.email);
          }
        });
    },
  },
  mounted() {
    axios
      .get("api/countries")
      .then((response) => {
        this.countries = response.data;
      })
      .catch(function (error) {
        console.log(error);
      });
  },
  validations: {
    form: {
      firstName: { required, max: maxLength(100) },
      lastName: { required, max: maxLength(100) },
      birthdate: { required },
      reportSubject: { required, max: maxLength(100) },
      phone: { required, min: minLength(17) },
      email: { required, email },
      countryId: { required },
    },
  },
};
</script>

<style scoped>
#countryId {
  transform: translateY(0%);
  -webkit-transform: translateY(0%);
  -moz-transform: translateY(0%);
  -ms-transform: translateY(0%);
  -o-transform: translateY(0%);
}
</style>
