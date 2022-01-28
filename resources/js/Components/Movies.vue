<template>
    <section>
        <div class="row inventory-header">

            <div class="left">
                <h1>Movies</h1>
            </div>

            <div class="right">
                <button @click="showAddMovie = true">
                    Add Movie
                </button>
            </div>
        </div>

        <transition name="slide">
            <div id="addItem" class="row" v-if="showAddMovie">
                <div class="col-12">
                    <form @submit.prevent>
                        <div class="row">
                            <div class="col-6">
                                <h3>
                                    Add Movie
                                </h3>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0)" class="float-right" @click="showAddMovie = false">Cancel</a>
                            </div>
                        </div>
                        <label for="newMovieTitle">Movie Title*</label>
                        <input name="newMovieTitle" type="text" id="newMovieTitle" v-model="newMovieTitle" required/>

                        <label for="newMovieDirector">Director*</label>
                        <input name="newMovieDirector" type="text" id="newMovieDirector" v-model="newMovieDirector" required/>

                        <label for="newMovieDescription">Description*</label>
                        <textarea name="newMovieDescription" id="newMovieDescription" v-model="newMovieDescription" required/>

                        <label for="newMoviePoster">Poster URL*</label>
                        <input name="newMoviePoster" type="text" id="newMoviePoster" v-model="newMoviePoster" required>

                        <label for="newMovieLength">Current Movie Length* (minutes)</label>
                        <input name="newMovieLength" type="number" id="newMovieLength" v-model="newMovieLength" required>

                        <label for="newMovieStatus">Current Movie Status*</label>
                        <input name="newMovieStatus" type="number" id="newMovieStatus" v-model="newMovieStatus" required>

                        <label for="newMovieUserID">Set owner*</label>
                        <input name="newMovieUserID" type="number" id="newMovieUserID" v-model="newMovieUserID" required>

                        <div class="row">
                            <button @click="submitNewMovie">Add Movie</button>
                        </div>

                        <!-- todo: Add error messaging-->
                    </form>
                </div>
            </div>
        </transition>

        <div class="row">
            <div class="col-12 mb50">
                <span class="fake-link" @click="filterAvailableToggle">All Available Movies</span> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; <span class="fake-link" @click="filterUnavailableToggle">All Unavailable Movies</span>  &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;  <span class="fake-link" @click="showAll">Show All Movies</span>
            </div>
        </div>

        <div class="inventory row">
            <article class="col-4" v-for="movie in filteredMovies">
                <Movie :movie="movie" @getAllMovies="getAllMovies" />
            </article>
        </div>

    </section>
</template>

<script>
import Movie from './Movie';
import { RepositoryFactory } from  '../shared/services/RepositoryFactory';

const MovieRepo = RepositoryFactory.get('movies');

export default {
    name: "Movies",
    components: {
        Movie,
    },
    data() {
        return {
            allMovies: {},
            showAddMovie: false,
            newMovieUserID: null,
            newMovieTitle: null,
            newMovieDirector: null,
            newMovieDescription: null,
            newMoviePoster: null,
            newMovieLength: null,
            newMovieStatus: null,
            filterAvailable: false,
            filterUnavailable: false,
        }
    },
    async mounted() {
        await this.getAllMovies();
    },
    computed: {
        filteredMovies() {

            const movies = Object.values(this.allMovies);

            if ( !this.filterUnavailable && !this.filterAvailable) {
                return this.allMovies;
            }

            if (this.filterAvailable) {
                return movies.map( movie => {
                    if (movie.status === 1) {
                        return movie;
                    }
                });
            }

            if (this.filterUnavailable) {
                return movies.map( movie => {
                    if (movie.status === 0) {
                        return movie;
                    }
                });
            }

        }
    },
    methods: {
        async getAllMovies() {
            this.allMovies = await MovieRepo.getAllMovies();
        },
        async submitNewMovie() {
            await MovieRepo.setNewMovie(this.newMovieUserID, this.newMovieTitle, this.newMovieDirector, this.newMovieDescription, this.newMoviePoster, this.newMovieLength, this.newMovieStatus);
            await this.getAllMovies();
            this.clearAllMovieInfo();
        },
        clearAllMovieInfo() {
            this.showAddMovie = false;
            this.newMovieUserID = null;
            this.newMovieTitle = null;
            this.newMovieDirector = null;
            this.newMovieDescription = null;
            this.newMoviePoster = null;
            this.newMovieLength = null;
            this.newMovieStatus = null;
        },
        filterAvailableToggle() {
            this.filterAvailable = !this.filterAvailable;
            this.filterUnavailable = false;
        },
        filterUnavailableToggle() {
            this.filterUnavailable = !this.filterAvailable;
            this.filterAvailable = false;
        },
        showAll() {
            this.filterUnavailable = false;
            this.filterAvailable = false;
        },
    }
}
</script>

<style lang="scss" scoped>
section {
    padding: 20px 150px;

    .inventory-header {

        display: flex;
        flex-direction: row;
        justify-content: space-between;

        h1 {
            color: #b4d455;
            margin-bottom: 60px;
        }
    }
    .inventory {

        article {
            display: flex;
            flex-direction: column;
            flex: 1;
            flex-grow: 0;
            flex-basis: 33%;
            margin-bottom: 50px;
            height: auto;
        }
    }

    form {
        background-color: #ececec;
        padding: 40px;
        margin: 0 auto 50px;
        width: 500px;
    }
}
</style>
