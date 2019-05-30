<template>
    <div class="row">
        <grid-vue class="input-field" tamanho='12'>
            <input type='text' v-model='conteudo.titulo' />
            <textarea placeholder='Conteúdo' v-if='conteudo.titulo' v-model='conteudo.texto' class="materialize-textarea"></textarea>
            <input type='text' v-if='conteudo.titulo && conteudo.texto' v-model='conteudo.link' placeholder='Link' />
            <input type='text' v-if='conteudo.titulo && conteudo.texto' v-model='conteudo.imagem' placeholder='URL da Imagem' />
            <label>O que está acontecendo?</label>
        </grid-vue>
        
        <p>
            <grid-vue v-if='conteudo.titulo && conteudo.texto' class='btn waves-effect waves-light' tamanho='2 offset-s10'>Publicar</grid-vue>
        </p>
    </div>
</template>

<script>
import GridVue from '@/components/layouts/GridVue'

export default {
    name: 'PublicarConteudoVue',
    components: {
        GridVue
    },
    props:[
    ],
    data () {
        return {
            conteudo: {
                titulo:'',
                texto:'',
                link:'',
                imagem:''
            }
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
