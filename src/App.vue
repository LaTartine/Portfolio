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

            //MENU

            const nav = document.getElementById('navMob');
            const burger = document.getElementById('burgerTrigger');
            const overlay = document.getElementById('overlay');

            if( burger )
            {
                burger.addEventListener('click', () => {
                    burger.classList.toggle('active');
                    nav.classList.toggle('active');
                    overlay.classList.toggle('active');
                });
            }

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


    /* Burger menu */

    #burgerTrigger {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #17141d;
        padding: 1rem;
        z-index: 1000;
        cursor: pointer;
        transition: 0.3s linear;
        box-shadow: 2px 2px 5px #17141d;
    }

    #burgerTrigger:hover {
        background-color: goldenrod;
    }

    .line {
        width: 22px;
        margin-bottom: 5px;
        height: 2px;
        background-color: white;
    }

    .line:last-child {
        margin-bottom: 0;
    }

    #navMob {
        height: 100vh;
        width: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #17141d;
        color: white;
        position: fixed;
        right: 0;
        transform: translateX(100%);
        transition: transform 0.3s linear;
        margin-left: 200px;
    }

    #navMob.active {
        transform: translateX(0);
    }

    ul {
        list-style: none;
        text-align: center;
    }

    li {
        text-transform: uppercase;
        font-size: 2rem;
        letter-spacing: 3px;
        line-height: 1.6;
    }

</style>
