<template>
    <div>

        <MenuHeader/>

        <div>
            <div class="stars" style="height: 600vh">
                <div id="parallaxSpace" class="overflow-hidden" style="position: relative; height: 600vh;">
                    <div ref="stars1" id="stars1" style="position: absolute; height: 300vh; width: 100%" class=""></div>
                    <div ref="stars2" id="stars2" style="position: absolute; height: 300vh; width: 100%" class=""></div>
                    <div ref="stars3" id="stars3" style="position: absolute; height: 300vh; width: 100%" class=""></div>
                    <div id="stars4" class="parallax" data-depth='0.2'
                         style="position: absolute; height: 400vh; width: 100%"></div>
                    <div id="stars5" class="parallax" data-depth='0.4'
                         style="position: absolute; height: 1000vh; width: 100%"></div>
                </div>
            </div>
            <div class="twinkling" @mousemove="spaceParallaxUpdate" style="height: 300vh"></div>
        </div>

        <!-- Content -->
        <div class="position-absolute w-100 content" style="z-index: 1">

            <!-- Space -->
            <div @mousemove="spaceParallaxUpdate">
                <!-- Cover -->
                <div class="home d-flex justify-content-center align-items-center" style="height: 100vh">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <h1 v-if="$mq === 'md' || $mq === 'lg'" class="text-white text-center"
                            style="font-size: 5rem; z-index: 1">Allan Pinot</h1>
                        <h1 v-else class="text-white text-center" style="font-size: 2.5rem !important; z-index: 1">Allan
                            Pinot</h1>
                        <h2 v-if="$mq === 'md' || $mq === 'lg'" class="text-white" style="font-size: 5rem; z-index: 1">
                            Portfolio</h2>
                        <h2 v-else class="text-white" style="font-size: 2.5rem !important; z-index: 1">Portfolio</h2>
                    </div>
                </div>

                <!-- Stars -->
                <div v-if="projetsSites != null" id="TitleSite" class="container-fluid">

                    <div class="row mt-3" style="margin-bottom: 50px">
                        <div class="offset-md-1 offset-1 col-md-5 col-9 parallax2 text-light" data-depth="2">Bienvenue
                            sur mon Portfolio<span v-if="$mq === 'lg'"> <br><br> Pour une meilleure expérience sur le site, il est conseillé de scroller à l'aide de l'ascenseur ou de maintenir le clique molette.</span><br><br>N'hésitez
                            pas à me contacter
                            <b-button @click="$router.push('Contact')"><i class="fas fa-envelope"></i></b-button>
                            <br> <br>Bonne visite !
                        </div>
                        <div class="offset-md-2 offset-2 col-md-3 col-9 parallax2" data-depth="5"><img
                                class="float h-100 w-100" src="../assets/space/astronaute.png" alt="Image Astronaute">
                        </div>
                    </div>
                    <div ref="sites" class="row" style="margin-bottom: 100px;">
                        <h3 data-depth="0" class="parallax2 offset-1 col-3 align-self-center">Sites Web</h3>
                    </div>

                    <div v-for="(item, index) in projetsSites" :key="index" class="row spaceRow"
                         style="margin-bottom: 100px">
                        <div ref="SpaceProjectCol" class="col-md-1 col-4">
                            <div ref="animatedStarGroup" class="animatedStarGroup position-relative w-50">
                                <svg class="starFloat animatedStar" data-name="animatedStar"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92.34 92.34">
                                    <line class="path" x1="52.17" y1="45.67" x2="88.17" y2="45.67"
                                          style="fill: none;stroke: #fff;stroke-linecap: round;stroke-miterlimit: 500;stroke-width: 8px;stroke-dasharray: 25,20,25,20,25,40"/>
                                    <line class="path" x1="46.17" y1="40.17" x2="46.17" y2="4.17"
                                          style="fill: none;stroke: #fff;stroke-linecap: round;stroke-miterlimit: 10;stroke-width: 8px;stroke-dasharray: 25,20,25,20,25,40"/>
                                    <line class="path" x1="40.17" y1="46.17" x2="4.17" y2="46.17"
                                          style="fill: none;stroke: #fff;stroke-linecap: round;stroke-miterlimit: 10;stroke-width: 8px;stroke-dasharray: 25,20,25,20,25,40"/>
                                    <line class="path" x1="46.17" y1="52.17" x2="46.17" y2="88.17"
                                          style="fill: none;stroke: #fff;stroke-linecap: round;stroke-miterlimit: 10;stroke-width: 8px;stroke-dasharray: 25,20,25,20,25,40"/>
                                    <circle cx="46.17" cy="46.17" r="7"/>
                                </svg>
                                <div :id="'tooltip-stars'+index" ref="starProjectSelector" class="starProjectSelector"
                                     style="position: absolute; top: 0; left: 0;" @click="$bvModal.show('modal-sites'+index)"></div>
                            </div>
                        </div>
                        <b-tooltip v-if="index === 0 && $mq !== 'sm'" show placement="right" variant="light"
                                   :id="'starProjectTooltip'+index" ref="starProjectTooltip"
                                   :target="'tooltip-stars'+index">
                            <div class="d-flex flex-column align-items-center justify-content-center py-2"
                                 style="width: 450px">
                                <img class="w-100 h-100 mb-2" :src="item.projet.miniature" alt="">
                                <h4>{{item.projet.nom}}</h4>
                                <p>{{item.projet.description}}</p>
                                <b-button pill @click="openProjet(item.projet.id)">Voir le projet</b-button>
                            </div>
                        </b-tooltip>
                        <b-tooltip v-else-if="$mq !== 'sm'" variant="light" placement="right" :id="'starProjectTooltip'+index"
                                   ref="starProjectTooltip" :target="'tooltip-stars'+index">
                            <div class="d-flex flex-column align-items-center justify-content-center py-2"
                                 style="width: 450px">
                                <img class="w-100 h-100 mb-2" :src="item.projet.miniature" alt="">
                                <h4>{{item.projet.nom}}</h4>
                                <p>{{item.projet.description}}</p>
                                <b-button pill @click="openProjet(item.projet.id)">Voir le projet</b-button>
                            </div>
                        </b-tooltip>
                        <div v-else>
                            <b-modal :id="'modal-sites'+index" centered scrollable :title="item.projet.nom">
                                <img class="w-100 mb-2" :src="item.projet.miniature" alt="">
                                <p>{{item.projet.description}}</p>
                                <template #modal-footer="{ ok, cancel }">
                                    <b-button pill size="sm" variant="primary" @click="openProjet(item.projet.id)">Voir le projet</b-button>
                                    <b-button pill size="sm" variant="danger" @click="cancel()">
                                        Cancel
                                    </b-button>
                                </template>
                            </b-modal>
                        </div>
                    </div>

                </div>
            </div>

            <!-- SKY -->

            <div style="height: 40vh; background: linear-gradient(rgba(0,0,0,0), rgb(33, 47, 91));">
            </div>
            <div id="parallaxSky"
                 style=" background: linear-gradient(180deg, rgba(33,47,91,1) 60%, rgb(200,147,96) 100%);">
                <div ref="sky" data-depth='-0.2' class="cloud parallax3" style="height: 100vh"></div>
                <b-container fluid class="w-100 position-relative" style="margin-top: -40vh; padding-bottom: 10vh;">
                    <b-row>
                        <div data-depth='1' class="parallax3 offset-md-2">
                            <h3 class="" style="margin-left: 20px; ">Animations</h3>
                        </div>
                    </b-row>
                    <b-row v-for="(item, index) in projetsAnimations" :key="index" style="margin-bottom: 120px">
                        <b-col ref="skyProjectCol" cols="1">
                            <div data-depth='0' ref="lantern" class="parallax3 lantern">
                                <div ref="outerLight" class="outerLight"></div>
                                <div :id="'tooltip-sky'+index" @click="$bvModal.show('modal-animations'+index)" ref="lanternBody" class="lanternBody">
                                    <div ref="innerLight" class="innerLight"></div>
                                </div>
                            </div>
                        </b-col>

                        <b-tooltip v-if="$mq !== 'sm'" variant="light" placement="right" :id="'skyProjectTooltip'+index"
                                   ref="skyProjectTooltip" :target="'tooltip-sky'+index">
                            <div class="d-flex flex-column align-items-center justify-content-center py-2"
                                 style="width: 450px">
                                <img class="w-100 h-100 mb-2" :src="item.projet.miniature" alt="">
                                <h4>{{item.projet.nom}}</h4>
                                <p>{{item.projet.description}}</p>
                                <b-button pill @click="openProjet(item.projet.id)">Voir le projet</b-button>
                            </div>
                        </b-tooltip>
                        <div v-else>
                            <b-modal :id="'modal-animations'+index" centered scrollable :title="item.projet.nom">
                                <img class="w-100 mb-2" :src="item.projet.miniature" alt="">
                                <p>{{item.projet.description}}</p>
                                <template #modal-footer="{ ok, cancel }">
                                    <b-button pill size="sm" variant="primary" @click="openProjet(item.projet.id)">Voir le projet</b-button>
                                    <b-button pill size="sm" variant="danger" @click="cancel()">
                                        Cancel
                                    </b-button>
                                </template>
                            </b-modal>
                        </div>
                    </b-row>

                </b-container>
            </div>


            <!--LANDSCAPE-->

            <div style="height: 80vw; overflow: hidden" class="position-relative">
                <div id="parallaxLandscape" class="landscape">
                    <div data-depth='0' class="parallax4 w-100">
                        <svg id="landscape" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2384 1614">
                            <title>fond0</title>
                            <polygon id="fond0"
                                     points="0 1614 0 692 629.52 0 1002.07 250 1250.36 198 1550.84 531 1749.51 383 2015.22 589 2346.75 418 2384 521.46 2384 1614 0 1614"
                                     style="fill: #c89360"/>
                        </svg>
                    </div>
                    <div data-depth='0.2' class="parallax4 w-100 position-absolute" style="top: 10vw; left: 0">
                        <svg id="landscape" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2384 1614">
                            <title>fond1</title>
                            <polygon id="fond1"
                                     points="2381.39 727.45 2373.07 697 2366.27 727.45 2350.35 727.45 2342.03 697 2336.28 722.73 2306.26 701.7 2297.33 669 2292.22 691.86 2245.46 659.1 2242.7 649 2241.12 656.06 2226.72 645.98 2216.62 609 2210.84 634.85 2140.92 585.87 2134.67 563 2131.1 578.99 2115.46 568.03 2111.08 552 2108.58 563.21 2058.83 528.36 2052.72 506 2049.23 521.63 1986.66 477.8 1980.71 456 1977.3 471.24 1953.49 454.57 1948.42 436 1945.52 448.98 1899.23 416.55 1890.07 383 1884.82 406.46 1863.74 391.69 1786.84 450.13 1780.8 428 1773.6 460.19 1712.03 506.99 1706.3 486 1699.47 516.53 1647.13 556.31 1640.49 532 1632.59 567.37 1625.25 572.94 1620.62 556 1615.12 580.65 1548.49 631.28 1542.4 609 1535.15 641.42 1514.76 656.92 1512.6 649 1510.03 660.51 1468.89 691.78 1458.82 690.29 1453 669 1448.58 688.79 1423.89 685.16 1419.47 669 1416.12 684.02 1381.72 678.97 1373.53 649 1367.31 676.85 1329.07 671.23 1318.9 634 1311.17 668.6 1267.88 662.24 1264.27 649 1261.52 661.3 1227.86 656.35 1219.57 626 1213.26 654.21 1185.48 650.13 1181.07 634 1177.72 648.99 1154.75 645.61 1133.78 635.41 1125.2 604 1119.71 628.57 1064.05 601.52 1060.63 589 1058.44 598.79 1021.27 580.72 1010.97 543 1004.37 572.5 1000.57 570.65 991.1 536 985.04 563.11 961.13 551.49 958.82 543 957.33 549.64 933.84 538.22 927.77 516 923.89 533.38 914.08 528.61 907.91 506 903.95 523.69 857.96 501.33 848.31 466 842.13 493.63 789.8 468.2 783.74 446 779.86 463.36 736.05 442.07 725.38 403 718.55 433.56 711.91 430.33 708 416 705.49 427.21 652.61 401.5 645.91 377 641.63 396.17 602.21 377 569.33 394.18 562.72 370 555.73 401.29 540.3 409.35 536.65 396 532.79 413.28 487.01 437.2 484.5 428 481.84 439.9 470.82 445.66 464.63 423 458.08 452.31 435.12 464.31 427.38 436 419.19 472.63 398.02 483.7 395.1 473 392 486.84 369.18 498.77 364.06 480 358.63 504.28 333.63 517.34 330.53 506 327.25 520.68 288.86 540.74 282.11 516 274.95 548 256.09 557.86 252.31 544 248.3 561.93 225.23 573.99 222.51 564 219.62 576.92 194.68 589.95 186.5 560 179.08 593.2 176.56 584 172.66 601.46 110.78 633.8 104.55 611 97.96 640.49 87.41 646 84.68 636 81.79 648.94 23.85 679.22 18.87 661 13.61 684.57 0 691.68 0 1614 2384 1614 2384 727.45 2381.39 727.45"
                                     style="fill: #b29259"/>
                        </svg>
                        <!--<h3 class="position-absolute d-block mx-auto" style="top: 5vw; right: 50%; left: 50%">Jeux</h3>-->
                    </div>
                    <div data-depth='0.4' class="parallax4 w-100 position-absolute" style="top: 20vw; left: 0">
                        <svg id="landscape" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2384 1614">
                            <title>fond2</title>
                            <polygon id="fond2"
                                     points="2349.94 818.76 2333.09 700 2321.08 784.65 2236.65 684.89 2226.31 612 2218.93 663.96 2213.89 658 2124.04 693.57 2118.28 653 2111.84 698.4 2097.81 703.96 2084.76 612 2070.16 714.9 1860.3 797.99 1855.05 761 1849.18 802.39 1842.7 804.96 1830.22 717 1816.25 815.43 1771.86 833 1698.58 796.11 1684.94 700 1673.12 783.29 1558.17 725.43 1554.57 700 1551.44 722.04 1448.6 670.26 1422.95 560 1400.39 645.99 1264.02 577.34 1196.49 610.66 1192 579 1186.83 615.42 1170.33 623.56 1158.47 540 1144.83 636.14 1098.06 659.22 1093.91 630 1089.14 663.62 1041.76 687 1019.41 609 995.4 709.83 910.95 751.48 898.97 667 885.17 764.19 737.55 837 557.37 697.78 546.33 620 537.48 682.41 521.31 669.91 502.88 540 488.08 644.24 415.32 588.02 408.51 540 403.04 578.53 309.18 506 134.23 685.94 119.2 580 99.03 722.14 65.94 756.18 62.08 729 56.91 765.47 0 824 0 1614 2384 1614 2384 859 2349.94 818.76"
                                     style="fill: #7f6a44"/>
                        </svg>
                    </div>
                    <div data-depth='0.8' class="parallax4 w-100 position-absolute" style="top: 35vw; left: 0">
                        <svg id="landscape" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 2384 1614">
                            <defs>
                                <linearGradient id="Dégradé_sans_nom_33" data-name="Dégradé sans nom 33" x1="1836.42"
                                                y1="1131.88" x2="1836.42" y2="794.41"
                                                gradientTransform="translate(39.3 -79.41) rotate(2.5)"
                                                gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="#323522"/>
                                    <stop offset="1" stop-color="#585030"/>
                                </linearGradient>
                                <linearGradient id="Dégradé_sans_nom_33-2" x1="550.97" y1="1315.27" x2="550.97"
                                                y2="771.27" gradientTransform="translate(0.56 -0.27)"
                                                xlink:href="#Dégradé_sans_nom_33"/>
                                <linearGradient id="Dégradé_sans_nom_33-3" x1="778.97" y1="1104.27" x2="778.97"
                                                y2="560.27" gradientTransform="translate(0.56 -0.27)"
                                                xlink:href="#Dégradé_sans_nom_33"/>
                            </defs>
                            <title>fond3</title>
                            <polygon id="sapin0" points="1741.31 1127.77 1839.68 794.27 1908.02 1135.04 1741.31 1127.77"
                                     style="fill: url(#Dégradé_sans_nom_33)"/>
                            <polygon id="sapin1" points="417.03 1315 552.03 771 686.03 1315 417.03 1315"
                                     style="fill: url(#Dégradé_sans_nom_33-2)"/>
                            <polygon id="sapin2" points="645.03 1104 780.03 560 914.03 1104 645.03 1104"
                                     style="fill: url(#Dégradé_sans_nom_33-3)"/>
                            <g id="maison0">
                                <polygon
                                        points="1705.06 1129.78 1557.13 1150.26 1564.12 982.39 1712.04 961.91 1705.06 1129.78"
                                        style="fill: #b78e58"/>
                                <polygon
                                        points="1496.53 1126.24 1561.54 1151 1568.31 988.31 1540.17 930.89 1503.3 963.55 1496.53 1126.24"
                                        style="fill: #6a4f36"/>
                                <g>
                                    <polygon
                                            points="1738.55 1009.13 1584.56 1014.92 1538.66 920.92 1688.59 922.04 1738.55 1009.13"
                                            style="fill: #ac5832"/>
                                    <polygon
                                            points="1604.98 1014.06 1588.31 1014.48 1542.23 921.54 1555.55 921.54 1604.98 1014.06"
                                            style="fill: #c1603a"/>
                                    <polygon
                                            points="1630 1012.88 1612.76 1013.83 1567.2 921.47 1580.53 921.47 1630 1012.88"
                                            style="fill: #c1603a"/>
                                    <polygon
                                            points="1656.11 1012.3 1638.89 1012.7 1594.4 921.49 1607.16 921.47 1656.11 1012.3"
                                            style="fill: #c1603a"/>
                                    <polygon
                                            points="1680.02 1011.08 1663.33 1012.05 1618.8 921.95 1632.12 921.95 1680.02 1011.08"
                                            style="fill: #c1603a"/>
                                    <polygon
                                            points="1705.6 1009.92 1688.36 1010.87 1644.88 921.93 1658.76 921.95 1705.6 1009.92"
                                            style="fill: #c1603a"/>
                                    <polygon
                                            points="1730.05 1009.27 1713.36 1010.24 1670.39 922.43 1683.16 922.41 1730.05 1009.27"
                                            style="fill: #c1603a"/>
                                    <polygon
                                            points="1477.15 988.4 1493.25 990.33 1539.28 940.86 1571.18 1008.88 1582.88 1010.28 1538.71 920.92 1477.15 988.4"
                                            style="fill: #7b3f24"/>
                                    <polygon
                                            points="1567.32 932.02 1555.09 932.59 1551.51 925.26 1563.21 925.35 1567.32 932.02"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="1595.69 943.75 1583.46 944.32 1579.89 936.99 1591.58 937.07 1595.69 943.75"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="1610.52 974.33 1598.29 974.9 1594.71 967.57 1606.4 967.66 1610.52 974.33"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="1642.69 947.92 1630.47 948.49 1626.89 941.16 1638.58 941.25 1642.69 947.92"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="1635.33 951.5 1623.1 952.07 1619.52 944.74 1631.21 944.83 1635.33 951.5"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="1697.54 950.2 1685.31 950.77 1681.73 943.44 1693.43 943.53 1697.54 950.2"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="1670.97 935.22 1658.74 935.79 1655.16 928.46 1666.86 928.55 1670.97 935.22"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="1703.91 983.77 1691.69 984.34 1688.11 977.01 1699.8 977.1 1703.91 983.77"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="1692.44 992.73 1680.21 993.3 1676.64 985.97 1688.33 986.05 1692.44 992.73"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="1633.6 1006.37 1621.37 1006.94 1617.79 999.61 1629.49 999.7 1633.6 1006.37"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="1656.73 984.02 1644.5 984.6 1640.92 977.26 1652.62 977.35 1656.73 984.02"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="1588.98 985.09 1576.75 985.66 1573.17 978.33 1584.86 978.42 1588.98 985.09"
                                            style="fill: #c19040"/>
                                </g>
                                <rect x="1621.74" y="1044.86" width="5.55" height="39.92"
                                      transform="matrix(1, 0.04, -0.04, 1, 45.67, -66.61)" style="fill: #4a3a21"/>
                                <rect x="1668.55" y="1040.15" width="5.55" height="39.92"
                                      transform="translate(45.51 -68.56) rotate(2.38)" style="fill: #4a3a21"/>
                            </g>
                        </svg>
                    </div>
                    <div data-depth='1' class="parallax4 w-100 position-absolute" style="top: 60vw; left: 0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2384 1518">
                            <title>fond5</title>
                            <g id="Calque_2" data-name="Calque 2">
                                <g>
                                    <path d="M1347.72,582.18,1034.66,2454.5h71.56L1419,583.74Q1383.41,582.77,1347.72,582.18Z"
                                          style="fill: #5e5e48"/>
                                    <path d="M1067.54,583.27,754.66,2454.5h71.06l313.1-1872.6Q1103.22,582.4,1067.54,583.27Z"
                                          style="fill: #5e5e48"/>
                                    <path d="M1207.87,581.3,894.66,2454.5h71.06L1278.91,581.39Q1243.44,581.17,1207.87,581.3Z"
                                          style="fill: #5e5e48"/>
                                    <path d="M1770.28,602.76,1460.66,2454.5h71.06L1840.31,608.88Q1805.35,605.63,1770.28,602.76Z"
                                          style="fill: #5e5e48"/>
                                    <path d="M1487.59,586,1175.16,2454.5h76.56L1563.6,589.26Q1525.64,587.39,1487.59,586Z"
                                          style="fill: #5e5e48"/>
                                    <path d="M1631.92,593,1320.66,2454.5h71.06L1702.21,597.57Q1667.09,595.08,1631.92,593Z"
                                          style="fill: #5e5e48"/>
                                    <path d="M499.57,619,192.66,2454.5h71.06L571.78,612.05Q535.72,615.34,499.57,619Z"
                                          style="fill: #5e5e48"/>
                                    <path d="M925.23,588.12,613.16,2454.5h72.56L998.26,585.28Q961.78,586.51,925.23,588.12Z"
                                          style="fill: #5e5e48"/>
                                    <path d="M207.78,653.61.5,1893.29v425L280.44,644Q244.14,648.64,207.78,653.61Z"
                                          style="fill: #5e5e48"/>
                                    <path d="M350.84,635.3,46.66,2454.5h77.06L429.4,626.33Q390.16,630.62,350.84,635.3Z"
                                          style="fill: #5e5e48"/>
                                    <path d="M641.74,606,332.66,2454.5h71.06l310-1854Q677.77,603.06,641.74,606Z"
                                          style="fill: #5e5e48"/>
                                    <path d="M783.46,595.72,472.66,2454.5h71.56l311.5-1863Q819.63,593.43,783.46,595.72Z"
                                          style="fill: #5e5e48"/>
                                    <path d="M64.29,674.46.5,1056v425L137.17,663.57Q100.77,668.85,64.29,674.46Z"
                                          style="fill: #5e5e48"/>
                                    <path d="M1908.14,615.59,1600.66,2454.5h71.56L1978.4,623.32Q1943.32,619.26,1908.14,615.59Z"
                                          style="fill: #5e5e48"/>
                                    <path d="M2184.25,650.77,1882.66,2454.5h71.06L2253.49,661.64Q2218.92,656,2184.25,650.77Z"
                                          style="fill: #5e5e48"/>
                                    <polygon
                                            points="2384.5 1127.76 2162.66 2454.5 2234.22 2454.5 2384.5 1555.72 2384.5 1127.76"
                                            style="fill: #5e5e48"/>
                                    <path d="M2046,631.54l-304.81,1823h72.56L2116.94,641Q2081.5,636.06,2046,631.54Z"
                                          style="fill: #5e5e48"/>
                                    <path d="M2384.5,684.5q-31.93-6-64-11.53L2022.66,2454.5h71.06L2384.5,715.42Z"
                                          style="fill: #5e5e48"/>
                                    <polygon
                                            points="2384.5 715.42 2093.72 2454.5 2162.66 2454.5 2384.5 1127.76 2384.5 715.42"
                                            style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10;stroke-width: 2px"/>
                                    <path d="M2253.49,661.64,1953.72,2454.5h68.94L2320.54,673Q2287.06,667.1,2253.49,661.64Z"
                                          style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10;stroke-width: 2px"/>
                                    <path d="M2116.94,641,1813.72,2454.5h68.94L2184.25,650.77Q2150.64,645.7,2116.94,641Z"
                                          style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10;stroke-width: 2px"/>
                                    <path d="M1978.4,623.32,1672.22,2454.5h68.94L2046,631.54Q2012.22,627.25,1978.4,623.32Z"
                                          style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10;stroke-width: 2px"/>
                                    <path d="M1840.31,608.88,1531.72,2454.5h68.94L1908.14,615.59Q1874.26,612.05,1840.31,608.88Z"
                                          style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10;stroke-width: 2px"/>
                                    <path d="M1702.21,597.57,1391.72,2454.5h68.94L1770.28,602.76Q1736.29,600,1702.21,597.57Z"
                                          style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10;stroke-width: 2px"/>
                                    <path d="M1563.6,589.26,1251.72,2454.5h68.94L1631.92,593Q1597.8,590.94,1563.6,589.26Z"
                                          style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10;stroke-width: 2px"/>
                                    <path d="M1419,583.74,1106.22,2454.5h68.94L1487.59,586Q1453.35,584.67,1419,583.74Z"
                                          style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10;stroke-width: 2px"/>
                                    <path d="M1278.91,581.39,965.72,2454.5h68.94L1347.72,582.18Q1313.36,581.61,1278.91,581.39Z"
                                          style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10;stroke-width: 2px"/>
                                    <path d="M1138.82,581.9,825.72,2454.5h68.94L1207.87,581.3Q1173.39,581.43,1138.82,581.9Z"
                                          style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10;stroke-width: 2px"/>
                                    <path d="M998.26,585.28,685.72,2454.5h68.94L1067.54,583.27Q1032.94,584.1,998.26,585.28Z"
                                          style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10;stroke-width: 2px"/>
                                    <path d="M855.72,591.51l-311.5,1863h68.94L925.23,588.12Q890.51,589.65,855.72,591.51Z"
                                          style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10;stroke-width: 2px"/>
                                    <path d="M713.72,600.45l-310,1854.05h68.94L783.46,595.72Q748.63,597.93,713.72,600.45Z"
                                          style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10;stroke-width: 2px"/>
                                    <path d="M571.78,612.05,263.72,2454.5h68.94L641.74,606Q606.79,608.88,571.78,612.05Z"
                                          style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10;stroke-width: 2px"/>
                                    <path d="M429.4,626.33,123.72,2454.5h68.94L499.57,619Q464.52,622.48,429.4,626.33Z"
                                          style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10;stroke-width: 2px"/>
                                    <path d="M280.44,644,.5,2318.26V2454.5H46.66L350.84,635.3Q315.68,639.49,280.44,644Z"
                                          style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10;stroke-width: 2px"/>
                                    <path d="M137.17,663.57.5,1481v412.33L207.78,653.61Q172.5,658.44,137.17,663.57Z"
                                          style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10;stroke-width: 2px"/>
                                    <path d="M.5,684.5V1056L64.29,674.46Q32.41,679.37.5,684.5Z"
                                          style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10;stroke-width: 2px"/>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div data-depth='1.2' class="parallax4 w-100 position-absolute" style="top: 50vw; left: 0">
                        <svg id="landscape" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 2384 1614">
                            <defs>
                                <linearGradient id="Dégradé_sans_nom_33" data-name="Dégradé sans nom 33" x1="2070.69"
                                                y1="1275.27" x2="2070.69" y2="1029.56"
                                                gradientTransform="translate(0.56 -0.27)"
                                                gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="#323522"/>
                                    <stop offset="1" stop-color="#585030"/>
                                </linearGradient>
                                <linearGradient id="Dégradé_sans_nom_33-2" x1="1996.19" y1="1327.27" x2="1996.19"
                                                y2="1055.27" xlink:href="#Dégradé_sans_nom_33"/>
                            </defs>
                            <title>fond5</title>
                            <polygon id="sapin4" points="2010.5 1275 2071.48 1029.29 2132 1275 2010.5 1275"
                                     style="fill: url(#Dégradé_sans_nom_33)"/>
                            <polygon id="sapin5" points="1929.5 1327 1997 1055 2064 1327 1929.5 1327"
                                     style="fill: url(#Dégradé_sans_nom_33-2)"/>
                            <g id="moulin">
                                <g id="BaseMill">
                                    <path d="M760.9,1046.78q99.29-55,198.56,0v143.89c-61.65-24.58-127.31-27.47-198.56,0Z"
                                          style="fill: #6a4f36"/>
                                    <rect x="782.49" y="841.56" width="155.4" height="253.24" style="fill: #b78e58"/>
                                    <rect x="781.77" y="841.56" width="118.7" height="253.24" style="fill: #6a4f36"/>
                                    <path d="M860.18,744.44C801,744.44,753,788.24,753,842.28H967.38C967.38,788.24,919.39,744.44,860.18,744.44Z"
                                          style="fill: #c1603a"/>
                                    <path d="M860.18,744.44c29,22.4,45.56,53.92,51.29,97.84H753C753,793.36,794.72,744.44,860.18,744.44Z"
                                          style="fill: #7b3f24"/>
                                    <path d="M959.46,1189.88q-99.27,54.81-198.56,0V1046.6c61.66,24.47,127.31,27.35,198.56,0Z"
                                          style="fill: #aa8350"/>
                                    <path d="M886.08,1064c-44,4.78-85.77-2-125.9-18.11v144.49q63,35,125.9,25.64Z"
                                          style="fill: #6d5134"/>
                                </g>
                                <g ref="heliceMoulin" id="Helice">
                                    <g id="Pale">
                                        <rect x="864.21" y="515.75" width="49.99" height="266.68"
                                              style="fill: none;stroke: #4a3a21;stroke-miterlimit: 10;stroke-width: 10px"/>
                                        <rect x="857.7" y="514.15" width="6.11" height="309.96" style="fill: #4a3a21"/>
                                        <rect x="886.81" y="514.35" width="3.72" height="269.68" style="fill: #4a3a21"/>
                                        <rect x="862.61" y="541.81" width="51.58" height="4.25" style="fill: #4a3a21"/>
                                        <rect x="862.61" y="567.86" width="51.58" height="4.25" style="fill: #4a3a21"/>
                                        <rect x="862.61" y="593.92" width="51.58" height="4.25" style="fill: #4a3a21"/>
                                        <rect x="862.61" y="619.97" width="51.58" height="4.25" style="fill: #4a3a21"/>
                                        <rect x="862.61" y="646.03" width="51.58" height="4.25" style="fill: #4a3a21"/>
                                        <rect x="862.61" y="673.68" width="51.58" height="4.25" style="fill: #4a3a21"/>
                                        <rect x="862.61" y="701.33" width="51.58" height="4.25" style="fill: #4a3a21"/>
                                        <rect x="862.61" y="728.98" width="51.58" height="4.25" style="fill: #4a3a21"/>
                                        <rect x="862.61" y="756.64" width="51.58" height="4.25" style="fill: #4a3a21"/>
                                        <path d="M912.88,514.69l-49.47.53c14.07,94.24,13.51,182.65,0,266.41h49.72Q895.24,646.09,912.88,514.69Z"
                                              style="fill: #c1ad9a"/>
                                    </g>
                                    <g id="Pale-2" data-name="Pale">
                                        <rect x="663.87" y="658.99" width="49.99" height="266.68"
                                              transform="translate(-103.47 1481.2) rotate(-90)"
                                              style="fill: none;stroke: #4a3a21;stroke-miterlimit: 10;stroke-width: 10px"/>
                                        <rect x="705.86" y="665.8" width="6.11" height="309.96"
                                              transform="translate(-111.87 1529.69) rotate(-90)" style="fill: #4a3a21"/>
                                        <rect x="687.1" y="658.03" width="3.72" height="269.68"
                                              transform="translate(-103.9 1481.82) rotate(-90)" style="fill: #4a3a21"/>
                                        <rect x="557.92" y="791" width="51.58" height="4.25"
                                              transform="translate(-209.42 1376.84) rotate(-90)" style="fill: #4a3a21"/>
                                        <rect x="583.97" y="791" width="51.58" height="4.25"
                                              transform="translate(-183.36 1402.89) rotate(-90)" style="fill: #4a3a21"/>
                                        <rect x="610.03" y="791" width="51.58" height="4.25"
                                              transform="translate(-157.31 1428.95) rotate(-90)" style="fill: #4a3a21"/>
                                        <rect x="636.09" y="791" width="51.58" height="4.25"
                                              transform="translate(-131.25 1455.01) rotate(-90)" style="fill: #4a3a21"/>
                                        <rect x="662.14" y="791" width="51.58" height="4.25"
                                              transform="translate(-105.2 1481.06) rotate(-90)" style="fill: #4a3a21"/>
                                        <rect x="689.79" y="791" width="51.58" height="4.25"
                                              transform="translate(-77.54 1508.71) rotate(-90)" style="fill: #4a3a21"/>
                                        <rect x="717.45" y="791" width="51.58" height="4.25"
                                              transform="translate(-49.89 1536.37) rotate(-90)" style="fill: #4a3a21"/>
                                        <rect x="745.1" y="791" width="51.58" height="4.25"
                                              transform="translate(-22.24 1564.02) rotate(-90)" style="fill: #4a3a21"/>
                                        <rect x="772.75" y="791" width="51.58" height="4.25"
                                              transform="translate(5.41 1591.67) rotate(-90)" style="fill: #4a3a21"/>
                                        <path d="M554.46,768.65l.53,49.47c94.25-14.07,182.66-13.51,266.41,0V768.4Q685.88,786.3,554.46,768.65Z"
                                              style="fill: #c1ad9a"/>
                                    </g>
                                    <g id="Pale-3" data-name="Pale">
                                        <rect x="1007.45" y="716.08" width="49.99" height="266.68"
                                              transform="translate(1881.87 -183.02) rotate(90)"
                                              style="fill: none;stroke: #4a3a21;stroke-miterlimit: 10;stroke-width: 10px"/>
                                        <rect x="1009.34" y="665.99" width="6.11" height="309.96"
                                              transform="translate(1833.37 -191.42) rotate(90)" style="fill: #4a3a21"/>
                                        <rect x="1030.49" y="714.05" width="3.72" height="269.68"
                                              transform="translate(1881.24 -183.46) rotate(90)" style="fill: #4a3a21"/>
                                        <rect x="1111.81" y="846.5" width="51.58" height="4.25"
                                              transform="translate(1986.22 -288.97) rotate(90)" style="fill: #4a3a21"/>
                                        <rect x="1085.75" y="846.5" width="51.58" height="4.25"
                                              transform="translate(1960.17 -262.92) rotate(90)" style="fill: #4a3a21"/>
                                        <rect x="1059.7" y="846.5" width="51.58" height="4.25"
                                              transform="translate(1934.11 -236.86) rotate(90)" style="fill: #4a3a21"/>
                                        <rect x="1033.64" y="846.5" width="51.58" height="4.25"
                                              transform="translate(1908.06 -210.8) rotate(90)" style="fill: #4a3a21"/>
                                        <rect x="1007.58" y="846.5" width="51.58" height="4.25"
                                              transform="translate(1882 -184.75) rotate(90)" style="fill: #4a3a21"/>
                                        <rect x="979.93" y="846.5" width="51.58" height="4.25"
                                              transform="translate(1854.35 -157.1) rotate(90)" style="fill: #4a3a21"/>
                                        <rect x="952.28" y="846.5" width="51.58" height="4.25"
                                              transform="translate(1826.7 -129.45) rotate(90)" style="fill: #4a3a21"/>
                                        <rect x="924.63" y="846.5" width="51.58" height="4.25"
                                              transform="translate(1799.05 -101.79) rotate(90)" style="fill: #4a3a21"/>
                                        <rect x="896.98" y="846.5" width="51.58" height="4.25"
                                              transform="translate(1771.39 -74.14) rotate(90)" style="fill: #4a3a21"/>
                                        <path d="M1166.85,873.1l-.54-49.47c-94.24,14.07-182.65,13.52-266.41,0v49.72Q1035.44,855.46,1166.85,873.1Z"
                                              style="fill: #c1ad9a"/>
                                    </g>
                                    <g id="Pale-4" data-name="Pale">
                                        <rect x="807.12" y="859.33" width="49.99" height="266.68"
                                              transform="translate(1664.22 1985.34) rotate(180)"
                                              style="fill: none;stroke: #4a3a21;stroke-miterlimit: 10;stroke-width: 10px"/>
                                        <rect x="857.5" y="817.64" width="6.11" height="309.96"
                                              transform="translate(1721.11 1945.24) rotate(180)" style="fill: #4a3a21"/>
                                        <rect x="830.78" y="857.73" width="3.72" height="269.68"
                                              transform="translate(1665.28 1985.14) rotate(180)" style="fill: #4a3a21"/>
                                        <rect x="807.12" y="1095.7" width="51.58" height="4.25"
                                              transform="translate(1665.81 2195.65) rotate(180)" style="fill: #4a3a21"/>
                                        <rect x="807.12" y="1069.64" width="51.58" height="4.25"
                                              transform="translate(1665.81 2143.53) rotate(180)" style="fill: #4a3a21"/>
                                        <rect x="807.12" y="1043.58" width="51.58" height="4.25"
                                              transform="translate(1665.81 2091.42) rotate(180)" style="fill: #4a3a21"/>
                                        <rect x="807.12" y="1017.53" width="51.58" height="4.25"
                                              transform="translate(1665.81 2039.31) rotate(180)" style="fill: #4a3a21"/>
                                        <rect x="807.12" y="991.47" width="51.58" height="4.25"
                                              transform="translate(1665.81 1987.2) rotate(180)" style="fill: #4a3a21"/>
                                        <rect x="807.12" y="963.82" width="51.58" height="4.25"
                                              transform="translate(1665.81 1931.89) rotate(180)" style="fill: #4a3a21"/>
                                        <rect x="807.12" y="936.17" width="51.58" height="4.25"
                                              transform="translate(1665.81 1876.59) rotate(180)" style="fill: #4a3a21"/>
                                        <rect x="807.12" y="908.52" width="51.58" height="4.25"
                                              transform="translate(1665.81 1821.29) rotate(180)" style="fill: #4a3a21"/>
                                        <rect x="807.12" y="880.87" width="51.58" height="4.25"
                                              transform="translate(1665.81 1765.98) rotate(180)" style="fill: #4a3a21"/>
                                        <path d="M808.43,1127.07l49.47-.53c-14.07-94.25-13.52-182.66,0-266.41H808.18Q826.08,995.67,808.43,1127.07Z"
                                              style="fill: #c1ad9a"/>
                                    </g>
                                    <circle cx="860.87" cy="820.72" r="11.72" style="fill: #4a3a21"/>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div data-depth='1.4' class="parallax4 w-100 position-absolute" style="top: 60vw; left: 0">
                        <svg id="landscape" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 2384 1614">
                            <defs>
                                <linearGradient id="Dégradé_sans_nom_33" data-name="Dégradé sans nom 33" x1="483.44"
                                                y1="1535.27" x2="483.44" y2="991.27"
                                                gradientTransform="translate(0.56 -0.27)"
                                                gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="#323522"/>
                                    <stop offset="1" stop-color="#585030"/>
                                </linearGradient>
                            </defs>
                            <title>fond6</title>
                            <g id="maison1">
                                <polygon
                                        points="743.39 1360.69 562.99 1406.19 560.57 1136.48 740.97 1090.97 743.39 1360.69"
                                        style="fill: #b78e58"/>
                                <polygon
                                        points="486.96 1372.88 568.46 1407 566.11 1145.61 527.78 1055.97 484.61 1111.48 486.96 1372.88"
                                        style="fill: #6a4f36"/>
                                <g>
                                    <polygon
                                            points="776.64 1164.41 587.82 1186.88 525.26 1040.11 709.54 1029.07 776.64 1164.41"
                                            style="fill: #ac5832"/>
                                    <polygon
                                            points="612.85 1183.75 592.4 1185.85 529.69 1040.81 546.05 1039.66 612.85 1183.75"
                                            style="fill: #c1603a"/>
                                    <polygon
                                            points="643.51 1179.72 622.39 1182.71 560.37 1038.55 576.73 1037.41 643.51 1179.72"
                                            style="fill: #c1603a"/>
                                    <polygon
                                            points="675.55 1176.55 654.42 1178.66 593.78 1036.26 609.46 1035.13 675.55 1176.55"
                                            style="fill: #c1603a"/>
                                    <polygon
                                            points="704.86 1172.54 684.41 1175.53 623.79 1034.91 640.15 1033.76 704.86 1172.54"
                                            style="fill: #c1603a"/>
                                    <polygon
                                            points="736.21 1168.5 715.08 1171.49 655.84 1032.63 672.88 1031.48 736.21 1168.5"
                                            style="fill: #c1603a"/>
                                    <polygon
                                            points="766.2 1165.37 745.75 1168.35 687.21 1031.26 702.89 1030.13 766.2 1165.37"
                                            style="fill: #c1603a"/>
                                    <polygon
                                            points="454.12 1153.56 474.02 1155.28 527.33 1072.02 570.98 1178.34 585.46 1179.59 525.32 1040.12 454.12 1153.56"
                                            style="fill: #7b3f24"/>
                                    <polygon
                                            points="561.2 1055.45 546.22 1057.42 541.34 1045.97 555.71 1045.11 561.2 1055.45"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="596.83 1071.82 581.85 1073.79 576.97 1062.34 591.34 1061.48 596.83 1071.82"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="617.05 1119.59 602.06 1121.55 597.18 1110.1 611.55 1109.24 617.05 1119.59"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="654.85 1074.49 639.86 1076.45 634.99 1065.01 649.36 1064.15 654.85 1074.49"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="646.04 1080.86 631.05 1082.82 626.17 1071.38 640.54 1070.51 646.04 1080.86"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="722.39 1073.45 707.4 1075.42 702.52 1063.97 716.89 1063.11 722.39 1073.45"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="688.76 1051.71 673.77 1053.68 668.89 1042.23 683.27 1041.37 688.76 1051.71"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="732.42 1126.71 717.43 1128.68 712.55 1117.23 726.92 1116.37 732.42 1126.71"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="718.91 1142.06 703.92 1144.02 699.05 1132.57 713.42 1131.71 718.91 1142.06"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="647.51 1168.97 632.53 1170.94 627.65 1159.49 642.02 1158.63 647.51 1168.97"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="674.46 1131.17 659.48 1133.13 654.6 1121.68 668.97 1120.82 674.46 1131.17"
                                            style="fill: #c19040"/>
                                    <polygon
                                            points="591.29 1138.68 576.3 1140.64 571.43 1129.19 585.8 1128.33 591.29 1138.68"
                                            style="fill: #c19040"/>
                                </g>
                                <polygon
                                        points="643.71 1284.43 636.89 1284.52 636.63 1242.48 643.46 1242.39 643.71 1284.43"
                                        style="fill: #4a3a21"/>
                                <polygon
                                        points="700.9 1271.51 694.08 1271.6 693.86 1232.27 700.68 1232.18 700.9 1271.51"
                                        style="fill: #4a3a21"/>
                            </g>
                            <polygon id="sapin3" points="349.5 1535 484.5 991 618.5 1535 349.5 1535"
                                     style="fill: url(#Dégradé_sans_nom_33)"/>
                        </svg>
                    </div>
                    <div data-depth='0.7' class="parallax4 w-100 position-absolute" style="top: 80vw; left: 0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2384 1428">
                            <title>fond7</title>
                            <g id="Calque_2" data-name="Calque 2">
                                <path id="colline1" d="M.5,1428.5V103.5c822.15-132.69,1618.88-142.61,2384,0v1325Z"
                                      style="fill: #64664d;stroke: #64664d;stroke-miterlimit: 10"/>
                            </g>
                        </svg>
                    </div>

                </div>
            </div>

            <div ref="jeux" data-depth='0.25' id="" class="jeux container-fluid position-relative"
                 style="background: linear-gradient(180deg, #64664d 0%, rgb(61,68,46) 100%); margin-top: -15vw; padding-bottom: 120px; padding-top: 10px;">
                <b-row>
                    <div class="">
                        <h3 class="" style="margin-left: 120px; ">Jeux</h3>
                    </div>
                </b-row>
                <b-row v-for="(item, index) in projetsJeux" :key="index" style="margin-bottom: 10px">
                    <b-col ref="skyProjectCol" cols="3" md="1">
                        <div :id="'tooltip-ground'+index" @click="$bvModal.show('modal-jeux'+index)" class="w-50">
                            <svg ref="flower" id="Calque_1" data-name="Calque 1" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 80 80">
                                <title>flower</title>
                                <g class="petale">
                                    <circle cx="20" cy="40" r="19.5" style="fill: #fff"/>
                                    <path d="M20,21A19,19,0,1,1,1,40,19,19,0,0,1,20,21m0-1A20,20,0,1,0,40,40,20,20,0,0,0,20,20Z"
                                          style="fill: #fff"/>
                                </g>
                                <g class="petale">
                                    <circle cx="40" cy="20" r="19.5" style="fill: #fff"/>
                                    <path d="M40,1A19,19,0,1,1,21,20,19,19,0,0,1,40,1m0-1A20,20,0,1,0,60,20,20,20,0,0,0,40,0Z"
                                          style="fill: #fff"/>
                                </g>
                                <g class="petale">
                                    <circle cx="60" cy="40" r="19.5" style="fill: #fff"/>
                                    <path d="M60,21A19,19,0,1,1,41,40,19,19,0,0,1,60,21m0-1A20,20,0,1,0,80,40,20,20,0,0,0,60,20Z"
                                          style="fill: #fff"/>
                                </g>
                                <g class="petale">
                                    <circle cx="40" cy="60" r="19.5" style="fill: #fff"/>
                                    <path d="M40,41A19,19,0,1,1,21,60,19,19,0,0,1,40,41m0-1A20,20,0,1,0,60,60,20,20,0,0,0,40,40Z"
                                          style="fill: #fff"/>
                                </g>
                                <g>
                                    <circle cx="40" cy="40" r="14.5" style="fill: #fff"/>
                                    <path d="M40,26A14,14,0,1,1,26,40,14,14,0,0,1,40,26m0-1A15,15,0,1,0,55,40,15,15,0,0,0,40,25Z"
                                          style="fill: #fff"/>
                                </g>
                            </svg>
                        </div>
                    </b-col>

                    <b-tooltip v-if="$mq !== 'sm'" variant="light" placement="right" :id="'GroundProjectTooltip'+index"
                               ref="groundProjectTooltip" :target="'tooltip-ground'+index">
                        <div class="d-flex flex-column align-items-center justify-content-center py-2"
                             style="width: 450px">
                            <img class="w-100 h-100 mb-2" :src="item.projet.miniature" alt="">
                            <h4>{{item.projet.nom}}</h4>
                            <p>{{item.projet.description}}</p>
                            <b-button pill @click="openProjet(item.projet.id)">Voir le projet</b-button>
                        </div>
                    </b-tooltip>
                    <div v-else>
                        <b-modal :id="'modal-jeux'+index" centered scrollable :title="item.projet.nom">
                            <img class="w-100 mb-2" :src="item.projet.miniature" alt="">
                            <p>{{item.projet.description}}</p>
                            <template #modal-footer="{ ok, cancel }">
                                <b-button pill size="sm" variant="primary" @click="openProjet(item.projet.id)">Voir le projet</b-button>
                                <b-button pill size="sm" variant="danger" @click="cancel()">
                                    Cancel
                                </b-button>
                            </template>
                        </b-modal>
                    </div>
                </b-row>
            </div>

            <!--UNDERGROUND-->
            <div id="parallaxUnderground" class="position-relative overflow-hidden"
                 style="background: black; height: 200vh">
                <div data-depth='-0.3' class="parallax7" id="mineSupports"></div>
                <div data-depth='-1.9' class="parallax6 d-flex justify-content-center align-items-center w-100"
                     style="position: absolute; top: 0; height: 100vh">
                    <svg style="width: 15%;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 906 475">
                        <title>elevator</title>
                        <g id="Calque_3" data-name="Calque 3">
                            <rect x="22.35" width="44.13" height="475" style="fill: #302a26"/>
                            <rect x="839.52" width="44.13" height="475" style="fill: #302a26"/>
                            <rect x="430.93" y="-334.31" width="44.13" height="861.3"
                                  transform="translate(549.34 -356.66) rotate(90)" style="fill: #302a26"/>
                            <rect x="385.98" y="-87.64" width="131.36" height="886.09"
                                  transform="matrix(-0.07, 1, -1, -0.07, 837.6, -70.47)" style="fill: #302a26"/>
                            <rect x="411.83" y="-281.93" width="81.88" height="880.78" rx="0.25"
                                  transform="translate(594.6 -299.8) rotate(87.91)" style="fill: #302a26"/>
                            <rect x="409.97" y="-178.45" width="84.37" height="891.74" rx="0.25"
                                  transform="translate(684.97 -203.49) rotate(85.71)" style="fill: #302a26"/>
                            <rect x="425.3" y="16.4" width="56.99" height="861.3"
                                  transform="translate(900.85 -6.74) rotate(90)" style="fill: #302a26"/>
                        </g>
                    </svg>
                </div>
                <div data-depth='0' class="parallax7 underGround"></div>
                <div data-depth='-1.7' id="screen" class="parallax6">
                    <div id="lightCache"></div>
                    <div id="blackLight"></div>
                </div>
            </div>
            <div class="bg-dark">
                <div ref="Illustrations" data-depth='0.25' class="jeux container-fluid"
                     style="margin-top: -200vh; height: max-content; ">
                    <b-row>
                        <b-col cols="4" offset="0">
                            <h3 class="text-light mt-5" style="">Illustrations</h3>
                        </b-col>
                    </b-row>
                    <b-row class="lanternUnderground" v-for="(item, index) in projetsDessin" :key="index" style="">
                        <b-col ref="skyProjectCol" cols="10" sm="4">
                            <div class="w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     viewBox="0 0 2388 2395">
                                    <defs>
                                        <linearGradient id="Dégradé_sans_nom_6" data-name="Dégradé sans nom 6"
                                                        x1="1193.5" y1="954" x2="1193.5" y2="846"
                                                        gradientUnits="userSpaceOnUse">
                                            <stop offset="0" stop-color="#d3d372"/>
                                            <stop offset="0.04" stop-color="#b7b667"/>
                                            <stop offset="0.1" stop-color="#98975b"/>
                                            <stop offset="0.17" stop-color="#7e7b51"/>
                                            <stop offset="0.24" stop-color="#686549"/>
                                            <stop offset="0.33" stop-color="#585443"/>
                                            <stop offset="0.43" stop-color="#4c493e"/>
                                            <stop offset="0.58" stop-color="#46423c"/>
                                            <stop offset="1" stop-color="#44403b"/>
                                        </linearGradient>
                                        <linearGradient id="Dégradé_sans_nom_6-2" x1="1193.5" y1="827" x2="1193.5"
                                                        y2="719" xlink:href="#Dégradé_sans_nom_6"/>
                                        <linearGradient id="Dégradé_sans_nom_6-3" x1="1193.5" y1="702" x2="1193.5"
                                                        y2="594" xlink:href="#Dégradé_sans_nom_6"/>
                                        <linearGradient id="Dégradé_sans_nom_6-4" x1="1193.5" y1="577" x2="1193.5"
                                                        y2="469" xlink:href="#Dégradé_sans_nom_6"/>
                                        <linearGradient id="Dégradé_sans_nom_6-5" x1="1194.5" y1="452" x2="1194.5"
                                                        y2="344" xlink:href="#Dégradé_sans_nom_6"/>
                                        <linearGradient id="Dégradé_sans_nom_6-6" x1="1194.5" y1="327" x2="1194.5"
                                                        y2="219" xlink:href="#Dégradé_sans_nom_6"/>
                                        <linearGradient id="Dégradé_sans_nom_6-7" x1="1194" y1="1016" x2="1194" y2="908"
                                                        xlink:href="#Dégradé_sans_nom_6"/>
                                        <linearGradient id="Dégradé_sans_nom_6-8" x1="1195" y1="390" x2="1195" y2="282"
                                                        xlink:href="#Dégradé_sans_nom_6"/>
                                        <linearGradient id="Dégradé_sans_nom_6-9" x1="1194" y1="515" x2="1194" y2="407"
                                                        xlink:href="#Dégradé_sans_nom_6"/>
                                        <linearGradient id="Dégradé_sans_nom_6-10" x1="1194" y1="892" x2="1194" y2="784"
                                                        xlink:href="#Dégradé_sans_nom_6"/>
                                        <linearGradient id="Dégradé_sans_nom_6-11" x1="1194" y1="765" x2="1194" y2="657"
                                                        xlink:href="#Dégradé_sans_nom_6"/>
                                        <linearGradient id="Dégradé_sans_nom_6-12" x1="1194" y1="640" x2="1194" y2="532"
                                                        xlink:href="#Dégradé_sans_nom_6"/>
                                        <linearGradient id="Dégradé_sans_nom_146" data-name="Dégradé sans nom 146"
                                                        x1="1194.5" y1="261" x2="1194.5" y2="19"
                                                        gradientUnits="userSpaceOnUse">
                                            <stop offset="0" stop-color="#44403b"/>
                                            <stop offset="0.21" stop-color="#44403b"/>
                                            <stop offset="0.31" stop-color="#44403b" stop-opacity="0.65"/>
                                            <stop offset="0.42" stop-color="#44403b" stop-opacity="0.36"/>
                                            <stop offset="0.56" stop-color="#44403b" stop-opacity="0.16"/>
                                            <stop offset="0.72" stop-color="#44403b" stop-opacity="0.04"/>
                                            <stop offset="1" stop-color="#44403b" stop-opacity="0"/>
                                        </linearGradient>
                                        <radialGradient id="Dégradé_sans_nom_97" data-name="Dégradé sans nom 97"
                                                        cx="1194" cy="1200" r="1194" gradientUnits="userSpaceOnUse">
                                            <stop offset="0" stop-color="#fcee21" stop-opacity="0.5"/>
                                            <stop offset="1" stop-opacity="0"/>
                                        </radialGradient>
                                    </defs>
                                    <g data-name="Calque 3">


                                        <path d="M1193.5,846h0c-13,0-23.5,11.6-23.5,25.9v56.2c0,14.3,10.52,25.9,23.5,25.9h0c13,0,23.5-11.6,23.5-25.9V871.9C1217,857.6,1206.48,846,1193.5,846Zm11.5,74.39c0,7-5.15,12.67-11.5,12.67s-11.5-5.67-11.5-12.67V879.61c0-7,5.15-12.67,11.5-12.67s11.5,5.67,11.5,12.67Z"
                                              style="fill: url(#Dégradé_sans_nom_6)"/>
                                        <path d="M1193.5,719h0c-13,0-23.5,11.6-23.5,25.9v56.2c0,14.3,10.52,25.9,23.5,25.9h0c13,0,23.5-11.6,23.5-25.9V744.9C1217,730.6,1206.48,719,1193.5,719Zm11.5,74.39c0,7-5.15,12.67-11.5,12.67s-11.5-5.67-11.5-12.67V752.61c0-7,5.15-12.67,11.5-12.67s11.5,5.67,11.5,12.67Z"
                                              style="fill: url(#Dégradé_sans_nom_6-2)"/>
                                        <path d="M1193.5,594h0c-13,0-23.5,11.6-23.5,25.9v56.2c0,14.3,10.52,25.9,23.5,25.9h0c13,0,23.5-11.6,23.5-25.9V619.9C1217,605.6,1206.48,594,1193.5,594Zm11.5,74.39c0,7-5.15,12.67-11.5,12.67s-11.5-5.67-11.5-12.67V627.61c0-7,5.15-12.67,11.5-12.67s11.5,5.67,11.5,12.67Z"
                                              style="fill: url(#Dégradé_sans_nom_6-3)"/>
                                        <path d="M1193.5,469h0c-13,0-23.5,11.6-23.5,25.9v56.2c0,14.3,10.52,25.9,23.5,25.9h0c13,0,23.5-11.6,23.5-25.9V494.9C1217,480.6,1206.48,469,1193.5,469Zm11.5,74.39c0,7-5.15,12.67-11.5,12.67s-11.5-5.67-11.5-12.67V502.61c0-7,5.15-12.67,11.5-12.67s11.5,5.67,11.5,12.67Z"
                                              style="fill: url(#Dégradé_sans_nom_6-4)"/>
                                        <path d="M1194.5,344h0c-13,0-23.5,11.6-23.5,25.9v56.2c0,14.3,10.52,25.9,23.5,25.9h0c13,0,23.5-11.6,23.5-25.9V369.9C1218,355.6,1207.48,344,1194.5,344Zm11.5,74.39c0,7-5.15,12.67-11.5,12.67s-11.5-5.67-11.5-12.67V377.61c0-7,5.15-12.67,11.5-12.67s11.5,5.67,11.5,12.67Z"
                                              style="fill: url(#Dégradé_sans_nom_6-5)"/>
                                        <path d="M1194.5,219h0c-13,0-23.5,11.6-23.5,25.9v56.2c0,14.3,10.52,25.9,23.5,25.9h0c13,0,23.5-11.6,23.5-25.9V244.9C1218,230.6,1207.48,219,1194.5,219Zm11.5,74.39c0,7-5.15,12.67-11.5,12.67s-11.5-5.67-11.5-12.67V252.61c0-7,5.15-12.67,11.5-12.67s11.5,5.67,11.5,12.67Z"
                                              style="fill: url(#Dégradé_sans_nom_6-6)"/>
                                        <rect x="1185" y="908" width="18" height="108" rx="9"
                                              style="fill: url(#Dégradé_sans_nom_6-7)"/>
                                        <rect x="1186" y="282" width="18" height="108" rx="9"
                                              style="fill: url(#Dégradé_sans_nom_6-8)"/>
                                        <rect x="1185" y="407" width="18" height="108" rx="9"
                                              style="fill: url(#Dégradé_sans_nom_6-9)"/>
                                        <rect x="1185" y="784" width="18" height="108" rx="9"
                                              style="fill: url(#Dégradé_sans_nom_6-10)"/>
                                        <rect x="1185" y="657" width="18" height="108" rx="9"
                                              style="fill: url(#Dégradé_sans_nom_6-11)"/>
                                        <rect x="1185" y="532" width="18" height="108" rx="9"
                                              style="fill: url(#Dégradé_sans_nom_6-12)"/>

                                        <path d="M1204,87.21V28a9,9,0,0,0-18,0V86.75c-8.78,3.76-15,13.15-15,24.15v56.2c0,11,6.22,20.39,15,24.15V252a9,9,0,0,0,18,0V190.79c8.24-4,14-13.11,14-23.69V110.9C1218,100.32,1212.24,91.23,1204,87.21Zm2,72.18a13.55,13.55,0,0,1-2,7.14V162a9,9,0,0,0-18,0v5.9a13.33,13.33,0,0,1-3-8.51V118.61a13.33,13.33,0,0,1,3-8.51V118a9,9,0,0,0,18,0v-6.53a13.55,13.55,0,0,1,2,7.14Z"
                                              style="fill: url(#Dégradé_sans_nom_146)"/>
                                        <circle cx="1194" cy="1200" r="1194" style="fill: url(#Dégradé_sans_nom_97)"/>

                                        <g data-name="Trigger" :id="'tooltip-underground'+index"  @click="$bvModal.show('modal-illustrations'+index)">
                                            <rect x="1107.76" y="1108" width="172.48" height="248"
                                                  style="fill: #44403b"/>
                                            <ellipse cx="1194" cy="1108" rx="86.24" ry="92" style="fill: #44403b"/>
                                            <circle cx="1194" cy="1016" r="30" style="fill: #44403b"/>
                                            <rect x="1202.26" y="1131" width="53.21" height="189" rx="3.99"
                                                  style="fill: #d3d372"/>
                                            <rect x="1132.53" y="1131" width="49.54" height="189" rx="4.07"
                                                  style="fill: #d3d372"/>
                                            <rect x="1094" y="1334" width="200" height="22" style="fill: #44403b"/>
                                            <rect x="1083" y="1092" width="222" height="25" style="fill: #44403b"/>
                                        </g>

                                    </g>
                                </svg>
                            </div>
                        </b-col>

                        <b-tooltip v-if="$mq !== 'sm'" variant="light" placement="right" :id="'GroundProjectTooltip'+index"
                                   ref="groundProjectTooltip" :target="'tooltip-underground'+index">
                            <div class="d-flex flex-column align-items-center justify-content-center py-2"
                                 style="width: 450px">
                                <img class="w-100 h-100 mb-2" :src="item.projet.miniature" alt="">
                                <h4>{{item.projet.nom}}</h4>
                                <p>{{item.projet.description}}</p>
                                <b-button pill @click="openProjet(item.projet.id)">Voir le projet</b-button>
                            </div>
                        </b-tooltip>
                        <div v-else>
                            <b-modal :id="'modal-illustrations'+index" centered scrollable :title="item.projet.nom">
                                <img class="w-100 mb-2" :src="item.projet.miniature" alt="">
                                <p>{{item.projet.description}}</p>
                                <template #modal-footer="{ ok, cancel }">
                                    <b-button pill size="sm" variant="primary" @click="openProjet(item.projet.id)">Voir le projet</b-button>
                                    <b-button pill size="sm" variant="danger" @click="cancel()">
                                        Cancel
                                    </b-button>
                                </template>
                            </b-modal>
                        </div>
                    </b-row>
                </div>
            </div>
            <div class="footer text-light" style="background-color: rgb(0,0,0); height: 100px">
                <div class="text-center w-100">
                    <b-button class="mx-auto" @click="$router.push('Contact')">Laisser un commentaire</b-button>
                </div>
            </div>

        </div>

        <!--</div>
        </div>-->
        <!--<div class="asscrollbar">
            <div class="asscrollbar__handle">
                <div></div>
            </div>
        </div>-->
    </div>
</template>

<script>

    import $ from 'jquery';
    import {gsap} from "gsap";
    import {ScrollTrigger} from "gsap/ScrollTrigger";
    import {CustomEase} from "gsap/CustomEase";
    import {ScrollToPlugin} from "gsap/ScrollToPlugin";
    import ajaxService from "../services/ajaxService";
    import MenuHeader from "../components/MenuHeader";


    gsap.registerPlugin(ScrollTrigger, CustomEase, ScrollToPlugin);

    export default {
        name: 'Accueil',
        components: {MenuHeader},

        data() {
            return {

                //Parallax par librairie : qu'un seul possible, switch sur code perso
                /*sky: [
                  {
                    name: "bg_sky",
                    horizontalDisplacement: 0.05,
                    verticalDisplacement: 0.05,
                    image: require('../assets/space/stars1.svg')
                  },
                  {
                    name: "bg_clouds",
                    horizontalDisplacement: 0.1,
                    verticalDisplacement: 0.1,
                    image: require('../assets/space/stars2.svg')
                  },
                  {
                    name: "bg_mountain",
                    horizontalDisplacement: 0.4,
                    verticalDisplacement: 0.4,
                    image: require('../assets/space/stars3.svg')
                  }
                ],*/

                projetsSites: null,
                projetsAnimations: null,
                projetsJeux: null,
                projetsDessin: null,

                stars1: null,
                stars2: null,
                stars3: null,

                asscroll: null
            }
        },
        mounted() {

            //smooth scroll

            /*if( this.$store.getters.getAsscroll === null )
            {
                this.$store.commit("createAsscroll");
            }
            const asscroll = this.$store.getters.getAsscroll;


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
            ScrollTrigger.addEventListener("refresh", () => asscroll.onResize());*/

            //FETCH des données

            ajaxService.axiosGetProjetsOfType("Site").then(result => {
                ajaxService.axiosGetProjetsOfType("Animation").then(result2 => {
                    ajaxService.axiosGetProjetsOfType("Jeu").then(result3 => {
                        ajaxService.axiosGetProjetsOfType("Illustration").then(result4 => {
                            this.projetsSites = result;
                            this.setupSpace();
                            this.projetsAnimations = result2;
                            this.setupSky();
                            this.projetsJeux = result3;
                            this.setupLand();
                            this.projetsDessin = result4;
                            setTimeout(() => {  this.scrollMeTo(this.$store.state.scrollTo); }, 200);
                        });
                    });
                });

            });

            //asscroll.enable();

        },
        watch: {
            '$store.state.scrollTo': function() {
                this.scrollMeTo(this.$store.state.scrollTo);
            }
        },
        beforeDestroy() {
            //this.asscroll.disable();
            //this.$store.getters.getAsscroll.disable();
        },
        methods:
            {
                setupSpace()
                {
                    this.$nextTick(() => {
                        //SPACE

                        //referencement des fonds d'étoile 3D
                        this.stars1 = $('#stars1');
                        this.stars2 = $('#stars2');
                        this.stars3 = $('#stars3');

                        //Décallage aléatoire de l'animation des étoiles animées
                        let animatedStars = document.querySelectorAll(".animatedStar");
                        for (let animatedStar of animatedStars) {
                            animatedStar.style.animationDelay = rnd + "s";
                            let paths = animatedStar.querySelectorAll(".path");
                            let rnd = Math.random() * (/*max*/2);
                            for (let path of paths) {
                                path.style.animationDelay = rnd + "s";
                            }
                        }

                        console.log("part1");

                        //Deplacer aléatoirement les etoiles + Setup trigger
                        let allSpaceProjects = this.$refs.SpaceProjectCol;
                        console.log(allSpaceProjects);
                        for (let i = 0; i < allSpaceProjects.length; i++) {

                            if (i === 0) {
                                allSpaceProjects[i].classList.add('offset-' + Math.floor(Math.random() * 7 + 4));
                            } else {
                                allSpaceProjects[i].classList.add('offset-' + Math.floor(Math.random() * 10 + 1));
                            }


                            //adapter la taille du trigger de clique
                            let starProjectSelector = this.$refs.starProjectSelector;
                            let star0 = animatedStars[i].getBoundingClientRect();

                            console.log(starProjectSelector[i]);
                            starProjectSelector[i].style.width = (star0.right - star0.left) + "px";
                            starProjectSelector[i].style.height = (star0.bottom - star0.top) + "px";
                        }

                        console.log("part2");
                        //Ajouter et calculer les traits de constellation

                        let animatedStarGroupNotLast = $(".animatedStarGroup:not(:last)");


                        $.each(animatedStarGroupNotLast, function (i) {

                            $(this).prepend('<svg id="lineStarsSVG' + i + '" class="position-absolute" width="900" height="900"><line id="lineStars' + i + '" x1="50" y1="50" x2="350" y2="350" style="fill: none;stroke: #fff;opacity: 15%;stroke-linecap: round;stroke-miterlimit: 10;stroke-width: 4px;stroke-dasharray: 70,20,1,20"/></svg>');


                            var line = $('#lineStars' + i)[0];

                            let star0 = animatedStars[i].getBoundingClientRect();
                            let star1 = animatedStars[i + 1].getBoundingClientRect();

                            let svgPosX = 0;
                            let svgPosY = 0;
                            let lineX = star1.left - star0.left + (star1.right - star1.left) / 2 - (star0.right - star0.left) / 2;
                            let lineY = (star1.top - star0.top + (star1.bottom - star1.top) / 2) - ((star0.bottom - star0.top) / 2);
                            let svgLenght = Math.abs(Math.sqrt(lineX * lineX + lineY * lineY) + (star1.right - star1.left) / 2);
                            //Si les etoiles sont parfaitement alignées
                            if (star1.left - star0.left === 0 && star1.right - star0.right === 0) {
                                svgLenght = (star1.right - star1.left) / 2 + 10;
                            }
                            let svgHeight = Math.abs(lineY + (star1.bottom - star1.top) / 2);

                            //Si l'etoile est à gauche
                            if (star0.left > star1.left) {
                                svgPosX = -svgLenght + star1.right - star1.left;
                            }

                            $("#lineStarsSVG" + i)[0].style.left = svgPosX + "px";
                            $("#lineStarsSVG" + i)[0].style.top = svgPosY + "px";
                            $("#lineStarsSVG" + i)[0].style.width = svgLenght + "px";
                            $("#lineStarsSVG" + i)[0].style.height = svgHeight + "px";

                            //Si la deuxieme etoile est bien à droite de la premiere
                            if (star0.left <= star1.left) {
                                line.x1.baseVal.value = (star0.right - star0.left) / 2;
                                line.x2.baseVal.value = star1.left - star0.left + (star1.right - star1.left) / 2;
                                line.y1.baseVal.value = (star0.bottom - star0.top) / 2;
                                line.y2.baseVal.value = star1.top - star0.top + (star1.bottom - star1.top) / 2;
                            } else {
                                line.x1.baseVal.value = svgLenght - (star0.left - star1.left) - (star1.right - star1.left) / 2;
                                line.x2.baseVal.value = svgLenght - (star0.right - star0.left) / 2;
                                line.y1.baseVal.value = star1.top - star0.top + (star1.bottom - star1.top) / 2;
                                line.y2.baseVal.value = (star0.bottom - star0.top) / 2;
                            }
                        });
                        console.log("part3");
                    });

                },
                setupSky()
                {
                    //SKY
                    this.$nextTick(() => {
                        //Décallage aléatoire de l'animation des lanternes animées
                        let animatedLanterns = this.$refs.lantern;
                        for (let i = 0; i < animatedLanterns.length; i++) {

                            let rnd = Math.random() * (2);
                            let rnd2 = Math.random() * (1);
                            animatedLanterns[i].style.animationDelay = rnd + "s";
                            this.setupLanternAnim(i, rnd);

                            let outer = animatedLanterns[i].querySelector(".outerLight");
                            outer.style.animationDelay = rnd + rnd2 + "s";

                            let inner = animatedLanterns[i].querySelector(".innerLight");
                            inner.style.animationDelay = rnd + rnd2 + "s";
                        }


                        //Deplacer aléatoirement les lanternes
                        let allskyProject = this.$refs.skyProjectCol;
                        let last = 0;
                        let last2 = 0;
                        for (let i = 0; i < allskyProject.length; i++) {

                            let rnd = 0;

                            do{
                                rnd = Math.floor(Math.random() * 8 + 1);

                                //si c'est un petit écran, éviter de mettre des objets trop à droite pour ne pas qu'ils débordent de l'écran
                                if( this.$mq === 'sm' )
                                {
                                    rnd = Math.floor(Math.random() * 4 + 1);
                                }
                            }while (rnd === last || rnd === last2); //Eviter que deux se retrouve l'une au dessus de l'autre

                            allskyProject[i].classList.add('offset-' + rnd);

                            last2 = last;
                            last = rnd;
                        }

                        //Parallax fonds 3d
                        this.SetupVerticalParallax();
                    });
                },
                setupLand()
                {
                    //LANDSCAOGE
                    this.$nextTick(() => {
                        //moulin
                        gsap.to(this.$refs.heliceMoulin, {
                            rotation: -360,
                            transformOrigin: "50% 50%",
                            repeat: -1,
                            ease: "none",
                            duration: 2.5
                        });

                        //fleurs

                        let flowers = this.$refs.flower;
                        for (let i = 0; i < flowers.length; i++) {
                            const flower = flowers[i];
                            let rnd = Math.random() * (2);
                            let rnd2 = Math.random() * (1);

                            flower.style.animationDelay = rnd + "s";
                            //gsap.to(flower, {rotation: 360, transformOrigin:"50% 50%", repeat: -1, ease: "none", duration: 2.5});

                            let petales = flower.querySelectorAll(".petale");
                            for (let i = 0; i < petales.length; i++) {
                                const petale = petales[i];
                                petale.style.animationDelay = rnd + rnd2 + "s";
                                gsap.to(petale, {
                                    scale: 0.7,
                                    repeat: -1,
                                    transformOrigin: "50% 50%",
                                    ease: CustomEase.create("custom", "M0,0 C0.184,0 0.358,1 0.54,1 0.724,1 0.8,0 1,0 "),
                                    duration: 2.5
                                });
                            }
                        }

                        /*gsap.to(this.$refs.heliceMoulin, {
                            rotation: -360,
                            transformOrigin: "50% 50%",
                            repeat: -1,
                            ease: "none",
                            duration: 2.5
                        });*/
                    });
                },
                spaceParallaxUpdate() {

                    //Mise à jour des mouvements de parallax en fonction de la souris
                    //this.stars1.css({"-webkit-transform":"translate(-"+event.clientX/500+"px,-"+event.clientY/500+"px)"});
                    //this.stars2.css({"-webkit-transform":"translate(-"+event.clientX/70+"px,-"+event.clientY/70+"px)"});
                    //this.stars3.css({"-webkit-transform":"translate(-"+event.clientX/30+"px,-"+event.clientY/30+"px)"})
                    gsap.to(this.$refs.stars1, {x: event.clientX / 500, y: event.clientY / 500})
                    gsap.to(this.$refs.stars2, {x: event.clientX / 70, y: event.clientY / 50})
                    gsap.to(this.$refs.stars3, {x: event.clientX / 20, y: event.clientY / 10})
                },
                SetupVerticalParallax() {

                    //Etoiles 3D
                    const stars = gsap.timeline({
                        scrollTrigger: {
                            trigger: "#parallaxSpace",
                            start: "top top",
                            end: "bottom top",
                            scrub: true
                        }
                    });

                    //Titre
                    const TitleSite = gsap.timeline({
                        scrollTrigger: {
                            trigger: "#TitleSite",
                            start: "top bottom",
                            end: "bottom top",
                            scrub: true
                        }
                    });

                    //parallaxSky
                    const parallaxSky = gsap.timeline({
                        scrollTrigger: {
                            trigger: "#parallaxSky",
                            start: "top bottom",
                            end: "bottom top",
                            scrub: true
                        }
                    });

                    //parallaxLandcape
                    const parallaxLandscape = gsap.timeline({
                        scrollTrigger: {
                            trigger: "#parallaxLandscape",
                            start: "top bottom",
                            end: "bottom top",
                            scrub: true
                        }
                    });

                    const triggerParallax5 = gsap.timeline({
                        scrollTrigger: {
                            trigger: "#triggerParallax5",
                            start: "top bottom",
                            end: "bottom top",
                            scrub: true
                        }
                    });

                    const parallaxUnderground = gsap.timeline({
                        scrollTrigger: {
                            trigger: "#parallaxUnderground",
                            start: "top top",
                            end: "bottom top",
                            scrub: true
                        }
                    });

                    const parallaxUnderground2 = gsap.timeline({
                        scrollTrigger: {
                            trigger: "#parallaxUnderground",
                            start: "top bottom",
                            end: "bottom top",
                            scrub: true
                        }
                    });

                    gsap.utils.toArray(".parallax").forEach(layer => {
                        const depth = layer.dataset.depth;
                        const movement = -(layer.offsetHeight * depth);
                        stars.to(layer, {y: movement, ease: "none"}, 0)
                    });

                    gsap.utils.toArray(".parallax2").forEach(layer => {
                        const depth = layer.dataset.depth;
                        const movement = -(layer.offsetHeight * depth);
                        TitleSite.to(layer, {y: movement, ease: "none"}, 0)
                    });

                    gsap.utils.toArray(".parallax3").forEach(layer => {
                        const depth = layer.dataset.depth;
                        const movement = -(layer.offsetHeight * depth);
                        parallaxSky.to(layer, {y: movement, ease: "none"}, 0)
                    });

                    gsap.utils.toArray(".parallax4").forEach(layer => {
                        const depth = layer.dataset.depth;
                        console.log(depth);
                        const movement = -(layer.offsetHeight * depth);
                        parallaxLandscape.to(layer, {y: movement, ease: "none"}, 0)
                    });

                    gsap.utils.toArray(".parallax5").forEach(layer => {
                        const depth = layer.dataset.depth;
                        console.log(depth);
                        const movement = -(layer.offsetHeight * depth);
                        triggerParallax5.to(layer, {y: movement, ease: "none"}, 0)
                    });

                    gsap.utils.toArray(".parallax6").forEach(layer => {
                        const depth = layer.dataset.depth;
                        console.log(depth);
                        const movement = -(layer.offsetHeight * depth);
                        parallaxUnderground.to(layer, {y: movement, ease: "none"}, 0)
                    });

                    gsap.utils.toArray(".parallax7").forEach(layer => {
                        const depth = layer.dataset.depth;
                        console.log(depth);
                        const movement = -(layer.offsetHeight * depth);
                        parallaxUnderground2.to(layer, {y: movement, ease: "none"}, 0)
                    });
                },
                setupLanternAnim(refNb, delay) {

                    //Animation
                    gsap.fromTo(this.$refs.lantern[refNb], {rotation: -10}, {
                        repeat: -1,
                        duration: 4,
                        delay: delay,
                        ease: CustomEase.create("custom", "M0,0 C0.184,0 0.358,1 0.54,1 0.724,1 0.8,0 1,0 "),
                        rotation: 10
                    });
                    gsap.fromTo(this.$refs.outerLight[refNb], {
                        height: 100,
                        width: 100,
                        top: -10,
                        left: -20
                    }, {
                        repeat: -1,
                        duration: 2,
                        delay: delay,
                        ease: CustomEase.create("custom", "M0,0 C0.028,0 0.056,0.2 0.1,0.2 0.152,0.2 0.134,0.11 0.17,0.098 0.22,0.126 0.211,0.522 0.262,0.522 0.301,0.522 0.325,0.056 0.382,0.056 0.435,0.056 0.42,0.816 0.502,0.816 0.552,0.816 0.56,1 0.6,1 0.654,1.014 0.634,0.62 0.696,0.62 0.74,0.62 0.718,0.692 0.774,0.692 0.82,0.692 0.812,0.204 0.862,0.204 0.908,0.204 0.884,0.258 0.932,0.258 0.964,0.244 0.937,0 1,0 "),
                        height: 200,
                        width: 200,
                        top: -60,
                        left: -70
                    });
                    gsap.fromTo(this.$refs.innerLight[refNb], {
                        height: 30,
                        width: 30,
                        top: 35,
                        left: 10,
                        opacity: 0.1,
                        webkitClipPath: "inset(0 0 0 0)"
                    }, {
                        repeat: -1,
                        duration: 2,
                        delay: delay,
                        ease: CustomEase.create("custom", "M0,0 C0.028,0 0.056,0.2 0.1,0.2 0.152,0.2 0.134,0.11 0.17,0.098 0.22,0.126 0.211,0.522 0.262,0.522 0.301,0.522 0.325,0.056 0.382,0.056 0.435,0.056 0.42,0.816 0.502,0.816 0.552,0.816 0.56,1 0.6,1 0.654,1.014 0.634,0.62 0.696,0.62 0.74,0.62 0.718,0.692 0.774,0.692 0.82,0.692 0.812,0.204 0.862,0.204 0.908,0.204 0.884,0.258 0.932,0.258 0.964,0.244 0.937,0 1,0 "),
                        height: 60,
                        width: 60,
                        top: 5,
                        left: -5,
                        opacity: 0.5,
                        webkitClipPath: "inset(0px 5px 0px 5px)"
                    });

                    //Parallax
                    this.$refs.lantern[refNb].setAttribute("data-depth", (Math.random() * 10).toString());
                },
                calculateSpaceLines() {
                    //Ajouter et calculer les traits de constellation

                    let animatedStarGroupNotLast = $(".animatedStarGroup:not(:last)");
                    let animatedStars = document.querySelectorAll(".animatedStar");


                    $.each(animatedStarGroupNotLast, function (i) {


                        var line = $('#lineStars' + i)[0];

                        let star0 = animatedStars[i].getBoundingClientRect();
                        let star1 = animatedStars[i + 1].getBoundingClientRect();

                        let svgPosX = 0;
                        let svgPosY = 0;
                        let lineX = star1.left - star0.left + (star1.right - star1.left) / 2 - (star0.right - star0.left) / 2;
                        let lineY = (star1.top - star0.top + (star1.bottom - star1.top) / 2) - ((star0.bottom - star0.top) / 2);
                        let svgLenght = Math.abs(Math.sqrt(lineX * lineX + lineY * lineY) + (star1.right - star1.left) / 2);
                        //Si les etoiles sont parfaitement alignées
                        if (star1.left - star0.left === 0 && star1.right - star0.right === 0) {
                            svgLenght = (star1.right - star1.left) / 2 + 10;
                        }
                        let svgHeight = Math.abs(lineY + (star1.bottom - star1.top) / 2);

                        //Si l'etoile est à gauche
                        if (star0.left > star1.left) {
                            svgPosX = -svgLenght + star1.right - star1.left;
                        }

                        $("#lineStarsSVG" + i)[0].style.left = svgPosX + "px";
                        $("#lineStarsSVG" + i)[0].style.top = svgPosY + "px";
                        $("#lineStarsSVG" + i)[0].style.width = svgLenght + "px";
                        $("#lineStarsSVG" + i)[0].style.height = svgHeight + "px";

                        //Si la deuxieme etoile est bien à droite de la premiere
                        if (star0.left <= star1.left) {
                            line.x1.baseVal.value = (star0.right - star0.left) / 2;
                            line.x2.baseVal.value = star1.left - star0.left + (star1.right - star1.left) / 2;
                            line.y1.baseVal.value = (star0.bottom - star0.top) / 2;
                            line.y2.baseVal.value = star1.top - star0.top + (star1.bottom - star1.top) / 2;
                        } else {
                            line.x1.baseVal.value = svgLenght - (star0.left - star1.left) - (star1.right - star1.left) / 2;
                            line.x2.baseVal.value = svgLenght - (star0.right - star0.left) / 2;
                            line.y1.baseVal.value = star1.top - star0.top + (star1.bottom - star1.top) / 2;
                            line.y2.baseVal.value = (star0.bottom - star0.top) / 2;
                        }

                    });
                },
                scrollMeTo(refName) {
                    if( refName && refName !== "null") {
                        let element = this.$refs[refName];
                        let top = element.offsetTop;

                        if (refName === "sites") {
                            top -= 100;
                        } else if (refName === "sky") {
                            top += 200;
                        } else if (refName === "jeux" && this.$mq === 'md' || refName === "jeux" && this.$mq === 'lg') {
                            top -= 750;
                        } else if (refName === "jeux") {
                            top -= 450;
                        }

                        console.log(element);

                        //window.scrollTo(0, top);
                        gsap.to(window, {duration: 1, scrollTo: top});
                        this.$store.commit("setScrollTo", "null");
                    }
                },

                goToPage(url) {
                    window.open(url);
                },

                getImgUrl(pic) {
                    return require('../assets/miniatures/' + pic)
                },

                openProjet( idProjet )
                {
                    this.$store.commit('setProjetID', idProjet);
                    this.$router.push("Projet");
                }

            },
        computed:
            {
                isChrome: function () {
                    return navigator.userAgent.includes("Chrome") && navigator.vendor.includes("Google Inc");
                }
            },
        created() {
            window.addEventListener('resize', this.calculateSpaceLines);
        },
        destroyed() {
            window.removeEventListener('resize', this.calculateSpaceLines);
        },
    }
</script>

<style scoped lang="scss">

    /*SPACE*/

    @keyframes move-twink-back {
        from {
            background-position: 0 0;
        }
        to {
            background-position: -10000px 5000px;
        }
    }

    @-webkit-keyframes move-twink-back {
        from {
            background-position: 0 0;
        }
        to {
            background-position: -10000px 5000px;
        }
    }

    @-moz-keyframes move-twink-back {
        from {
            background-position: 0 0;
        }
        to {
            background-position: -10000px 5000px;
        }
    }

    @-ms-keyframes move-twink-back {
        from {
            background-position: 0 0;
        }
        to {
            background-position: -10000px 5000px;
        }
    }


    .stars, .twinkling {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        display: block;
    }

    .stars {
        background: #000 url("../assets/space/starySky.jpg") repeat;
        background-size: 50%;
    }

    .twinkling {
        background: transparent url("../assets/space/twinkling.png") repeat top center;
        background-size: 15%;
        z-index: 1;

        -moz-animation: move-twink-back 200s linear infinite;
        -ms-animation: move-twink-back 200s linear infinite;
        -o-animation: move-twink-back 200s linear infinite;
        -webkit-animation: move-twink-back 200s linear infinite;
        animation: move-twink-back 200s linear infinite;
    }

    /*Parallax Space étoiles*/
    #stars1 {
        background-image: url("../assets/space/stars1.svg");
        transition: all 0.1s linear;
    }

    #stars2 {
        background-image: url("../assets/space/stars2.svg");
        transition: all 0.1s linear;
    }

    #stars3 {
        background-image: url("../assets/space/stars3.svg");
        transition: all 0.1s linear;
    }

    /*Parallax Vertical*/
    #stars4 {
        background-image: url("../assets/space/stars4.svg");
        transition: all 0.01s linear;
    }

    #stars5 {
        background-image: url("../assets/space/stars5.svg");
        transition: all 0.01s linear;
    }

    /*Etoiles animées*/
    @keyframes pulse {
        from {
            stroke-dashoffset: 0;
        }
        to {
            stroke-dashoffset: -500;
        }
    }

    .path {
        animation: pulse 10s linear infinite;
    }

    /*Floating elements*/

    @keyframes float {
        0% {
            transform: translateY(0px) rotate(0deg);
        }
        50% {
            transform: translateY(-20px) rotate(5deg);

        }
        100% {
            transform: translateY(0px) rotate(0deg);
        }
    }

    @keyframes starFloat {
        0% {
            transform: translateY(-10px);
        }
        50% {
            transform: translateY(10px);
        }
        100% {
            transform: translateY(-10px);
        }
    }

    .float {
        animation: float 6s ease-in-out infinite;
    }

    .starFloat {
        /*animation: starFloat 6s ease-in-out infinite;*/
    }

    /*CIEL*/

    /*Lanternes*/

    .lantern {
        z-index: 999;
        position: absolute;
        height: 70px;
        width: 50px;
        transform-origin: top center;
        /*animation : shake 4s ease-in-out infinite;*/
    }

    .lanternBody {
        position: absolute;
        background-color: #9c7c50;
        height: 70px;
        width: 50px;
        border-radius: 15px 15px 25px 25px;
    }

    .outerLight {
        z-index: -1;
        position: absolute;
        background-image: radial-gradient(rgb(169, 157, 98), rgba(117, 107, 60, 0.0), rgba(117, 107, 60, 0.0));
        opacity: 0.5;
        border-radius: 50%;
        /*animation : outerlightbreathe 3s ease-in-out infinite;*/
    }

    .innerLight {
        position: absolute;
        background-image: radial-gradient(rgb(255, 250, 245), rgb(219, 201, 149), rgba(255, 241, 181, 0.0));
        border-radius: 50%;
        /*animation : innerlightbreathe 3s ease-in-out infinite;*/
    }

    center {
        position: absolute;
        top: 50%;
        left: 50%;
    }

    /*clouds*/

    .cloud {
        background-image: url('https://i.pinimg.com/originals/19/8d/ae/198daeda14097d45e417e62ff283f10e.png');
        background-position: 0px 0px;
        background-repeat: repeat-x;
        height: 100%;
        background-size: 100%;
        opacity: 0.25;
    }

    @keyframes cloud {
        100% {
            background-position: -1900px;
        }
    }


    .cloud {
        animation: cloud 200s linear infinite;
    }

    .landscape {
        /*background: rgb(250,225,140);
        background: radial-gradient(circle, rgba(250,225,140,1) 25%, rgba(214,169,108,1) 37%, rgba(200,147,96,1) 45%);*/
        background: linear-gradient(180deg, rgba(200, 147, 96, 1), rgba(250, 225, 140, 1) 100%);
        background-size: 100%;
    }

    #collineCache {
        /*display: block;
        width: 100%;
        background-color: black;
        height: 2580px;*/
    }

    #fadeBlack::before {
        content: "";
        display: block;
        position: absolute;
        top: -10vh;
        left: 0;
        height: 10vh;
        width: 100%;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgb(0, 0, 0) 100%);
    }

    /*underGround*/

    .underGround {
        height: 200vh;
        background: url('../assets/underground/mineSupport.svg');
        background-size: 10%;
        background-repeat: repeat-y;
        background-position: center;
    }

    #screen {
        position: absolute;
        top: 0;
    }

    #lightCache {
        height: 100vh;
        width: 100vw;
        background: rgb(255, 252, 0);
        background: radial-gradient(circle, rgba(255, 252, 0, 0.11528361344537819) 0%, rgba(0, 0, 0, 1) 24%);
    }

    #blackLight {
        height: 10vh;
        width: 100vw;
        background: rgb(0, 0, 0);
    }

    #mineSupports {
        position: absolute;
        top: -10vh;
        height: 400vh;
        background: url('../assets/underground/mineSupport.svg');
        width: 100%;
        background-size: 6%;
        background-repeat: repeat-y;
        background-position: center;
    }

    .lanternUnderground:not(:last-child) {
        /*margin-bottom: -300px;*/
    }

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

    .content {
        overflow: hidden;
    }

</style>
