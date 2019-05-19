<template>
    <site-template>
        <span slot='menu-esquerdo'>
            <card-menu-vue>
                <div class="row valign-wrapper">
                    <grid tamanho="4">
                        <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
                    </grid>
                    <grid tamanho="8">
                        <span class="black-text">
                            <h5>Rogerio</h5>
                            Add the "circle" class to it to make it appear circular.
                        </span>
                    </grid>
                </div>
            </card-menu-vue>
            <card-menu-vue>
                <h3>Teste</h3>
            </card-menu-vue>
        </span>

        <span slot='principal'>
            <publicar-conteudo-vue />

            <card-conteudo-vue perfil='https://materializecss.com/images/yuna.jpg' nome='Rogerio Pereira' data='17/05/2019 12:30'>
                <card-detalhe-vue 
                    imagem='https://materializecss.com/images/sample-1.jpg' 
                    titulo='Teste titulo'
                    texto='I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.'
                />
            </card-conteudo-vue>
        </span>
    </site-template>
</template>

<script>
import SiteTemplate from '@/templates/SiteTemplate'
import CardConteudoVue from '@/components/social/CardConteudoVue'
import CardDetalheVue from '@/components/social/CardDetalheVue'
import PublicarConteudoVue from '@/components/social/PublicarConteudoVue'
import CardMenuVue from '@/components/layouts/CardMenuVue'

export default {
    name: 'Home',
    components: {
        SiteTemplate,
        CardConteudoVue,
        CardDetalheVue,
        PublicarConteudoVue,
        CardMenuVue
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
