<script>
export default {
    name: 'ButtonComponent',
    props: ['color', 'title']
}

</script>

<template>
    <div class="shop-btn" :style="{backgroundColor: color}">
       <span class="txt">{{ title }}</span>
       <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
    </div>
</template>

<style scoped>
.shop-btn{
    width: fit-content;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    padding-top: 5px;
    padding-bottom: 5px;
    padding-left: 10px;
    padding-right: 10px;
}
.shop-btn .txt{
    margin-right: 5px;
    color: aliceblue;
    font-size: 14px;
}
.shop-btn .fa{
    color: aliceblue;
    font-size: 14px;
}
</style>