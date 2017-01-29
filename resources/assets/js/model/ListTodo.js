class ListTodo{
    static all(then){
        return axios.get('/api/list-todo')
                .then( ({data}) => then(data) );
    }
}


export default ListTodo
