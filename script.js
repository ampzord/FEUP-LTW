'use strict';

// let listName = null;
// let teamName = null;
// Id of last message received
//let last_id = -1

let container = document.querySelector('.notesContainer');
let bt = document.getElementsByName('addButton')[0];

bt.addEventListener('submit', addNote);

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
  listName = document.querySelector('input[name=listName]').value;
  teamName = document.querySelector('input[name=teamName]').value;

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
   console.log(lines);
  lines.forEach(function(data){
    let line = document.createElement('div');
    // console.log(line['tasks']);
    //last_id = data.id;

    line.classList.add('notes');
    line.innerHTML =
      '<h2>' + data.listName + ' - ' + data.teamName + '</h2>';

    for(let i = 0; i < data.tasks.length; i++){
      line.innerHTML += '<p>' + data.tasks[i].field + '</p>'; 
    }

    container.append(line);
    container.scrollTop = container.scrollTopMax;
  });
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}
