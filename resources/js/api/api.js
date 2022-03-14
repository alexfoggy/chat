import * as  axios from "axios";
const url = '/'
const token = document.getElementById('app').getAttribute('data-token');
//GET
export const getUsers = () => {
    return axios.get(`${url}api/users/`)

}
export const getUser = () => {
    return axios.get(`${url}api/users/${token}`)
}



export const getTasks = async () => {
    return await axios.get(`${url}api/users/${token}/tasks`)
}
export const getNewTasks = async () => {
    return await axios.get(`${url}api/users/${token}/tasks?filter=new`)
}
export const getInProgressTasks = async () => {
    return await axios.get(`${url}api/users/${token}/tasks?filter=in_progress`)
}

export const getDeliveredTasks = async () => {
    return await axios.get(`${url}api/users/${token}/tasks?filter=delivered`)
}

export const getReadytoInvoiceTasks = async () => {
    return await axios.get(`${url}api/users/${token}/tasks?filter=ready_to_invoice`)
}
export const getInvoiceTasks = async () => {
    return await axios.get(`${url}api/users/${token}/tasks?filter=invoiced`)
}
export const getProjects = () => {
    return axios.get('/manager/projects')
}
export const getTasksCompleted = () => {
    return axios.get('/api/tasks?filter=invoiced')
}
export const getTask = async () => {
    return await axios.get(`${url}api/tasks`)
}
export const buttonStatus = () => {
    return axios.get(`${url}api/users/${token}/tasks/length`)
}
export const getLanguages = () => {
    return axios.get(`${url}api/languages/`)
}

export const getCountries = () => {
    return axios.get(`${url}api/countries`)
}
//GET

//ProfileUpdate

export const profileUpdate = (email, phone, gender, main_language, main_level, birth_date, paypal, country, second_language, second_country, second_level) => {
    return axios.patch(`/api/users/${token}`, { email, phone, gender, main_language, main_level, birth_date, paypal, country, second_language, second_country, second_level })
}

export const projectUpdate = (
    title,
    language,
    budjet,
    country,
    gender,
    envirnment,
    level,
    project_type,
    rules, script,
    subject,
    task_count,
    voice) => {
    return axios.post(`${url}manager/projects`,
        [{
            title,
            language,
            budjet,
            country,
            gender,
            envirnment,
            level,
            project_type,
            rules,
            script,
            subject,
            task_count,
            voice
        }])
}
export const updateStatus = (id, status) => {
    return axios.put(`${url}api/tasks/${id}`, { complete_status: status })
}

export const getToken = () => {
    return token;
}
