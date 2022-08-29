document.addEventListener('Document.Load',()=> {
  window.SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition ;
let p = document.createElement('p');
const paper =document.querySelector('paper');
paper.appendChild(p);
const recognition = new SpeechRecognition ();
recognition.innerResults = true;
recognition.addEventListener('result',e=> {
console.log(e.result);
const transcript = Array.form(e.result)
.map (result=>rresult[0])
.map (result=>rresult[0])
});
});