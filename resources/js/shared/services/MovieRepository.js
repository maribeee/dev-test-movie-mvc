import Repository from './Repository';

export default {
    getAllMovies() {
        return Repository.get(`/movies`).then(response => response.data);
    },
    setNewMovie(user_id, title, director, description, poster, length, status) {
        return Repository.post(`/movies/`, {user_id, title, director, description, poster, length, status}).then(response => response.data );
    },
    deleteMovie(movie_id) {
        return Repository.delete(`/movies/${movie_id}`).then(response => response.data);
    }
};
