
const token = () => {
    return localStorage.getItem("TOKEN")
}

/** Auth **/
export const login = (data) => {

    return axios.post('/api/auth/login',data)
}
export const logout = () => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.post('/api/auth/logout',{},config)
}
export const me = async () => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }
    return await axios.post('/api/auth/me',{},config)
}

/** Password **/
export const resetPassword = (data) => {

    return axios.post('/api/password/email',data)
}

export const setPassword = (data) => {

    return axios.post('/api/password/code/check',data)
}



export const main = () => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }
    return axios.get('/api/admin',config)
}

/** Categories **/
export const categoryStore = (data) => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.post('/api/admin/categories/store',data,config)
}

export const categoryIndex = () => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.get('/api/admin/categories',config)
}

export const categoryShow = (id) => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.get('/api/admin/categories/'+id,config)
}

export const categoryUpdate = (id,data) => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.put('/api/admin/categories/'+id,data,config)
}

export const categoryDelete = (id) => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.delete('/api/admin/categories/'+id,config)
}

/** Tags **/
export const tagStore = (data) => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.post('/api/admin/tags/store',data,config)
}

export const tagIndex = () => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.get('/api/admin/tags',config)
}

export const tagShow = (id) => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.get('/api/admin/tags/'+id,config);
}

export const tagUpdate = (id,data) => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.put('/api/admin/tags/'+id,data,config)
}

export const tagDelete = (id) => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.delete('/api/admin/tags/'+id,config)
}


/** Users **/
export const userStore = (data) => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.post('/api/admin/users/store',data,config)
}

export const userIndex = () => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.get('/api/admin/users',config)
}

export const userShow = (id) => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.get('/api/admin/users/'+id,config)
}

export const userUpdate = (id,data) => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.put('/api/admin/users/'+id,data,config)
}

export const userDelete = (id) => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.delete('/api/admin/users/'+id,config)
}


export const userRoles = () => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.get('/api/admin/users/role',config)
}


/** Posts **/
export const postStore = (data) => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json",
            'Content-Type': 'multipart/form-data'
        }
    }

    return  axios.post('/api/admin/posts/store',data,config);
}

export const postIndex = (page = 1, category = false,search = false) => {
    let url = '/api/admin/posts?page=' + page;
    if(category){
        url += '&category_id=' + category
    }
    if(search){
        url += '&q=' + search
    }
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.get(url,config)
}

export const postShow = (id) => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.get('/api/admin/posts/'+id,config)
}

export const postUpdate = (id,data) => {

    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json",
            'Content-Type': 'multipart/form-data'
        }
    }

    return axios.post('/api/admin/posts/'+id,data,config)
}

export const postDelete = (id,success,error) => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    axios.delete('/api/admin/posts/'+id,config).then((res) => {
        if(res.status === 200){
            success(res)
        }
        else {

            error(res)
        }
    }).catch(err => {
        console.log(err)
        error(err)
    })
}

export const postCategories = () => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.get('/api/admin/posts/category',config);
}


export const postTags = () => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.get('/api/admin/posts/tags',config)
}

export const accountIndex = () => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.get('/api/admin/account/',config)
}
export const accountStore = (id,data) => {

    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json",
            'Content-Type': 'multipart/form-data'
        }
    }

    return axios.post('/api/admin/account/'+id,data,config)
}



/***   FRONT ***/
export const postCategoriesFront = (success,error) => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    axios.get('/api/categories',config).then((res) => {
        if(res.status === 200){
            success(res)
        }
        else {

            error(res)
        }
    }).catch(err => {
        console.log(err)
        error(err)
    })
}

export const tagsFront = (success,error) => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.get('/api/tags',config);
}

export const postsHomeFront = () => {
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.get('/api/posts/home',config);
}

export const postsBlogFront = (page = 1, tag = false, category = false,query = false) => {
    let url = '/api/posts?page='+page
    if(tag){
        url = url + '&tag=' + tag
    }
    if(category){
        url = url + '&category=' + category
    }
    if(query){
        url = url + '&q=' + query
    }
    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.get(url,config);
}


export const postsItemFront = (id) => {
    let url = '/api/posts/'+id

    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.get(url,config);
}

export const contactsSend = (data) => {
    let url = '/api/contacts/send'

    const config = {
        headers:{
            "Authorization": "Bearer " + token(),
            "Accept":"application/json"
        }
    }

    return axios.post(url,data,config)
}


