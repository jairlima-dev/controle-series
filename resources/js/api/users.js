import axios from "axios";

export default {

    all() {
      return axios.get('api/register')
    },

    create(data) {
        return axios.post('/api/register', data)
    },

    delete(id) {
        return axios.delete(`/api/register/${id}`)
    }

}
