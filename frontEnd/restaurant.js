let content = document.querySelector(".content");
let sendBtn = document.querySelector("#envoie");
let name = document.querySelector("#name");
let city = document.querySelector("#city");
let adress = document.querySelector("#adress");

function templateRestaurant(restaurant) {
  let templateRestaurant = `<div>
  <hr>
    <p>Nom du restaurant : <h3>${restaurant.name}</h3></p>
    <p>adresse du restaurant : <h3>${restaurant.adress}</h3></p>
    <p>ville du restaurant : <h3>${restaurant.city}</h3></p>
    <button class="btn btn-danger deleteBtn" id="${restaurant.id}">Supprimer</button>
    <hr>
</div>`;
  return templateRestaurant;
}

function displayAllRestaurants() {
  content.innerHTML = "";
  let url = "http://localhost/examen2/?type=restaurant&action=index";
  fetch(url)
    .then((reponse) => reponse.json())
    .then((restaurants) => {
      restaurants.forEach((restaurant) => {
        content.innerHTML += templateRestaurant(restaurant);
      });

      let btnSuppr = document.querySelectorAll(".deleteBtn");
      btnSuppr.forEach((bouton) => {
        bouton.addEventListener("click", () => {
          deleteRestaurant(bouton.id);
        });
      });
    });
}

sendBtn.addEventListener("click", () => {
  createRestaurant(name.value, adress.value, city.value);
});

function createRestaurant(nom, adresse, ville) {
  let url = "http://localhost/examen2/?type=restaurant&action=new";
  let bodyRequete = {
    name: nom,
    adress: adresse,
    city: ville,
  };
  let requete = {
    method: "POST",
    header: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(bodyRequete),
  };

  fetch(url, requete)
    .then((reponse) => reponse.json())
    .then((retour) => {
      console.log(retour);
      displayAllRestaurants();
      name.value = "";
      city.value = "";
      adress.value = "";
    });
}

function deleteRestaurant(idBtn) {
  let url = "http://localhost/examen2/?type=restaurant&action=suppr";
  let bodyRequete = {
    id: idBtn,
  };
  let requete = {
    method: "DELETE",
    header: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(bodyRequete),
  };

  fetch(url, requete)
    .then((reponse) => reponse.json())
    .then((retour) => {
      console.log(retour);
      displayAllRestaurants();
    });
}

displayAllRestaurants();
