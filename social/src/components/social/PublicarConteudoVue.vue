<template>
    <div class="row">
        <grid-vue class="input-field" tamanho='12'>
            <input type='text' v-model='conteudo.titulo' />
            <textarea placeholder='Conteúdo' v-if='conteudo.titulo' v-model='conteudo.texto' class="materialize-textarea"></textarea>
            <input type='text' v-if='conteudo.titulo && conteudo.texto' v-model='conteudo.link' placeholder='Link' />
            <input type='text' v-if='conteudo.titulo && conteudo.texto' v-model='conteudo.imagem' placeholder='URL da Imagem' />
            <label>O que está acontecendo?</label>
        </grid-vue>
        
        <p class='right-align'>
            <button @click='adicionaConteudo()' v-if='conteudo.titulo && conteudo.texto' class='btn waves-effect waves-light'>Publicar</button>
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
    },
    methods:{
        adicionaConteudo() {
            console.log(this.conteudo);
            this.$http.post(this.$urlAPI+'conteudo/adicionar', {
                titulo: this.conteudo.titulo,
                texto: this.conteudo.texto,
                link: this.conteudo.link,
                imagem: this.conteudo.imagem,
            }, {
                'headers':{
                    'authorization': 'Bearer '+this.$store.getters.getToken
                }
            }).then(response => {
                if(response.data.status){
                    console.log(response.data.conteudos);
                }
            })
            .catch(e => {
                console.log(e)
                alert('Erro! Tente novamente mais tarde')
            })
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
