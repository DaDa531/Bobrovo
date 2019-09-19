<template>
    <div class="container">
        <div class="row">
            <div class="col text-right">
                <a :href="'/tasks'" class="btn btn-sm btn-outline-secondary">Unassigned tasks</a>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col text-center">
                <h1>Jobs</h1>
            </div>
        </div>
        <div class="row" v-if="formMarketJob.errors.has('job')">
            <div class="col-6 offset-3">
                <alert ref="alert" alertclass="danger" :message="formMarketJob.errors.get('job')"></alert>
            </div>
        </div>
        <div class="row" v-if="dismissCountDown > 0">
            <div class="col-6 offset-3">
                <b-alert
                        :show="dismissCountDown"
                        dismissible
                        variant="success"
                        @dismissed="dismissCountDown=0"
                        @dismiss-count-down="countDownChanged"
                >
                    Job was successfully taken. You need assign driver to this job.
                </b-alert>
            </div>
        </div>
        <div class="row">
            <div class="col-7 offset-5">
                <div class="form-row justify-content-center">
                    <div class="form-group mx-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" v-model="driversInCity" id="driversInCity">
                            <label for="driversInCity" class="custom-control-label custom-control-label-success">Available drivers in cities</label>
                        </div>
                    </div>
                    <div class="form-group mx-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" v-model="driversOutCity" id="driversOutCity">
                            <label for="driversOutCity" class="custom-control-label custom-control-label-warning">Available drivers</label>
                        </div>
                    </div>
                    <div class="form-group mx-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" v-model="driversCanNot" id="driversCanNot">
                            <label for="driversCanNot" class="custom-control-label custom-control-label-danger">No available drivers</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-lg-5 d-lg-block d-none">
                <l-map
                        ref="map"
                        style="width: 100%; height: auto; min-height: 500px;"
                        :zoom="zoom"
                        :center="center"
                        :options="mapOptions"
                >
                    <l-marker :lat-lng="marker" v-for="(marker, index) in markers" :key="index"></l-marker>
                    <l-polyline-decorator :paths="[markers]" :patterns="patterns"></l-polyline-decorator>
                    <l-polyline :latLngs="markers"></l-polyline>
                    <l-tile-layer :url="url"></l-tile-layer>
                </l-map>
            </div>
            <div class="col-lg-7">
                <div v-if="list.length">
                    <paginate name="list" :list="list" :per="4" tag="div" class="row card-container py-0">
                        <div class="col-6 mb-3" v-for="item in paginated('list')">
                            <div class="card m-1" @mouseover="mapShow(item.location_from, item.location_to)" @mouseleave="resetMap">
                                <div class="card-body p-2">
                                    <div class="card-text container-fluid">
                                        <div class="row">
                                            <div class="col text-center">
                                                <span><b>{{ item.cargo.name }} ({{ item.cargo.weight }} t)</b></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <img :src="companySrc(item.company_from.id)" :alt="item.company_from.company_name" class="max-height-40">
                                            </div>
                                            <div class="col-1 text-center">
                                                <font-awesome-icon icon="angle-double-right"></font-awesome-icon>
                                            </div>
                                            <div class="col text-right">
                                                <img :src="companySrc(item.company_to.id)" :alt="item.company_to.company_name" class="max-height-40">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="d-flex justify-content-between">
                                                    <div class="">
                                                        <span class="font-size-12">{{ item.location_from.city }} </span><img :src="flagSrc(item.location_from.country.country)" :alt="item.location_from.country.country" style="border: 1px solid grey;" />
                                                    </div>
                                                    <div class=" text-right">
                                                        <span class="font-size-12">{{ item.location_to.city }} </span><img :src="flagSrc(item.location_to.country.country)" :alt="item.location_to.country.country" style="border: 1px solid grey;" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                {{ item.total_distance }} km
                                            </div>
                                            <div class="col text-right">
                                                {{ item.price_per_km | currency('€', 2, { thousandsSeparator: ' ', symbolOnLeft: false, spaceBetweenAmountAndSymbol: true }) }}/km
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="d-flex justify-content-between pb-1">
                                                    <div>
                                                        <span class="d-block">Expire in {{ item.gameTime | moment("ddd, HH:mm") }}</span>
                                                        <span class="d-block">Trip time: {{ getTimeFromMins((tripTime(item.total_distance) * 60).toFixed()) }} hod</span>
                                                    </div>
                                                    <div>
                                                        <span v-if="item.cargo.adr > 0"><img :src="'/images/skills/adr_' + item.cargo.adr + '.png'" alt="Skill adr" width="40px" :title="getSkills('adr', item.cargo.adr)"></span>
                                                        <span v-if="item.cargo.fragile > 0"><img :src="'/images/skills/fragile.png'" alt="Skill fragile" :title="getSkills('fragile')"></span>
                                                        <span v-if="item.cargo.high_value > 0"><img :src="'/images/skills/highvalue.png'" alt="Skill high value" :title="getSkills('high_value')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <button class="btn w-100" :class="getClass(item)" @click="take(item.id)">Take</button>
                                </div>
                            </div>
                        </div>
                    </paginate>
                    <paginate-links for="list" :async="true" :limit="4" :show-step-links="true" :hide-single-page="true" style="text-align: center;"></paginate-links>
                </div>
                <div v-else>
                    <template v-if="jobs && jobs.length === 0">
                        No available jobs now.
                    </template>
                    <template v-else>
                        None of jobs is matching the given selection.
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Form from "../Form";
    import L from 'leaflet';

    export default {
        name: "MarketJobs",
        props: ['speed', 'skills'],
        data() {
          return {
              jobs: null,
              drivers: null,
              url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
              zoom: 4,
              center: [50.40519, 16.51834],
              paginate: ['list'],
              markers: [],
              formMarketJob: new Form({
                job: ''
              }),
              dismissSecs: 30,
              dismissCountDown: 0,
              map: null,
              mapOptions: {zoomControl: false, attributionControl: false, zoomSnap: true},
              driversInCity: true,
              driversOutCity:true,
              driversCanNot: true,
              patterns: [
                  { offset: 25, repeat: 50, symbol: L.Symbol.arrowHead({pixelSize: 15, pathOptions: {fillOpacity: 1, weight: 0}}) }
              ]
          }
        },
        computed: {
            list() {
                return this.jobs ? this.jobs.filter(job => (this.driversInCity ? this.existsDriverInCity(job) : false) || (this.driversOutCity ? this.existsDriver(job) : false) || (this.driversCanNot ? this.dontExistDriver(job) : false)) : [];
            }
        },
        created() {
            axios.get('/jobs').then(data => {
                this.jobs = data.data;
            });
            axios.get('/getDrivers').then(data => {
                this.drivers = data.data;
            });
            Echo.channel('market-job-add').listen('MarketJobCreated', (data) => {
                this.jobs.push(data.marketJob);
            });
            Echo.channel('market-job-delete').listen('MarketJobDeleted', (data) => {
                let deletedJobID = data.marketJobID.id;
                this.jobs = this.jobs.filter(value => {
                    return value.id !== deletedJobID;
                });
            });
            axios.get('/current-money').then(data => {
                let id = data.data.id;
                Echo.private('drivers-update-' + id).listen('DriverUpdate', (data) => {
                    let driver = data.driver;
                    this.drivers = this.drivers.filter(value => {
                        return value.id !== driver.id;
                    });
                    this.drivers.push(driver);
                });
            });
        },
        methods: {
            flagSrc(name) {
                name = name.toLowerCase().replace(" ", "_");
                return "/images/flags/" + name + ".png";
            },
            companySrc(id) {
                return "/images/companies/" + id + ".png";
            },
            take(id) {
                this.formMarketJob.job = id;
                this.formMarketJob.post('/tasks/store').then(response => {
                    this.showAlert();
                });
            },
            mapShow(from, to) {
                this.markers = [
                    L.latLng(from.lat, from.lng),
                    L.latLng(to.lat, to.lng)
                ]
            },
            resetMap() {
                this.markers = [];
            },
            countDownChanged(dismissCountDown) {
                this.dismissCountDown = dismissCountDown
            },
            showAlert() {
                this.dismissCountDown = this.dismissSecs
            },
            tripTime(distance) {
                return distance / this.speed;
            },
            getTimeFromMins(mins) {
                let h = mins / 60 | 0,
                    m = mins % 60 | 0;
                return h + ":" + (m < 10 ? "0" + m : m);
            },
            getClass(task) {
                if (this.existsDriverInCity(task)) {
                    return 'btn-success';
                } else if (this.existsDriver(task)) {
                    return 'btn-warning';
                }
                return 'btn-danger';
            },
            existsDriverInCity(task) {
                return this.drivers ? this.drivers.some(driver => driver.status.status === "free" && driver.truck !== null && this.canDrive(driver, task) && driver.location_id === task.location_from_id) : false;
            },
            existsDriver(task) {
                return this.drivers ? this.drivers.some(driver => driver.status.status === "free" && driver.truck !== null && this.canDrive(driver, task) && driver.location_id !== task.location_from_id) : false;
            },
            dontExistDriver(task) {
                return this.drivers ? !this.drivers.some(driver => driver.status.status === "free" && driver.truck !== null && this.canDrive(driver, task)) : false;
            },
            canDrive(driver, task) {
                return driver.adr >= task.cargo.adr && driver.high_value >= task.cargo.high_value && driver.fragile >= task.cargo.fragile;
            },
            getSkills(type, num) {
                if (this.skills) {
                    if (type === 'adr') {
                        return this.skills[type][num - 1];
                    }
                    return this.skills[type];
                }

                return "";
            }
        },
        mounted() {
            this.$nextTick(() => {
                this.map = this.$refs.map.mapObject;
                this.map.touchZoom.disable();
                this.map.doubleClickZoom.disable();
                this.map.scrollWheelZoom.disable();
                this.map.boxZoom.disable();
                this.map.keyboard.disable();
                this.map.dragging.disable();
            });
        }
    }
</script>