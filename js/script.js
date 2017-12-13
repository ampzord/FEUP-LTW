'use strict';

let container = document.querySelector('.notesContainer');
let form = document.querySelector('form[name=addListForm]');
let taskForms;
let del;
let delAll;
let doneBt;
let todoBt;
let doingBt;

form.addEventListener('submit', addNote);

// Run refresh every 5s
window.setInterval(refresh, 5000);

// Run refresh when starting
let startFlag = 1;
let modified = 0;
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
	modified = 1;
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
		modified = 1;	
    let taskValue = event.target.querySelector('input[type=text]').value;
    let listId = event.target.querySelector('input[type=text]').id;

    let request = new XMLHttpRequest();
    request.open('get', 'addNewTaskList.php?' + encodeForAjax({'taskValue': taskValue, 'listId': listId}), true);
    request.addEventListener('load', listsReceived);
    request.send();
  
    event.preventDefault();
	}

	function parseDoneState(doneEnum){
		switch(doneEnum){
			case 'todoBt':
				return 0;
				break;
			case 'doingBt':
				return 1;
				break;
			case 'doneBt':
				return 2;
				break;
		}
	}
	
	function doneState(event) {
		let taskId = event.currentTarget.name;
		let doneState = parseDoneState(event.currentTarget.attributes.id.value);

		modified = 1;	
    let request = new XMLHttpRequest();
		request.open('get', 'addNewTaskList.php?' + encodeForAjax({'doneState': doneState, 'taskId': taskId}), true);
    request.addEventListener('load', listsReceived);
    request.send();
  
    event.preventDefault();
	}

  function deleteTask(event) {
    let deleteTaskId = event.currentTarget.name;
		modified = 1;	
    let request = new XMLHttpRequest();
    request.open('get', 'addNewTaskList.php?' + encodeForAjax({'deleteTaskId': deleteTaskId}), true);
    request.addEventListener('load', listsReceived);
    request.send();
  
    event.preventDefault();
  }

  function deleteAllTask(event) {
    let deleteAll = event.currentTarget.name;
		modified = 1;	
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

		if(modified || startFlag){
				startFlag = 0;
				modified = 0;
        container.innerHTML = '';
        lines.forEach(function(data){
                let line = document.createElement('div');
                let p = document.createElement('p');
                let table = document.createElement('table'); 
								let taskForm = document.createElement('form');
								let color = 0;

                padding++;

                taskForm.name = 'addTaskForm';

                line.classList.add('notes');
                line.innerHTML = '<h2><table><tr><td style="width:24px;"></td><td style="width:100%;">' 
                                                + data.listName + ' - ' + data.teamName + '</td><td><button id="deleteAllButton" name="'+ data.listId +'"></button></td><tr></table></h2>';

                for(let i = 0; i < data.tasks.length; i++){
									switch(data.tasks[i].doneState){
										case "0":
											color = "#000";
											break;
										case "1":
											color = "#666";
											break;
										case "2":
											color = "#999";
											break;
									}
									
												table.innerHTML += '<tr style="height:40px;"><td style="background-color:' + color +
												'; border-radius:0px; padding:10px 10px 10px 10px;"">'
												+ data.tasks[i].field + '</td><td><div class="dropdown"><button name="done" id="doneButton" onclick="event.preventDefault();">'+
												'</button><div class="dropdown-contentEdit">' +
												'<button id="todoBt" onclick="event.preventDefault();" name="'+ data.tasks[i].taskId +'">To-do</button><button id="doingBt" onclick="event.preventDefault();" name="'+ data.tasks[i].taskId +
												'">Doing</button><button id="doneBt" onclick="event.preventDefault();" name="'+ data.tasks[i].taskId +'">Done</button>' +
												'</div></div><button name="'+ data.tasks[i].taskId +'" id="deleteButton"></button></td></tr>';
                }

                table.innerHTML += '<tr><td style="width:100%;"><input type="text" id="' + 
                                    data.listId + 
                                    '" placeholder="New Task"></input></td><td><input type="submit" name="addTask" value="Add"></input></td></tr>';                   

                p.append(table);
                taskForm.append(p);
                line.append(taskForm);

                container.append(line);
        });
    }

    taskForms = document.querySelectorAll('form[name=addTaskForm]');
    for(let i = 0; i < taskForms.length; i++)
        taskForms[i].addEventListener('submit', addTask);

    del = document.querySelectorAll('button[id=deleteButton]');
    for(let i = 0; i < del.length; i++)
        del[i].addEventListener('click', deleteTask);

    delAll = document.querySelectorAll('button[id=deleteAllButton]');
    for(let i = 0; i < delAll.length; i++)
				delAll[i].addEventListener('click', deleteAllTask);
				
		doneBt = document.querySelectorAll('button[id=doneBt]');
		for(let i = 0; i < doneBt.length; i++)
				doneBt[i].addEventListener('click', doneState);

		doingBt = document.querySelectorAll('button[id=doingBt]');
		for(let i = 0; i < doingBt.length; i++)
				doingBt[i].addEventListener('click', doneState);

		todoBt = document.querySelectorAll('button[id=todoBt]');
		for(let i = 0; i < todoBt.length; i++)
			todoBt[i].addEventListener('click', doneState);
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}
