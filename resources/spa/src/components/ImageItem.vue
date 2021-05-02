<template>
  <div class="media-item">
    <div v-if="isUplading" class="process">
      <a>{{ process }}</a>
    </div>
    <div>
      <img width="80" height="100" :src="media.url" />
      <a class="delete-btn" @click="destroy(media.id)">x</a>
    </div>
  </div>
</template>
<script>
export default {
  name: "ImageItem",
  props: ["image"],
  data() {
    return {
      media: {},
      isUplading: false,
      process: 0,
    };
  },
  created() {
    if (this.image instanceof File) {
      this.upload();
    } else {
      this.media = this.image;
    }
  },
  methods: {
    /** 上傳圖片 */
    async upload() {
      this.isUplading = true;
      let url = this.route("dashboard.api.media.create");
      let config = {
        method: "post",
        data: {
          images: [this.image],
        },
        onUploadProgress: (event) => {
          this.process = (((event.loaded / event.total) * 100) | 0) + "%";
        },
      };
      let { data = {} } = await this.fetch(url, config, true);
      this.media = data.image;
      this.isUplading = false;
    },

    /** 刪除圖片 */
    async destroy(id) {
      let url = this.route("dashboard.api.media.destroy");
      this.$emit("refreshData");
      await this.fetch(url, { data: { id }, method: "delete" });
    },
  },
};
</script>