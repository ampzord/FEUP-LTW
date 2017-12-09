'use strict';

// let listName = null;
// let teamName = null;
// Id of last message received
let last_id = -1

let container = document.querySelector('.notesContainer');
let form = document.querySelector('form[name=addListForm]');
 let taskForms;
// for(let i = 0; i < taskForms.length; i++)
//   taskForms[i].addEventListener('submit', addTask);

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

  // // Delete sent message
  // document.querySelector('input[name=message]').value='';

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

// Called when messages are received
function listsReceived() {
  container.innerHTML = "";  //Clears container
  let lines = JSON.parse(this.responseText);

  lines.forEach(function(data){

    let line = document.createElement('div');
    let p = document.createElement('p');
    let table = document.createElement('table'); 
    let taskForm = document.createElement('form');

    taskForm.name = 'addTaskForm';

    line.classList.add('notes');
    line.innerHTML = '<h2>' + data.listName + ' - ' + data.teamName + '</h2>';

    


    for(let i = 0; i < data.tasks.length; i++){
      table.innerHTML += '<tr style="height:40px;"><td style="background-color:#000; border-radius:0px; padding:10px 10px 10px 10px;"">'
       + data.tasks[i].field + '</td><td><button name="done" id="doneButton"></button><button name="delete" id="deleteButton"></button></td></tr>';
    }

    table.innerHTML += '<tr><td style="width:100%;"><input type="text" id="' + 
                        data.listId + 
                        '" placeholder="New Task"></input></td><td><input type="submit" name="addTask" value="Add"></input></td></tr>'; 

    p.append(table);
    taskForm.append(p);
    line.append(taskForm);
    
    container.append(line);

    // container.scrollTop = container.scrollTopMax;
  });

  taskForms = document.querySelectorAll('form[name=addTaskForm]');
  for(let i = 0; i < taskForms.length; i++)
    taskForms[i].addEventListener('submit', addTask);
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}
