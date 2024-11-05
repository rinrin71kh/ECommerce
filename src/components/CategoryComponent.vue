<script>
export default{
    name: 'CategoryComponent',
    props: ['name', 'amount', 'color', 'image' ]
}
</script>
<template>
    <div class="wrapper" :style="{backgroundColor: color}">
        <img :src="image" alt="image" class="image">
        <div class="name">{{ name }}</div>
        <div class="amount">{{ amount }} <span>items</span></div>
    </div>
    
</template>
<style scoped>
.wrapper{
    width: 120px;
    height: 150px;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    align-items: center;
    padding-bottom: 10px;
    border-radius: 10px;
    
}
.name{
    font: bold;
    font-weight: 500;
    font-size: 14px;font: bold;
    font-weight: 500;
    font-size: 14px;
}
.amount{
    font: 400;
    font-size: 12px;
    color: grey;
}
.image{
    width: 90px;
    height: 90px;
}
</style>