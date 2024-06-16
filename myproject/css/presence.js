function bonjour()
{
    let resultat = "";
   for(let i=1; i<= 14; i++) {
  const chekcboxElement =  document.getElementById('present'+i);
  console.log(chekcboxElement.checked);
  if(chekcboxElement.checked === true) {
    resultat = resultat + document.getElementById('matricule'+i).value + "#" ;
  }

console.log(resultat);
document.getElementById('liste').value = resultat;

   }
}


 