<template>
  <ValidationProvider
    :name="label"
    :rules="rules"
    :vid="vid"
    v-slot="{ failed, errors }"
  >
    <div class="form-group row valid-field">
      <label for="" class="col-sm-2 col-form-label text-right">
        {{ label }}
      </label>
      <div class="col-sm-10">
        <input :type="type || 'text'" v-model="inputValue" />
        <span class="d-block">
          {{ errors[0] || "&nbsp;" }}
        </span>
      </div>
    </div>
  </ValidationProvider>
</template>
<script>
export default {
  name: "ValidInput",
  props: {
    vid: {
      type: String,
    },
    type: {
      type: String,
    },
    fieldName: {
      type: String,
    },
    label: {
      type: String,
    },
    rules: {
      type: [Object, String],
    },
    classList: {
      type: Array,
    },
    modal: {
      require: true,
    },
  },
  computed: {
    inputValue: {
      get() {
        return this.modal;
      },
      set(value) {
        this.$emit(`update:${this.fieldName}`, value);
      },
    },
  },
};
</script>