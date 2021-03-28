<template>
  <div class="store">
    <h2>商家管理</h2>
    <p>商家管理的內容</p>
    <ValidationObserver ref="form">
      <ValidInput
        :modal="fields.password"
        :fields.sync="fields.password"
        fieldName="fields"
        label="用戶密碼"
        rules="required"
      />

      <ValidInput
        :modal="fields.username"
        :fields.sync="fields.username"
        fieldName="fields"
        label="用戶姓名"
        rules="required"
      />
    </ValidationObserver>
    <a @click="submit()">送出</a>
  </div>
</template>
<script>
export default {
  name: "EditStore",
  mixins: [],
  data() {
    return {
      fields: {
        password: "",
        username: "",
      },
    };
  },
  watch: {
    "fields.username"(value) {
      console.log("username", value);
    },
    "fields.password"(value) {
      console.log("password", value);
    },
  },
  methods: {
    async submit() {
      let result = await this.$refs.form.validate();
      console.log(result);
    },
  },
};
</script>
