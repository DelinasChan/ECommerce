<template>
    <ul>
        <li>
            <router-link :to="{ name: 'storeList' }">Store</router-link>
        </li>
        <li>
            <router-link :to="{ name: 'editStore' }">
                EditStore
            </router-link>
        </li>
    </ul>
</template>
<script>
export default {
    name: "SideBar"
};
</script>
