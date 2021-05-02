<template>
  <div class="media flex-column">
    <div>
      <h2>
        媒體庫
        <p v-if="isDraging" style="font-size: 10px">拖曳中...</p>
      </h2>
    </div>

    <div
      v-if="data.length > 0"
      class="bulk"
      :class="{ draging: isDraging }"
      @dragover.prevent
      @drop.stop.prevent="onDrop"
      @dragenter="isDraging = true"
      @dragleave="isDraging = false"
    >
      <ImageItem
        v-for="(item, index) in data"
        :key="item.id"
        :image="item"
        @refreshData="refreshData(index)"
      />
    </div>

    <div v-else>
      <h2>讀取中...</h2>
    </div>
  </div>
</template>

<script>
export default {
  name: "Media",
  data() {
    return {
      data: [],
      isDraging: false,
    };
  },
  created() {
    this.getData();
  },
  methods: {
    /** 刪除後更新資料 */
    refreshData(index) {
      this.data.splice(index, 1);
    },

    /** 請求資料 */
    async getData() {
      let url = this.route("dashboard.api.media.index");
      let { data = [] } = await this.fetch(url);
      this.data = data;
    },

    /** 拖曳結束事件 */
    onDrop(event) {
      this.isDraging = false;
      let { files } = event.dataTransfer;
      Object.entries(files).forEach(([key, file], index) => {
        this.data.push(file);
      });
    },
  },
};
</script>