<template>
    <div class="projet" style="background-color: #111111; padding-top: 5vh;">
        <div v-if="$mq === 'md' || $mq === 'lg'" id="nav"
             class="d-flex justify-content-between flex-row px-3 py-2 fixed-top">
            <div class="bg-white" style="width: 50px; height: 50px; border-radius: 25px;"
                 @click="$router.push('Projet')"></div>
            <div class="d-flex justify-content-center align-items-center">
                <span style="cursor: pointer;" class="mr-5 text-light" @click="scrollMeTo('sites')">Sites</span>
                <span style="cursor: pointer;" class="mr-5 text-light" @click="scrollMeTo('sky')">Animations</span>
                <span style="cursor: pointer;" class="mr-5 text-light" @click="scrollMeTo('jeux')">Jeux</span>
                <span style="cursor: pointer;" class="mr-5 text-light" @click="scrollMeTo('Illustrations')">Illustrations</span>
            </div>
        </div>

        <div v-else class="fixed-top" style="z-index: 2">
            <div id="burgerTrigger">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <ul id="navMob" class="d-flex w-100 p-0 flex-column">
                <li class="text-light" style="font-size: 1.5rem !important;" @click="scrollMeTo('sites')">Sites</li>
                <li class="text-light" style="font-size: 1.5rem !important;" @click="scrollMeTo('sky')">Animations</li>
                <li class="text-light" style="font-size: 1.5rem !important;" @click="scrollMeTo('jeux')">Jeux</li>
                <li class="text-light" style="font-size: 1.5rem !important;" @click="scrollMeTo('Illustrations')">
                    Illustrations
                </li>
            </ul>
        </div>

        <div class="p-3">

            <div style="height: 90vh; margin-top: 5vh;" class="container-fluid mb-4 bg-dark p-4">
                <div class="row">
                    <div class="d-flex flex-column col-6 px-3">
                        <div class="w-100 h-100 mb-4">
                            <h1 class="mb-4 text-light">Nom projet</h1>
                            <iframe class="mx-auto" style="" width="100%" height="480"
                                    src="https://www.youtube.com/embed/wL1qWhoy15I" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                        </div>
                        <div class="text-light">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, id, reprehenderit! Ab,
                            consequuntur eius est et harum illo in inventore ipsa ipsum libero molestias perspiciatis
                            saepe
                            sapiente sunt suscipit veniam.
                        </div>
                    </div>
                    <div class="col-6 px-3 mt-5 text-light">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ab alias asperiores beatae cum,
                            debitis
                            delectus dignissimos distinctio explicabo id ipsam, ipsum molestias non numquam, odio quam
                            ratione
                            sint tempore.</p>
                    </div>
                </div>
            </div>
            <div style="height: 100vh">Hello</div>
        </div>


    </div>
</template>

<script>
    import ajaxService from "../services/ajaxService.js";

    export default {
        name: 'Projet',

        data() {
            return {
             hello :  null
            }
        },

        components: {},
        mounted() {
            ajaxService.axiosGetProjet(1).then(result => {
                console.log(result);
            });

            ajaxService.axiosGetProjetsOfType("Animation").then(result => {
                console.log(result);
                this.hello = result;
            });
        }
    }

</script>

<style scoped lang="scss">

    #nav {
        background-color: black;
    }

</style>