<template>
    <card-conteudo-vue perfil='https://materializecss.com/images/yuna.jpg' nome='Rogerio Pereira' data='17/05/2019 12:30'>
    </card-conteudo-vue>
</template>

<script>
import CardConteudoVue from '@/components/social/CardConteudoVue'

export default {
    name: 'Home',
    components: {
        CardConteudoVue
    },
    data () {
        return {
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
