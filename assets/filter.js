let buttonsCountry = [
  document.getElementById("Belgique"),
  document.getElementById("France"),
  document.getElementById("Irlande"),
  document.getElementById("Italie"),
  document.getElementById("all"),
];

let cardsCountry = [
  document.getElementsByClassName("journey-card-Belgique"),
  document.getElementsByClassName("journey-card-France"),
  document.getElementsByClassName("journey-card-Irlande"),
  document.getElementsByClassName("journey-card-Italie"),
];

for (let btnIndex = 0; btnIndex < buttonsCountry.length; btnIndex++) {
  const button = buttonsCountry[btnIndex];
  button.addEventListener("click", () => {
    for (
      let countryIndex = 0;
      countryIndex < cardsCountry.length;
      countryIndex++
    ) {
      for (
        let journeyIndex = 0;
        journeyIndex < cardsCountry[countryIndex].length;
        journeyIndex++
      ) {
        const card = cardsCountry[countryIndex][journeyIndex];
        console.log(card);
        card.classList.remove("d-none");
        if (
          btnIndex != buttonsCountry.length - 1 &&
          card.classList[0] != cardsCountry[btnIndex][0].classList[0]
        ) {
          card.classList.add("d-none");
        }
      }
    }
  });
}

let buttonsDifficulty = [
  document.getElementById("easy"),
  document.getElementById("middle"),
  document.getElementById("difficult"),
  document.getElementById("expert"),
  document.getElementById("all-difficulties"),
];

let cardsDifficulty = [
  document.getElementsByClassName("facile"),
  document.getElementsByClassName("moyen"),
  document.getElementsByClassName("difficile"),
  document.getElementsByClassName("expert"),
];

for (let btnIndex = 0; btnIndex < buttonsDifficulty.length; btnIndex++) {
  const button = buttonsDifficulty[btnIndex];
  button.addEventListener("click", () => {
    for (
      let difficultyIndex = 0;
      difficultyIndex < cardsDifficulty.length;
      difficultyIndex++
    ) {
      for (
        let journeyIndex = 0;
        journeyIndex < cardsDifficulty[difficultyIndex].length;
        journeyIndex++
      ) {
        const card = cardsDifficulty[difficultyIndex][journeyIndex];
        console.log(card);
        card.classList.remove("d-none");
        if (
          btnIndex != buttonsDifficulty.length - 1 &&
          card.classList[1] != cardsDifficulty[btnIndex][0].classList[1]
        ) {
          card.classList.add("d-none");
        }
      }
    }
  });
}
