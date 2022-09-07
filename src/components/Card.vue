<template>
    <div class="card">
        <div class="card-header">
            <div class="card-id">{{card_info.id}}</div>
            <div class="card-name">{{card_info.name}}</div>
        </div>
        <div class="card-image">
            <img src="../assets/img/cards/1.png">
        </div>
        <div class="card-features">
            <h4>Características</h4>
            <div class="feature" :class="{'ft-hover':ftHover, 'active':ftSelected.feature == 'cylinder'}" 
            @click="returnFeature({feature: 'cylinder', value: card_info.cylinder})">
                <div class="feature-name">  Cilindraje</div>
                <div class="feature-value"> {{card_info.cylinder}}</div>
            </div>
            <div class="feature" :class="{'ft-hover':ftHover, 'active':ftSelected.feature == 'top_speed'}" 
            @click="returnFeature({feature: 'top_speed', value: card_info.top_speed})">
                <div class="feature-name">  Top Speed</div>
                <div class="feature-value"> {{card_info.top_speed}}</div>
            </div>
            <div class="feature" :class="{'ft-hover':ftHover, 'active':ftSelected.feature == 'torque'}" 
            @click="returnFeature({feature: 'torque', value: card_info.torque})">
                <div class="feature-name">  Torque</div>
                <div class="feature-value"> {{card_info.torque}}</div>
            </div>
            <div class="feature" :class="{'ft-hover':ftHover, 'active':ftSelected.feature == 'weigh'}" 
            @click="returnFeature({feature: 'weigh', value: card_info.weigh})">
                <div class="feature-name">  Peso</div>
                <div class="feature-value"> {{card_info.weigh}}</div>
            </div>
            <div class="feature" :class="{'ft-hover':ftHover, 'active':ftSelected.feature == 'year'}" 
            @click="returnFeature({feature: 'year', value: card_info.year})">
                <div class="feature-name">  Año</div>
                <div class="feature-value"> {{card_info.year}}</div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['info', 'putCart'],
        data(){
            return {
                ftHover: false,
                ftSelected: '',
                card_info: {
                    id: '',
                    name: '',
                    cylinder: '',
                    year: '',
                    top_speed: '',
                    torque: '',
                    weight: '',
                }
            }
        },
        methods: {
            async returnFeature(params) {
                this.putCart(params);
            }
        },
        mounted() {
            if(this.info.ftHover) this.ftHover = this.info.ftHover;
            if(this.info.feature) this.ftSelected = this.info.feature;
            this.card_info = this.info.data;
        }
    }
</script>
<style scoped>
    .card{
        background: #fff;
        width: 100%;
        min-width: 180px;
        max-width: 190px;
        font-family: Arial, Helvetica, sans-serif;
        box-shadow: 0 0 5px rgb(100, 100, 100);
        border-radius: .1rem;
        font-size: .9rem;
        padding: .5rem 1rem 1.5rem 1rem;
        cursor: pointer;
        transition: all .5s;
    }
    /* CABECERA DE LA CARTA */
    .card .card-header {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
    }
    .card .card-header .card-id {
        font-size: 1.2rem;
    }
    .card .card-features h4 {
        margin-bottom: .6rem;
    }
    /* IMAGNE DE LA CARTA */
    .card .card-image {
        display: flex;
        justify-content: center;
    }
    .card .card-image {
        height: 120px;
        max-width: 100%;
    }
    .card .feature {
        display: flex;
        justify-content: space-between;
        margin-bottom: .3rem;
        transition: all .2s;
        border-radius: 3px;
        padding: .2rem .25rem;
    }
    .card .ft-hover:hover,
    .card .active {
        background: rgb(83, 83, 83);
        color: #fff;
    }
</style>