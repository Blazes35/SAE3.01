function toggleFields() {
  // Initialisez tous les champs à false (masqué par défaut)
  const fields = {
    "desc-field": false,
    "price-field": false,
    "promo-field": false,
    "qt-field": false,
    "color-field": false,
    "capacite-field": false,
    "minRole-field": false,
    "minGrade-field": false,
    "lieu-field": false,
    "date-field": false,
    "contenuActu-field": false,
    "dateDebut-field": false,
    "dateFin-field": false,
    "conditionCode-field": false,
    "picture-field": false,
  };

  // Obtenez le type d'article sélectionné
  const articleType = document.getElementById("article-select").value;

  // Configurez les champs en fonction du type d'article
  switch (articleType) {
    case "vetement":
      fields["desc-field"] = true;
      fields["picture-field"] = true; // Montrer l'image
      fields["color-field"] = true;
      fields["price-field"] = true;
      fields["qt-field"] = true;
      break;
    case "evenement":
      fields["desc-field"] = true;
      fields["picture-field"] = true; // Montrer l'image
      fields["capacite-field"] = true;
      fields["minRole-field"] = true;
      fields["minGrade-field"] = true;
      fields["price-field"] = true;
      fields["lieu-field"] = true;
      fields["date-field"] = true;
      break;
    case "actu":
      fields["desc-field"] = false; // Masquer le champ description
      fields["picture-field"] = true; // Montrer l'image
      fields["contenuActu-field"] = true;
      fields["date-field"] = true;
      break;
    case "code":
      fields["promo-field"] = true;
      fields["dateDebut-field"] = true;
      fields["dateFin-field"] = true;
      fields["conditionCode-field"] = true;
      break;
    case "produit":
      fields["desc-field"] = true;
      fields["picture-field"] = true;
      fields["price-field"] = true;
      fields["qt-field"] = true;
      fields["promo-field"] = true;
      fields["conditionCode-field"] = true;
      break;
    case "galerie":
      fields["picture-field"] = true;
    default:
      break;
  }

  // Appliquez les propriétés "hidden" à chaque champ
  for (const id in fields) {
    document.getElementById(id).hidden = !fields[id];
  }
}
