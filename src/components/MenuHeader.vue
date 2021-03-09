<template>
    <div v-if="$mq === 'md' || $mq === 'lg'" id="nav"
         class="d-flex justify-content-between flex-row px-3 py-2 fixed-top">
        <div class="" style="width: 50px; height: 50px; border-radius: 25px;" @click="goTo('null')"><img src="../assets/logo_white.svg" alt=""></div>
        <div class="d-flex justify-content-center align-items-center">
            <span style="cursor: pointer;" class="mr-5 text-light" @click="goTo('sites')">Sites</span>
            <span style="cursor: pointer;" class="mr-5 text-light" @click="goTo('sky')">Animations</span>
            <span style="cursor: pointer;" class="mr-5 text-light" @click="goTo('jeux')">Jeux</span>
            <span style="cursor: pointer;" class="mr-5 text-light" @click="goTo('Illustrations')">Illustrations</span>
            <div style="cursor: pointer;" class="mr-5 text-light" @click="$router.push('Contact')"><i
                    class="fas fa-envelope"></i></div>
        </div>
    </div>
    <div v-else class="fixed-top" style="z-index: 1000">
        <div id="burgerTrigger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <ul id="navMob" class="d-flex w-100 p-0 flex-column">
            <li class="burgerLink text-light mb-5" style="font-size: 1.5rem !important;" @click="goTo('null')"><div class="" style="width: 50px; height: 50px; border-radius: 25px;"><img src="../assets/logo_white.svg" alt=""></div></li>
            <li class="burgerLink text-light" style="font-size: 1.5rem !important;" @click="goTo('sites')">Sites</li>
            <li class="burgerLink text-light" style="font-size: 1.5rem !important;" @click="goTo('sky')">Animations</li>
            <li class="burgerLink text-light" style="font-size: 1.5rem !important;" @click="goTo('jeux')">Jeux</li>
            <li class="burgerLink text-light" style="font-size: 1.5rem !important;" @click="goTo('Illustrations')">Illustrations            </li>
            <li class="burgerLink text-light" style="font-size: 1.5rem !important;" @click="$router.push('Contact')">Contact <i class="fas fa-envelope ml-2"></i></li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'MenuHeader',
        props: {
            scrollMeTo: {}
        },
        mounted()
        {
            //MENU

            const nav = document.getElementById('navMob');
            const burger = document.getElementById('burgerTrigger');
            const links = document.querySelectorAll(".burgerLink");

            if( burger )
            {
                burger.addEventListener('click', () => {
                    burger.classList.toggle('active');
                    nav.classList.toggle('active');
                });
                for( let i = 0; i < links.length; i++ )
                {
                    links[i].addEventListener('click', () => {
                        burger.classList.toggle('active');
                        nav.classList.toggle('active');
                    });
                }
            }

        },
        methods:
        {
            goTo( nom )
            {
                if( this.$route.name !== "Accueil")
                {
                    console.log(this.$route.name);
                    this.$router.push('/');
                }
                this.$store.commit("setScrollTo", nom);
            },
        }
    }
</script>
<style scoped lang="scss">


    /*underGround*/

    /*Font*/

    h3 {
        color: white;
        font-size: 3.5rem;
    }

    h2 {
        font-family: 'Satisfy', cursive;
        color: #6c6b6b !important;
        font-size: 9rem !important;
    }

    h1 {
        font-size: 4rem !important;
    }

</style>