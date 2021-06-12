import http from "../http";

export default {

    all() {
      return http.get('api/register')
    },

    create(data) {
        return http.post('/api/register', data)
    },

    delete(id) {
        return http.delete(`/api/register/${id}`)
    }

}
