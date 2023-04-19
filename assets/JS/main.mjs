document.addEventListener('DOMContentLoaded', function() {
   
    let deroulantEnchere = document.querySelector("#enchereDeroulant");
    let elmMenu = document.querySelector("#enchere");
    let deroulantCollection = document.querySelector("#collectionDeroulant");
    let elmMenuCollection = document.querySelector("#collection");
    elmMenu.addEventListener("click", () => {
     
        deroulantEnchere.classList.toggle("closed");
      
    });
    
    elmMenuCollection.addEventListener("click", () => {
      
        deroulantCollection.classList.toggle("closed");
      
    });

   
});