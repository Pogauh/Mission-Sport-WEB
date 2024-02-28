import {getProduits, deleteProduit, deleteProgramme, getProgrammes} from './api_produit.js ';

async function afficherProduit() {
    try {
        const produits = await getProduits();
        var lesProduits = produits["hydra:member"];
        console.log(produits);

        var container = document.getElementById('container');
        var elementsParLigne = 3;
        var elementsDansLaLigne = 0;
        var divLigne;  // Variable pour stocker la ligne actuelle
        for (let produit of lesProduits) {
            if (elementsDansLaLigne === 0) {
                // Créer une nouvelle ligne (flex container)
                divLigne = document.createElement("div");
                divLigne.classList.add("flex", "justify-around", "mt-5");
                container.appendChild(divLigne);
            }

            var divCard = document.createElement("div");
            divCard.classList.add("w-72", "mx-auto", "rounded-md");
            
            var img = document.createElement("img");
            img.src = "assets/" + produit.image;
            img.classList.add("w-30", "h-80", "object-cover", "rounded-md");

            var divDetail = document.createElement("div");
            divDetail.classList.add("p-4", "grey");

            var divFlex = document.createElement("div");
            divFlex.classList.add("flex", "flex-col", "items-center", "justify-between", "mb-4");

            var textCenter = document.createElement("div");
            textCenter.classList.add("text-center");

            var titre = document.createElement("h5");
            titre.innerText = produit.nom;
            titre.classList.add("text-xl", "font-semibold", "mb-2");

            var desc = document.createElement("p");
            desc.innerText = produit.description;
            desc.classList.add("text-gray-700", "mb-4");

            var prix = document.createElement("p");
            prix.innerText = "Prix : " + produit.prix+ " €";
            prix.classList.add("text-gray-700", "mb-4", "font-bold");

            var divButtons = document.createElement("div");
            divButtons.classList.add("flex", "items-center", "justify-between");

            var ajouterAuPanier = document.createElement("a");
            ajouterAuPanier.href = "#";
            ajouterAuPanier.innerText = "Ajouter au panier";
            ajouterAuPanier.classList.add("bg-black", "text-white", "py-2", "px-2", "rounded-md");

            var etoile = document.createElement("a");
            etoile.href = "#";
            etoile.classList.add("text-blue-500", "border", "border-blue-500", "py-2", "px-3", "rounded-full", "ml-6");

            var svgEtoile = document.createElement("svg");
            svgEtoile.setAttribute("xmlns", "http://www.w3.org/2000/svg");
            svgEtoile.setAttribute("width", "34");
            svgEtoile.setAttribute("height", "34");
            svgEtoile.setAttribute("fill", "gold");
            svgEtoile.setAttribute("class", "bi bi-star");
            svgEtoile.setAttribute("viewBox", "0 0 16 16");

            var pathEtoile = document.createElement("path");
            pathEtoile.setAttribute("d", "M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z");

            divLigne.appendChild(divCard);
            divCard.appendChild(img);
            divCard.appendChild(divDetail);
            divDetail.appendChild(divFlex);
            divFlex.appendChild(textCenter);
            textCenter.appendChild(titre);
            textCenter.appendChild(desc);
            textCenter.appendChild(prix);
            divFlex.appendChild(divButtons);
            divButtons.appendChild(ajouterAuPanier);
            divButtons.appendChild(etoile);
            etoile.appendChild(svgEtoile);
            svgEtoile.appendChild(pathEtoile);

            elementsDansLaLigne++;
            // Si nous avons atteint le nombre maximum d'éléments par ligne,
            // réinitialiser le compteur
            if (elementsDansLaLigne === elementsParLigne) {
                elementsDansLaLigne = 0;
            }
        }
    } catch (erreur) {
        console.log('erreur :', erreur);
    }
}


    //-------------------------------------------------------------------------------------------------

    function supprimerProduit(id) {
        deleteProduit(id)
            .then(data => {
                console.log('Produit supprimé avec succès:', data);
                // Vous pouvez également mettre à jour l'interface utilisateur ici, si nécessaire
            })
            .catch(error => {
                console.error('Erreur lors de la suppression du produit:', error);
            });
    }    

    //-------------------------------------------------------------------------------------------------
    function supprimerProgramme(id) {
        deleteProgramme(id)
            .then(data => {
                console.log('programme supprimé avec succès:', data);
                // Vous pouvez également mettre à jour l'interface utilisateur ici, si nécessaire
            })
            .catch(error => {
                console.error('Erreur lors de la suppression du produit:', error);
            });
    }

    //-------------------------------------------------------------------------------------------------------
    async function afficherProgramme() {
        try {
            const programmes = await getProgrammes();
            var lesProgrammes = programmes["hydra:member"];
            console.log(programmes);
    
            var container = document.getElementById('container');
            var elementsParLigne = 3;
            var elementsDansLaLigne = 0;
            var divLigne;  // Variable pour stocker la ligne actuelle
            for (let programme of lesProgrammes) {
                if (elementsDansLaLigne === 0) {
                    // Créer une nouvelle ligne (flex container)
                    divLigne = document.createElement("div");
                    divLigne.classList.add("flex", "justify-around", "mt-5");
                    container.appendChild(divLigne);
                }
    
                var divCard = document.createElement("div");
                divCard.classList.add("w-72", "mx-auto", "rounded-md");
                
                var img = document.createElement("img");
                img.src = "assets/" + programme.image;
                img.classList.add("w-30", "h-80", "object-cover", "rounded-md","transition","hover:scale-110");
    
                var divDetail = document.createElement("div");
                divDetail.classList.add("p-4", "grey");
    
                var divFlex = document.createElement("div");
                divFlex.classList.add("flex", "flex-col", "items-center", "justify-between", "mb-4");
    
                var textCenter = document.createElement("div");
                textCenter.classList.add("text-center");
    
                var titre = document.createElement("h5");
                titre.innerText = programme.nom;
                titre.classList.add("text-xl", "font-semibold", "mb-2");
    
                var desc = document.createElement("p");
                desc.innerText = programme.description;
                desc.classList.add("text-gray-700", "mb-4");
    
                var prix = document.createElement("p");
                prix.innerText = "Prix : " + programme.prix+ " €";
                prix.classList.add("text-gray-700", "mb-4", "font-bold");
    
                var divButtons = document.createElement("div");
                divButtons.classList.add("flex", "items-center", "justify-between");
    
                var ajouterAuPanier = document.createElement("a");
                ajouterAuPanier.href = "#";
                ajouterAuPanier.innerText = "Ajouter au panier";
                ajouterAuPanier.classList.add("bg-black", "text-white", "py-2", "px-2", "rounded-md","transition","hover:scale-110");
    
                var etoile = document.createElement("a");
                etoile.href = "#";
                etoile.classList.add("text-blue-500", "border", "border-blue-500", "py-2", "px-3", "rounded-full", "ml-6");
    
                var svgEtoile = document.createElement("svg");
                svgEtoile.setAttribute("xmlns", "http://www.w3.org/2000/svg");
                svgEtoile.setAttribute("width", "34");
                svgEtoile.setAttribute("height", "34");
                svgEtoile.setAttribute("fill", "gold");
                svgEtoile.setAttribute("class", "bi bi-star");
                svgEtoile.setAttribute("viewBox", "0 0 16 16");
    
                var pathEtoile = document.createElement("path");
                pathEtoile.setAttribute("d", "M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z");
    
                divLigne.appendChild(divCard);
                divCard.appendChild(img);
                divCard.appendChild(divDetail);
                divDetail.appendChild(divFlex);
                divFlex.appendChild(textCenter);
                textCenter.appendChild(titre);
                textCenter.appendChild(desc);
                textCenter.appendChild(prix);
                divFlex.appendChild(divButtons);
                divButtons.appendChild(ajouterAuPanier);
                divButtons.appendChild(etoile);
                etoile.appendChild(svgEtoile);
                svgEtoile.appendChild(pathEtoile);
    
                elementsDansLaLigne++;
                // Si nous avons atteint le nombre maximum d'éléments par ligne,
                // réinitialiser le compteur
                if (elementsDansLaLigne === elementsParLigne) {
                    elementsDansLaLigne = 0;
                }
            }
        } catch (erreur) {
            console.log('erreur :', erreur);
        }
    }


    

    

    document.addEventListener('DOMContentLoaded', function() {
        if (window.location.href.endsWith("/situation1/produit")) {
            afficherProduit();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        if (window.location.href.endsWith("/situation1/programme")) {
            afficherProgramme();
        }
    });
