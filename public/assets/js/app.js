let btn = document.getElementById("create-article-btn");
let closeBtn = document.getElementById('close-btn');
let form = document.querySelector(".create-article");
let comment = document.querySelector(".home-info");
let article = document.querySelector(".article-container");

let removeLinks = document.querySelectorAll('.remove');

// Menu Burger

let burgerBody = document.querySelector(".burger-body");
let openBurgerIcon = document.getElementById('burger-icon');
let closeBurgerIcon = document.getElementById("close-burger-icon");

openBurgerIcon.addEventListener('click', function () {
    burgerBody.style.display = "block";
    openBurgerIcon.style.display = "none";
})

closeBurgerIcon.addEventListener('click', function () {
    burgerBody.style.display = "none";
    openBurgerIcon.style.display = "block";
})




closeBurgerIcon.addEventListener('click', function () {
    burgerBody.style.display = "none";
    openBurgerIcon.style.display = "block";
})


// Parcourir les liens de suppression et ajouter un gestionnaire d'événements
removeLinks.forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien

        var url = this.getAttribute('href');

        // Effectuer la requête AJAX pour supprimer l'article
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // La suppression a réussi, recharger la page
                window.location.reload();
            }
        };
        xhr.send();
    });
});


// Display the form when on-click to create an Article

btn.addEventListener("click", function () {
    form.style.display = "flex";

    if (form.style.display = "flex") {
        comment.style.display = "none";
        article.style.display = "none";

    } else {
        comment.style.display = "flex";
        article.style.display = "flex";
    }
})

closeBtn.addEventListener("click", function () {
    form.style.display = "none";
})





