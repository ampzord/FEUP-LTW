'use strict';

let container = document.querySelector('.notesContainer');
let form = document.querySelector('form[name=addListForm]');
let taskForms;
let del;
let delAll;

form.addEventListener('submit', addNote);

// Run refresh every 5s
window.setInterval(refresh, 5000);

// Run refresh when starting
refresh();

// Ask for new messages
function refresh() {

  let request = new XMLHttpRequest();
  request.open('get', 'addNewTaskList.php', true);
  request.addEventListener('load', listsReceived);

request.send();
}

// Send message
function addNote(event) {
  let listName = document.querySelector('input[name=listName]').value;
  let teamName = document.querySelector('select[name=teamName]').value;

  // Send message
  let request = new XMLHttpRequest();
  request.open('get', 'addNewTaskList.php?' + encodeForAjax({'listName': listName, 'teamName': teamName}), true);
  request.addEventListener('load', listsReceived);
  request.send();

  event.preventDefault();
}

function addTask(event) {
    let taskValue = event.target.querySelector('input[type=text]').value;
    let listId = event.target.querySelector('input[type=text]').id;

    let request = new XMLHttpRequest();
    request.open('get', 'addNewTaskList.php?' + encodeForAjax({'taskValue': taskValue, 'listId': listId}), true);
    request.addEventListener('load', listsReceived);
    request.send();
  
    event.preventDefault();
  }

  function deleteTask(event) {
    let deleteTaskId = event.currentTarget.name;

    let request = new XMLHttpRequest();
    request.open('get', 'addNewTaskList.php?' + encodeForAjax({'deleteTaskId': deleteTaskId}), true);
    request.addEventListener('load', listsReceived);
    request.send();
  
    event.preventDefault();
  }

  function deleteAllTask(event) {
    let deleteAll = event.currentTarget.name;

    let request = new XMLHttpRequest();
    request.open('get', 'addNewTaskList.php?' + encodeForAjax({'deleteAll': deleteAll}), true);
    request.addEventListener('load', listsReceived);
    request.send();
  
    event.preventDefault();
  }

// Called when messages are received
function listsReceived() {
  //container.innerHTML = "";  //Clears container
  let lines = JSON.parse(this.responseText);
  let padding = 0;
	let list;
	let ite = 0;
    //let lists =  document.querySelectorAll('button[id=deleteAllButton]');
  lines.forEach(function(data){
    if(data.modified){
        let line = document.createElement('div');
        let p = document.createElement('p');
        let table = document.createElement('table'); 
        let taskForm = document.createElement('form');

        padding++;

        taskForm.name = 'addTaskForm';

        line.classList.add('notes');
        line.innerHTML = '<h2><table><tr><td style="width:24px;"></td><td style="width:100%;">' 
                                        + data.listName + ' - ' + data.teamName + '</td><td><button id="deleteAllButton" name="'+ data.listId +'"></button></td><tr></table></h2>';

        for(let i = 0; i < data.tasks.length; i++){
                table.innerHTML += '<tr style="height:40px;"><td style="background-color:#000; border-radius:0px; padding:10px 10px 10px 10px;"">'
                        + data.tasks[i].field + '</td><td><div class="dropdown"><button name="done" id="doneButton" onclick="event.preventDefault();">'+
                        '</button><div class="dropdown-contentEdit">' +
                        '<button id="todoBt">To-do</button><button id="doingBt">Doing</button><button id="doneBt">Done</button>' +
                        '</div></div><button name="'+ data.tasks[i].taskId +'" id="deleteButton"></button></td></tr>';
                }

                table.innerHTML += '<tr><td style="width:100%;"><input type="text" id="' + 
                                                        data.listId + 
                                                        '" placeholder="New Task"></input></td><td><input type="submit" name="addTask" value="Add"></input></td></tr>';                   

        p.append(table);
        taskForm.append(p);
        line.append(taskForm);

        container.append(line);
    }
	
    });

    taskForms = document.querySelectorAll('form[name=addTaskForm]');
    for(let i = 0; i < taskForms.length; i++)
        taskForms[i].addEventListener('submit', addTask);

    del = document.querySelectorAll('button[id=deleteButton]');
    for(let i = 0; i < del.length; i++)
        del[i].addEventListener('click', deleteTask);

    delAll = document.querySelectorAll('button[id=deleteAllButton]');
    for(let i = 0; i < delAll.length; i++)
        delAll[i].addEventListener('click', deleteAllTask);
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}
