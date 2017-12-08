'use strict';

// let listName = null;
// let teamName = null;
// Id of last message received
//let last_id = -1 

let container = document.querySelector('.notesContainer');
let form = document.querySelector('form[name=addListForm]');

form.addEventListener('submit', addNote);


// Run refresh every 5s
window.setInterval(refresh, 5000);

// Run refresh when starting
refresh();

// Ask for new messages
function refresh() {
  let request = new XMLHttpRequest();
  request.open('get', 'addNewList.php', true);
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
  request.open('get', 'addNewList.php?' + encodeForAjax({'listName': listName, 'teamName': teamName}), true);
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

    line.classList.add('notes');
    line.innerHTML = '<h2>' + data.listName + ' - ' + data.teamName + '</h2>';

    


    for(let i = 0; i < data.tasks.length; i++){
      table.innerHTML += '<tr style="height:40px;"><td style="background-color:#000; border-radius:0px; padding:10px 10px 10px 10px;"">'
       + data.tasks[i].field + '</td><td><button name="done" id="doneButton"></button><button name="delete" id="deleteButton"></button></td></tr>';
    }

    table.innerHTML += '<tr><td style="width:100%;"><form><input type="text" id="' + data.listId + 
                    '" placeholder="New Task"></input></td><td><input type="submit" name="addTask" value="Add"></input></form></td></tr>'; 

    p.append(table);
    line.append(p);
    container.append(line);
    container.scrollTop = container.scrollTopMax;
  });
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}
