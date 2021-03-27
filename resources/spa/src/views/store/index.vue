<template>
  <div class="store">
    <h2>商家管理</h2>
    <p>商家管理的內容</p>
    <ValidationObserver ref="form">
      <div>
        <ValidationProvider
          v-slot="{ failed, errors }"
          name="password"
          rules="required"
        >
          <input name="password" v-model="password" />
          <span v-if="failed">{{ errors[0] }}</span>
        </ValidationProvider>
      </div>
      <div>
        <ValidationProvider
          v-slot="{ failed, errors }"
          name="account"
          rules="required"
        >
          <input v-model="account" />
          <span v-if="failed">{{ errors[0] }}</span>
        </ValidationProvider>
      </div>
    </ValidationObserver>
    <a @click="submit()">送出</a>
  </div>
</template>
<script>
export default {
  name: "EditStore",
  mounted() {
    console.log(this.$refs);
  },
  data() {
    return {
      password: "",
      account: "",
    };
  },
  methods: {
    async submit() {
      let result = await this.$refs.form.validate();
      console.log(result);
    },
  },
};
</script>
