<template>
  <div>
    <vmap></vmap>
    <second v-if="step === 'second'" @nextStep="nextStep"></second>
    <third v-else-if="step === 'third'"></third>
    <first v-else @nextStep="nextStep"></first>
  </div>
</template>

<script>
import First from "./First";
import Second from "./Second";
import Third from "./Third";
import Vmap from "./Map";
import vueCookies from "vue-cookies";

export default {
  name: "Main",
  components: {
    First,
    Vmap,
    Second,
    Third,
  },
  data() {
    return {
      step: null,
    };
  },
  mounted() {
    this.step = vueCookies.get("step");
  },
  methods: {
    nextStep(data) {
      this.step = data.step;
    },
  },
};
</script>