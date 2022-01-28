import MovieRepository from './MovieRepository';

const repositories = {
    movies: MovieRepository,
};

export const RepositoryFactory = {
    get: name => repositories[name],
};
