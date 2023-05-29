
function comments(event) {
  event.preventDefault();
  const verseText = event.target.textContent;
  const commentInput = document.getElementById("comment");
  commentInput.value = verseText;
}



const info = document.querySelector("#bible-view");
info.innerHTML= 'clicca un verso per commentarlo';

function postaCommento(event){
  event.preventDefault();
  

  const commentInput = document.getElementById("comment");
  const comment = commentInput.value;
  
  
  const commentContainer = document.createElement("div");
  const post = document.createElement("p");
  post.innerHTML = comment;
  commentContainer.appendChild(post);
  const library = document.querySelector("#posts");

  library.appendChild(commentContainer);

  // Resetta l'input del commento
  commentInput.value = "";

}


const submitButton = document.getElementById("submitComment");
submitButton.addEventListener("click", postaCommento)


function fetchPosts(){
    fetch("http://localhost/hw1/fetch_post.php").then(fetchResponse).then(fetchPostsJson);
}

function fetchResponse(response){
  if(!response.ok) {return null};
  console.log(json);
  return response.json();
}

function fetchPostsJson(json){
  console.log("fetching...");
  console.log(json);
}

