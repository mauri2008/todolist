<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" id="meta-csrf" />
  
    <title>To-do-list</title>

    <!--BASEURL-->
    <base href="{{ url('/') }}" target="_self">

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- CSS Fontawesome -->
    <link href="{{url('assets/fontawesome/css/all.css')}}" rel="stylesheet">
    <!-- JS budle bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</head>
    <body>
        <div class="container-fluid">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                   <h2 class="mt-3 mb-3"><i class="fas fa-tasks"></i> To-Do-List</h2> 
                   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"></i> Nova Tarefa</button>
                </div>
                
                <hr>

                <div class="row">
                    <div class="col-12">
                        <h5><i class="fas fa-list"></i> Tarefas Pendentes</h5>
                        
                        <div id="tasksopen">
                            @foreach($tasks as $task)
                                @if($task->status_task == 0)
                                <div class="form-check py-2 border-bottom " id="tasks-{{$task->id}}">

                                    <div class="d-flex  align-items-center">
                                        <div class="me-3">
                                            <input type="checkbox"  class="form-check-input mr-3" name="tasks-{{$task->id}}" onclick="handleMoveTask({{$task->id}}, {{$task->status_task}})">
                                        </div>
                                        <div class="d-flex flex-column ml-3" >
                                            <span>{{$task->title_task}} <small class="ms-2 text-danger" style="cursor:pointer" onclick="handleDelete({{$task->id}})"><i class="far fa-trash-alt"></i></small></span>
                                            <small class="fw-light">{{$task->descr_task}}</small>
                                            <small class="fw-light">{{$task->name_resp_task}} - {{$task->email_resp_task}}</small>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <h5 class="mb-3"><i class="far fa-check-circle"></i> Tarefas Concluidas </h5>

                        <div id="tasksclose">
                            @foreach($tasks as $task)
                                @if($task->status_task == 1)
                                <div class="form-check py-2 border-bottom " id="tasks-{{$task->id}}">

                                    <div class="d-flex  align-items-center">
                                        <div class="me-3">
                                            <input type="checkbox"  class="form-check-input mr-3" name="tasks-{{$task->id}}" onclick="handleMoveTask({{$task->id}}, {{$task->status_task}}, {{$task->change_count_task}})" checked>
                                        </div>
                                        <div class="d-flex flex-column ml-3" >
                                            <span><del>{{$task->title_task}}</del> <small class="ms-2 text-danger" style="cursor:pointer" onclick="handleDelete({{$task->id}})"><i class="far fa-trash-alt"></i></small></span>
                                            <small class="fw-light">{{$task->descr_task}}</small>
                                            <small class="fw-light">{{$task->name_resp_task}} - {{$task->email_resp_task}}</small>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal -->

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nova Tarefa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-task">
                        <div class="mb-3 input-group input-group-sm">              
                          <input type="text"
                            class="form-control" name="title_task" id="title_task" aria-describedby="helpId" placeholder="Titulo da Tarefa">
                        </div>
                        <div class="mb-3 input-group input-group-sm">              
                          <textarea type="text"
                            class="form-control" name="descr_task" id="title_task" aria-describedby="helpId" placeholder="Insira uma breve descrição da tarefa"></textarea>
                        </div>
                        <div class="mb-3 input-group input-group-sm">              
                          <input type="text"
                            class="form-control" name="name_resp_task" id="title_task" aria-describedby="helpId" placeholder="Nome do responsavel">
                        </div>
                        <div class="mb-3 input-group input-group-sm">              
                          <input type="email"
                            class="form-control" name="email_resp_task" id="title_task" aria-describedby="helpId" placeholder="Email do responsavels">
                        </div> 
                        <div class=" col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary " >Salvar</button>
                        </div>                   

                    </form>
                </div>
                <div class="modal-footer">

                </div>
                </div>
            </div>
        </div>
        @include('component.toast')
    <script src="{{url('js/actions.js')}}"></script>
    </body>

</html>