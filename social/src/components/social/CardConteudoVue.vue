<template>
    <div class='row'>
        <div class="card">
            <div class="card-content">
                <div class="row valign-wrapper">
                    <grid-vue tamanho="1">
                        <router-link :to="'/pagina/'+usuarioId+'/'+$slug(nome, {lower: true})">
                            <img :src="perfil" :alt="nome" class="circle responsive-img"> <!-- notice the "circle" class -->
                        </router-link>
                    </grid-vue>
                    <grid-vue tamanho="11">
                        <span>
                            <router-link :to="'/pagina/'+usuarioId+'/'+$slug(nome, {lower: true})">
                                <strong>{{nome}}</strong> - <small>{{data}}</small>
                            </router-link>
                        </span>
                    </grid-vue>
                </div>

                <slot></slot>
            </div>
            <div class="card-action">
                <p>
                    <a style='cursor:pointer;' @click='curtida(id)'>
                        <i class='material-icons'>{{curtiu}}</i>
                        {{totalCurtidas}}
                    </a>

                    <a style='cursor:pointer;' @click='abreComentarios'>
                        <i class='material-icons'>insert_comment</i>
                        {{listaComentarios.length}}
                    </a>
                </p>

                <p  v-if='exibirComentario' class='right-align'>
                    <input type='text' v-model='textoComentario' placeholder='Comentar'>
                    <button v-if='textoComentario' @click='comentar(id)' class='btn waves-effect waves-light orange'>
                        <i class='material-icons'>send</i>
                    </button>
                </p>

                <p v-if='exibirComentario'>
                    <ul class='collection'>
                        <li class="collection-item avatar" v-for='item in comentarios' :key='item.id' >
                            <img :src="item.user.imagem" alt="" class="circle">
                            <span class="title">{{item.user.name}} <small>{{item.data}}</small></span>
                            <p>
                                {{item.texto}}
                            </p>
                        </li>
                    </ul>
                </p>
            </div>
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
        'id',
        'perfil',
        'nome',
        'data',
        'comentarios',
        'totalcurtidas',
        'curtiuconteudo',
        'usuarioId'
    ],
    data () {
        return {
            curtiu: this.curtiuconteudo ? 'favorite' : 'favorite_border',
            totalComentarios: this.totalcomentarios,
            totalCurtidas: this.totalcurtidas || 0,
            exibirComentario: false,
            textoComentario: '',
            listaComentarios: this.comentarios || []
        }
    },
    methods: {
        curtida(id) {
            let url = '';

            if(this.$route.name == 'Home')
                url = 'conteudo/curtir/';
            else
                url = 'conteudo/curtirpagina/';


            this.$http.put(this.$urlAPI+url+this.id, {}, {
                'headers':{
                    'authorization': 'Bearer '+this.$store.getters.getToken
                }
            })
            .then(response => {
                //console.log(response)
                if(response.data.status) {
                    this.totalCurtidas = response.data.curtidas;
                    this.$store.commit('setConteudosLinhaTempo', response.data.lista.conteudos.data);

                    if(this.curtiu == 'favorite_border')
                        this.curtiu = 'favorite';
                    else
                        this.curtiu = 'favorite_border'; 
                }
                else {
                    alert(response.data.erro);
                }
            })
            .catch(e => {
                console.log(e)
                alert('Erro! Tente novamente mais tarde')
            });
        },
        comentar(id) {
            if(!this.textoComentario) 
                return;

            let url = '';

            if(this.$route.name == 'Home')
                url = 'conteudo/comentar/';
            else
                url = 'conteudo/comentarpagina/';

            this.$http.put(this.$urlAPI+url+this.id, 
            {
                'texto': this.textoComentario 
            }, 
            {
                'headers':{
                    'authorization': 'Bearer '+this.$store.getters.getToken
                }
            })
            .then(response => {
                //console.log(response)
                if(response.data.status) {
                    this.textoComentario = '';
                    this.$store.commit('setConteudosLinhaTempo', response.data.lista.conteudos.data);
                }
                else if(response.data.status == false && response.data.validacao) {
                    //Erros de validação
                    let errors = '';

                    for(let error of Object.values(response.data.erros)) {
                        errors += error + " ";
                    }

                    alert(errors)
                }
            })
            .catch(e => {
                console.log(e)
                alert('Erro! Tente novamente mais tarde')
            });
        },
        abreComentarios() {
            this.exibirComentario = !this.exibirComentario;
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
