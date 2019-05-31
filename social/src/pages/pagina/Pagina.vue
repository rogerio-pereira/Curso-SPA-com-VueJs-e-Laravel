<template>
    <site-template>
        <span slot='menu-esquerdo'>
            <card-menu-vue>
                <div class="row valign-wrapper">
                    <grid-vue tamanho="4">
                        <router-link :to="'/pagina/'+donoPagina.id+'/'+$slug(donoPagina.name, {lower: true})">
                            <img :src="donoPagina.imagem" :alt="donoPagina.name" class="circle responsive-img"> <!-- notice the "circle" class -->
                        </router-link>
                    </grid-vue>
                    <grid-vue tamanho="8">
                        <span class="black-text">
                            <router-link :to="'/pagina/'+donoPagina.id+'/'+$slug(donoPagina.name, {lower: true})">
                                <h5>{{donoPagina.name}}</h5>

                                <button v-if='exibeBtnSeguir' @click='amigo(donoPagina.id)' class='btn'>{{textoBotao}}</button>
                            </router-link>
                        </span>
                    </grid-vue>
                </div>
            </card-menu-vue>
        </span>

        <span slot='menu-esquerdo-amigos'>
            <h3>Seguindo</h3>

            <ul>
                <li v-for='item in amigos' :key='item.id'>
                    <router-link :to="'/pagina/'+item.id+'/'+$slug(item.name, {lower: true})">
                        {{item.name}}
                    </router-link>
                </li>

                <li v-if='!amigos.length'>Nenhum usuario</li>
            </ul>

            <h3>Seguidores</h3>

            <ul>
                <li v-for='item in seguidores' :key='item.id'>
                    <router-link :to="'/pagina/'+item.id+'/'+$slug(item.name, {lower: true})">
                        {{item.name}}
                    </router-link>
                </li>

                <li v-if='!seguidores.length'>Nenhum usuario</li>
            </ul>
        </span>

        <span slot='principal'>
            <publicar-conteudo-vue />

            <card-conteudo-vue 
                v-for='item in listaConteudos' 
                :key='item.id' 
                :id='item.id' 
                :comentarios='item.comentarios'
                :totalcurtidas='item.curtidas'
                :curtiuconteudo='item.curtiuconteudo'
                :usuarioId='item.user.id' 
                :perfil='item.user.imagem' 
                :nome='item.user.name' 
                :data='item.data'
            >
                <card-detalhe-vue 
                    :imagem='item.imagem' 
                    :titulo='item.titulo'
                    :texto='item.texto'
                    :link='item.link'
                />
            </card-conteudo-vue>

            <div v-scroll='handleScroll'></div>
        </span>
    </site-template>
</template>

<script>
import SiteTemplate from '@/templates/SiteTemplate'
import CardConteudoVue from '@/components/social/CardConteudoVue'
import CardDetalheVue from '@/components/social/CardDetalheVue'
import PublicarConteudoVue from '@/components/social/PublicarConteudoVue'
import CardMenuVue from '@/components/layouts/CardMenuVue'
import GridVue from '@/components/layouts/GridVue'

export default {
    name: 'Pagina',
    components: {
        SiteTemplate,
        CardConteudoVue,
        CardDetalheVue,
        PublicarConteudoVue,
        CardMenuVue,
        GridVue
    },
    data () {
        return {
            usuario:false,
            urlProximaPagina: null,
            pararScroll:false,
            donoPagina:{
                'imagem':'',
                'name':''
            },
            exibeBtnSeguir: false,
            amigos:[],
            amigosLogado:[],
            textoBotao: 'Seguir',
            seguidores: [],
        }
    },
    created() {
        this.atualizaPagina()
    },
    computed:{
        listaConteudos(){
            return this.$store.getters.getConteudosLinhaTempo;
        }
    },
    watch: {
        '$route':'atualizaPagina'
    },
    methods: {
        atualizaPagina() {
            let usuarioAux = this.$store.getters.getUsuario;

            if(usuarioAux) {
                this.usuario = this.$store.getters.getUsuario;

                this.$http.get(this.$urlAPI+'conteudo/pagina/lista/'+this.$route.params.id, {
                    'headers':{
                        'authorization': 'Bearer '+this.$store.getters.getToken
                    }
                })
                .then(response => {
                    //console.log(response)
                    if(response.data.status) {
                        this.$store.commit('setConteudosLinhaTempo', response.data.conteudos.data);
                        this.urlProximaPagina = response.data.conteudos.next_page_url;
                        this.donoPagina = response.data.dono;

                        if(this.donoPagina.id != this.usuario.id)
                            this.exibeBtnSeguir = true;
                        else
                            this.exibeBtnSeguir = false;

                        //Busca amigos
                        this.$http.get(this.$urlAPI+'usuario/lista-amigos-pagina/'+this.donoPagina.id, {
                            'headers':{
                                'authorization': 'Bearer '+this.$store.getters.getToken
                            }
                        })
                        .then(response => {
                            //console.log(response)
                            if(response.data.status) {
                                this.amigos = response.data.amigos;
                                this.amigosLogado = response.data.amigosLogado;
                                this.eAmigo();
                                this.seguidores = response.data.seguidores;
                            }
                            else {
                                alert(response.data.erro);
                            }
                        })
                        .catch(e => {
                            console.log(e)
                            alert('Erro! Tente novamente mais tarde')
                        })
                    }
                })
                .catch(e => {
                    console.log(e)
                    alert('Erro! Tente novamente mais tarde')
                })
            }
        },
        eAmigo() {
            for(let amigo of this.amigosLogado) {
                if(amigo.id == this.donoPagina.id) {
                    this.textoBotao = 'Remover';
                    return;
                }
            }

            this.textoBotao = 'Seguir';
        },
        handleScroll() {
            // console.log(window.scrollY);
            // console.log(document.body.clientHeight);
            if(this.pararScroll)
                return;

            if(window.scrollY >= (document.body.clientHeight - 1069)) {
                this.pararScroll = true;
                this.carregaPaginacao();
            }
        },
        carregaPaginacao() {
            if(!this.urlProximaPagina) 
                return;

            this.$http.get(this.urlProximaPagina, {
                'headers':{
                    'authorization': 'Bearer '+this.$store.getters.getToken
                }
            })
            .then(response => {
                //console.log(response)
                if(response.data.status && this.$route.name == 'Pagina') {
                    this.$store.commit('setPaginacaoConteudosLinhaTempo', response.data.conteudos.data);
                    this.urlProximaPagina = response.data.conteudos.next_page_url;
                    this.pararScroll = false;
                }
            })
            .catch(e => {
                console.log(e)
                alert('Erro! Tente novamente mais tarde')
            })
        },
        amigo(id) {
            this.$http.post(this.$urlAPI+'usuario/amigo', 
            {
                'id': id
            }, 
            {
                'headers':{
                    'authorization': 'Bearer '+this.$store.getters.getToken
                }
            })
            .then(response => {
                //console.log(response)
                if(response.data.status) {
                    //console.log(response)
                    this.amigosLogado = response.data.amigos;
                    this.seguidores = response.data.seguidores;
                    this.eAmigo();
                }
                else {
                    alert(response.data.erro);
                }
            })
            .catch(e => {
                console.log(e)
                alert('Erro! Tente novamente mais tarde')
            });
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
