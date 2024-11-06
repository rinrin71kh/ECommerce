<script>
import ButtonComponent from './ButtonComponent.vue';
export default {
    name: 'PromotionComponent',
    props: ['title', 'color', 'image'],
    components: {
       ButtonComponent 
    },
    data() {
    return {
      Button: {
        title: 'Shop now', color: '#3BB77E', 
      }
    }
    },
    methods: {
        shopNow(title) {
             alert("Let's shop: "+title);
        }
    }


}
</script>
<template>
    <div class="wrapper" :style="{backgroundColor: color}">
        <div class="txt" @click="shopNow(title)">
            <div class="name">{{ title }}</div>
            <ButtonComponent :color="Button.color" :title="Button.title"></ButtonComponent>
        </div>
        <div class="img-wrapper">
            <img :src="image" alt="image" class="image">
        </div>
        

    </div>
    
</template>
<style scoped>
.wrapper{
    width: 30%;
    height: 240px;
    display: flex;
    justify-content: space-around;
    border-radius: 10px;
}
.txt{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: start;
    gap: 20px;
    text-transform: capitalize;
    padding-left: 40px;
}
.img-wrapper{
    width: 60%;
    height: 100%;
    display: flex;
    justify-items: end;
    border-radius: 10px;
}
.image{
    width: 100%;
    border-radius: 10px;
}
.name{
    font: bold;
    font-weight: 500;
    font-size: 18px;
}
</style>