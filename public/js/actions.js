


const initial = ()=>{
    const form = document.querySelector('#form-task');

    form.addEventListener('submit', (event)=>{
        event.preventDefault()
        let data = new FormData(document.querySelector('#form-task'))
        if( Request('tasks',data, 'POST'))
        {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'),{})
            myModal.hide()

            notification('success', 'tarefa criada com sucesso ');
            document.location.reload();
        }else{
            notification('error','ocorreu um erro ao inserir nova tarefa');
        }
    })
}

initial();

const handleMoveTask = (id, status, change = 0)=>{

    let status_task = (status === 0)? 1 : 0;
    
    if(change<2){
        if(Request(`tasks/${id}?status=${status_task}`,{status:status}, 'PUT'))
        {
            var node = document.getElementById(`tasks-${id}`)
            if(node.parentNode)
            {
                node.parentNode.removeChild(node)
            }
             document.location.reload();
        
        }else{
            notification('error','ocorreu um erro ao mover tarefa');
        }
    }else{
        notification('error','Tarefa atingiu o limite');
    }
}

const render = (tasks = null, element, checked=false)=>{

    let html = '';
    const container = document.querySelector(`#${element}`);

    if(tasks)
    {
        tasks.map((task)=>{
            html += `
                <div class='form-check py-2 border-bottom'>
                    <input type="checkbox"  class="form-check-input" name="" id="" ${(checked)?'checked':''}>
                    <label class="form-check-label" for="">
                    ${task.title_task}
                    </label>
                </div>`
        
        })
        container.innerHTML = html
    }

    return
}

const handleDelete = (id)=>{
    if(Request(`tasks/${id}`, '','DELETE'))
    {
        notification('success','Tarefa removida');
        document.location.reload()
    }else{
        notification('error','ocorreu um erro ao remover tarefa');
    }
}

const notification = (type = null, msg='') =>{

    const toastLiveExample = document.getElementById('liveToast')
    const toast = new bootstrap.Toast(toastLiveExample)

    if(toastLiveExample.classList.contains('bg-success'))
        toastLiveExample.classList.remove('bg-success');

    if(toastLiveExample.classList.contains('bg-danger'))
        toastLiveExample.classList.remove('bg-danger');


    const elementMsg = document.querySelector('#msg-notification');

    switch(type)
    {
        case 'success':
            elementMsg.innerHTML = msg;
            toastLiveExample.classList.add('bg-success');
            break;
        case 'error':
            toastLiveExample.classList.add('bg-danger');
            elementMsg.innerHTML = msg;
            break;
    }

    toast.show()
}

const Request = async(url, data, method) =>{
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const urlbase = document.querySelector('base').getAttribute('href');
    
    const request = await fetch(`${urlbase}/${url}`,{
        method,
        headers:{
            'X-CSRF-TOKEN': token,
        }, 
        body: data       
    })
    .then(function (response){
        response.json().then(function(data){
           return data
        });
    }).catch(function(err){
        console.error('failed retrieving information', err);
        return false
    })
}



