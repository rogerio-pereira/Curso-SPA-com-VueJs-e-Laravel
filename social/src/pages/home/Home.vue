<template>
    <card-conteudo-vue perfil='https://materializecss.com/images/yuna.jpg' nome='Rogerio Pereira' data='17/05/2019 12:30'>
        <card-detalhe-vue 
            imagem='https://materializecss.com/images/sample-1.jpg' 
            titulo='Teste titulo'
            texto='I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.'
        />
    </card-conteudo-vue>
</template>

<script>
import CardConteudoVue from '@/components/social/CardConteudoVue'
import CardDetalheVue from '@/components/social/CardDetalheVue'

export default {
    name: 'Home',
    components: {
        CardConteudoVue,
        CardDetalheVue
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
