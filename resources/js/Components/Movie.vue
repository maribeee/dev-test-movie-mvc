<template>
    <div class="item-card">
        <div>
            <div class="item-card__header" :style="{ backgroundImage: 'url(' + movie.poster + ')' }">
                <div class="opacity" />
                <h3>{{ movie.title }}</h3>
            </div>
            <div class="item-card__body">
                <div>
                    <p><span>Description:</span> {{ movie.description }}</p>
                    <p><span>Director:</span> {{ movie.director }}</p>
                    <p><span>Length:</span> {{ movie.length }} minutes</p>
                    <p><span>Status:</span> {{ getStatus }}</p>
                </div>
                <div>
                    <p class="fake-link" @click="deleteMovie()">Delete Movie</p>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import { RepositoryFactory } from  '../shared/services/RepositoryFactory';

const MovieRepo = RepositoryFactory.get('movies');

export default {
    name: "Movie",
    data() {
        return {
        }
    },
    props: {
        movie: {
            type: Object,
            required: true,
        },
    },
    computed: {
        getStatus() {
            return this.movie.status === 0 ? 'Not Active' : 'Active';
        }
    },
    methods: {
        async deleteMovie() {
            await MovieRepo.deleteMovie(this.movie.id);
            await this.$emit('getAllMovies');
        }
    }
}
</script>

<style lang="scss" scoped>
.item-card {

    background-color: #ececec;
    margin: 0 20px;
    height: 100%;
    display: flex;
    flex-direction: column;
    flex-flow: row wrap;

    >div {
        width: 100%;
    }

    &__header {
        height: 150px;
        background-size: cover;
        position: relative;
        display: flex;

        .opacity {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(transparent, black);
            z-index: 10;
        }

        h3 {
            position: absolute;
            bottom: 30px;
            left: 20px;
            color: #fff;
            z-index: 11;
        }
    }

    &__body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        p > span {
            font-weight: 700;
        }

    }

}
</style>
