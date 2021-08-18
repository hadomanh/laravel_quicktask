

    @extends('layouts.app')

    @section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col">
                
                <table id="todoList" class="table table-striped">
                    @include('todo.todoList')
                </table>

                <div class="d-flex justify-content-center">
                    <div id="addBtn" class="btn btn-outline-primary" style="width: 30%;">
                        <i class="bi bi-plus-circle"></i> Add
                    </div>
                </div>

            </div>

            <div id="addForm" style="display: none;" class="col-3">
                <form class="row" autocomplete="off">
                    <div class="col-12 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input id="titleAddForm" name="title" type="text" class="form-control" placeholder="Title...">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input id="descriptionAddForm" name="content" type="text" class="form-control" placeholder="Description...">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input id="deadlineAddForm" name="deadline" type="date" class="form-control">
                    </div>
                    <div class="col-12 mb-3">
                        <div onclick="handleAdd()" style="width: 100%;" class="btn btn-primary">Add</div>
                    </div>
                    <div class="col-12">
                        <div id="addFormCancelBtn" style="width: 100%;" class="btn btn-outline-secondary">Cancel</div>
                    </div>
                </form>
            </div>

            <div id="editForm" style="display: none;" class="col-3">
                <form class="row" autocomplete="off">
                    <div class="col-12 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input id="titleEditForm" type="text" class="form-control" placeholder="Title...">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input id="descriptionEditForm" type="text" class="form-control" placeholder="Description...">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input id="deadlineEditForm" type="date" class="form-control">
                    </div>
                    <div class="col-12 mb-3">
                        <select id="statusEditForm" class="form-select">
                            <option value="0">Todo</option>
                            <option value="1">On progress</option>
                            <option value="2">Done</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <div onclick="handleEdit()" style="width: 100%;" class="btn btn-warning">Save changes</div>
                    </div>

                    <div class="col-12">
                        <div id="editFormCancelBtn" style="width: 100%;" class="btn btn-outline-secondary">Cancel</div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    @endsection

    @push('scripts')
        
    <script>
        let todoListTable
        let addBtn
        let addForm
        let addFormCancelBtn
        let editBtnArr
        let editForm
        let btnGroupArr
        let editFormCancelBtn
        let deleteBtnArr
        let deleteConfirmBtnGroupArr
        let deleteCancelBtnArr

        let titleAddForm
        let descriptionAddForm
        let deadlineAddForm

        let titleTodoArr
        let contentTodoArr
        let deadlineTodoArr
        let statusTodoArr

        let titleEditForm
        let descriptionEditForm
        let deadlineEditForm
        let statusEditForm

        let currentTodoId

        function loadElement() {
            addBtn = document.getElementById('addBtn')
            addForm = document.getElementById('addForm')
            addFormCancelBtn = document.getElementById('addFormCancelBtn')
            editBtnArr = document.querySelectorAll('.editBtn')
            editForm = document.getElementById('editForm')
            btnGroupArr = document.querySelectorAll('.btnGroup')
            editFormCancelBtn = document.getElementById('editFormCancelBtn')
            deleteBtnArr = document.querySelectorAll('.deleteBtn')
            deleteConfirmBtnGroupArr = document.querySelectorAll('.deleteConfirmBtnGroup')
            deleteCancelBtnArr = document.querySelectorAll('.deleteCancelBtn')
            todoListTable = document.getElementById('todoList')
            titleAddForm = document.getElementById('titleAddForm')
            descriptionAddForm = document.getElementById('descriptionAddForm')
            deadlineAddForm = document.getElementById('deadlineAddForm')
            titleTodoArr = document.querySelectorAll('.titleTodo')
            contentTodoArr = document.querySelectorAll('.contentTodo')
            deadlineTodoArr = document.querySelectorAll('.deadlineTodo')
            statusTodoArr = document.querySelectorAll('.statusTodo')


            titleEditForm = document.getElementById('titleEditForm')
            descriptionEditForm = document.getElementById('descriptionEditForm')
            deadlineEditForm = document.getElementById('deadlineEditForm')
            statusEditForm = document.getElementById('statusEditForm')
        
            addBtn.addEventListener('click', () => {
                addBtn.style.display = 'none'
                addForm.style.display = ''
        
                btnGroupArr.forEach(btnGroup => {
                    btnGroup.style.display = 'none'
                })
        
                deleteConfirmBtnGroupArr.forEach(btnGroup => {
                    btnGroup.style.display = 'none'
                })
            })
        
            addFormCancelBtn.addEventListener('click', () => {
                addForm.style.display = 'none'
                addBtn.style.display = ''
        
                btnGroupArr.forEach(btnGroup => {
                    btnGroup.style.display = ''
                })
            })
        
            editBtnArr.forEach((editBtn, index) => {
                editBtn.addEventListener('click', () => {
                    currentTodoId = editBtn.getAttribute('data-todo-id')

                    editForm.style.display = ''
                    addBtn.style.display = 'none'

                    titleEditForm.value = titleTodoArr[index].innerText
                    descriptionEditForm.value = contentTodoArr[index].innerText
                    deadlineEditForm.value = deadlineTodoArr[index].innerText
        
                    btnGroupArr.forEach(btnGroup => {
                        btnGroup.style.display = 'none'
                    })
        
                })
            })
        
            editFormCancelBtn.addEventListener('click', () => {
                editForm.style.display = 'none'
                addBtn.style.display = ''
        
                btnGroupArr.forEach(btnGroup => {
                    btnGroup.style.display = ''
                })
            })
        
            deleteBtnArr.forEach((deleteBtn, index) => {
                deleteBtn.addEventListener('click', () => {
                    btnGroupArr.forEach(btnGroup => {
                        btnGroup.style.display = 'none'
                    })
                    addBtn.style.display = 'none'
                    deleteConfirmBtnGroupArr[index].style.display = ''
                })
            })
        
            deleteCancelBtnArr.forEach((deleteCancelBtn, index) => {
                deleteCancelBtn.addEventListener('click', () => {
                    btnGroupArr.forEach(btnGroup => {
                        btnGroup.style.display = ''
                    })
                    addBtn.style.display = ''
                    deleteConfirmBtnGroupArr[index].style.display = 'none'
                })
            })
        }

        window.onload = () => {
            loadElement()
        }

        function handleDelete(element) {
            const todoId = element.getAttribute('data-todo-id')
            const url = `todo/delete/${todoId}`
            const method = 'GET'
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                todoListTable.innerHTML = this.responseText
                addBtn.style.display = ''
                loadElement()
            }
            xhttp.open(method, url);
            xhttp.send();

        }

        function handleAdd() {
            const url = `todo/add?title=${titleAddForm.value}&content=${descriptionAddForm.value}&deadline=${deadlineAddForm.value}`
            const method = 'GET'
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                todoListTable.innerHTML = this.responseText
                addForm.style.display = 'none'
                addBtn.style.display = ''
        
                btnGroupArr.forEach(btnGroup => {
                    btnGroup.style.display = ''
                })
                loadElement()
                titleAddForm.value = ''
                descriptionAddForm.value = ''
                deadlineAddForm.value = ''
            }
            xhttp.open(method, url);
            xhttp.send();
        }

        function handleEdit() {
            const url = `todo/edit?id=${currentTodoId}&title=${titleEditForm.value}&content=${descriptionEditForm.value}&deadline=${deadlineEditForm.value}&status=${statusEditForm.value}`
            const method = 'GET'
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                todoListTable.innerHTML = this.responseText
                editForm.style.display = 'none'
                addBtn.style.display = ''
        
                btnGroupArr.forEach(btnGroup => {
                    btnGroup.style.display = ''
                })
                loadElement()
                titleEditForm.value = ''
                descriptionEditForm.value = ''
                deadlineEditForm.value = ''
                statusEditForm.value = ''
            }
            xhttp.open(method, url);
            xhttp.send();
        }


    </script>
    @endpush
    