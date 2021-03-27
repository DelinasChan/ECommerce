<template>
  <nav aria-label="breadcrumb" v-if="$route.meta.breadcrumbs">
    <ol class="breadcrumb">
      <li
        class="breadcrumb-item"
        :key="index"
        v-for="(label, index) in $route.meta.breadcrumbs"
        :class="{ active: index + 1 === $route.meta.breadcrumbs.length }"
        :aria-current="index + 1 === $route.meta.breadcrumbs.length && 'page'"
      >
        <a href="#">{{ label }}</a>
      </li>
    </ol>
  </nav>
</template>
<script>
export default {
  name: "Breadcrumbs",
};
</script>