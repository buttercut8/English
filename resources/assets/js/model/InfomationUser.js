class InfomationUser{
    static all(then){
        return axios.post('/infomation-user',{'id': id()})
                .then( ({data}) => then(data) );
    }
}

export default InfomationUser
