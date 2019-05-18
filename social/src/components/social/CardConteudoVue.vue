<template>
    <div class="card">
        <div class="card-content">
            <div class="row valign-wrapper">
                <grid-vue tamanho="1">
                    <img :src="perfil" :alt="nome" class="circle responsive-img"> <!-- notice the "circle" class -->
                </grid-vue>
                <grid-vue tamanho="11">
                    <span>
                        <strong>{{nome}}</strong> - <small>{{data}}</small>
                    </span>
                </grid-vue>
            </div>

            <slot>
                <div class="card-image">
                    <img src="https://materializecss.com/images/sample-1.jpg">
                    <span class="card-title">Card Title</span>
                </div>
                <div class="card-content">
                    <p>
                        I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.
                    </p>
                </div>
            </slot>
        </div>
        <div class="card-action">
            <p>
                <i class='material-icons'>favorite_border</i>
                <i class='material-icons'>insert_comment</i>
            </p>
        </div>
    </div>
</template>

<script>
import GridVue from '@/components/layouts/GridVue'

export default {
    name: 'CardConteudoVue',
    components: {
        GridVue
    },
    props:[
        'perfil',
        'nome',
        'data'
    ],
    data () {
        return {
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
