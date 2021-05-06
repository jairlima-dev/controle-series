import axios from "axios";

export default {

    all(id) {
        return axios.get(`/api/serie/${id}`)
    }

//*** Original
    // all(id) {
    //     return axios.get(`/api/series/${id}`)
    // }

}
