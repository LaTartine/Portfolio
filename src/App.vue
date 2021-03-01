<template>
    <div id="app">
        <!--<div class="asscroll-container">
            <div class="inner">-->
                <router-view/>
            <!--</div>
        </div>-->
    </div>
</template>

<script>
    import {gsap} from "gsap";
    import {ScrollTrigger} from "gsap/ScrollTrigger";
    import { ScrollToPlugin } from "gsap/ScrollToPlugin";


    gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

    export default {
        name: 'App',
        components: {},

        data() {
            return {}
        },
        mounted() {
            console.log("hello mounted");
            /*const asscroll = new ASScroll({
                customScrollbar: true, ease: "0.25", disableOnTouch : false
            });


            ScrollTrigger.defaults({
                scroller: asscroll.Scroll.scrollContainer
            })

            ScrollTrigger.scrollerProxy(asscroll.Scroll.scrollContainer, {
                scrollTop(value) {
                    return arguments.length ? asscroll.scrollTo(value) : -asscroll.smoothScrollPos;
                },
                getBoundingClientRect() {
                    return { top: 0, left: 0, width: window.innerWidth, height: window.innerHeight }
                }
            });

            asscroll.on("raf", ScrollTrigger.update);
            ScrollTrigger.addEventListener("refresh", () => asscroll.onResize());

            asscroll.enable();

            console.log(this.$store.getters.getAsscroll);
            if( this.$store.getters.getAsscroll === null )
            {
                this.$store.commit("createAsscroll");
            }
            console.log(this.$store.getters.getAsscroll);*/
        },
        methods: {

        }
    }
</script>

<style lang="scss">

    * {
        font-family: 'Comfortaa', cursive;
    }

    #nav {
        background: linear-gradient(rgb(0, 0, 0, 100), rgba(0, 0, 0, 0));
    }

</style>
