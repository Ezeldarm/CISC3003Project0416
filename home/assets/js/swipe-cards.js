//DOM
const swiper = document.querySelector('#swiper');
const like = document.querySelector('#like');
const dislike = document.querySelector('#dislike');

//constants
const urls = [
    'https://picsum.photos/id/1/1000/1000',
    'https://picsum.photos/id/2/1000/1000',
    'https://picsum.photos/id/3/1000/1000',
    'https://picsum.photos/id/4/1000/1000',
    'https://picsum.photos/id/5/1000/1000',
];

//variables
let cardCount = 0;

//functions
function appendNewCard() {
    const card = new Card({
        imageUrl: urls[cardCount % 5],
        onDismiss: appendNewCard,
        onLike: () => {
            like.style.animationPlayState = 'running';
            // always trigger animation when toggling class
            like.classList.toggle('trigger');
        },
        onDislike: () => {
            dislike.style.animationPlayState = 'running';
            // always trigger animation when toggling class
            dislike.classList.toggle('trigger');
        }
    });
    //card.element.style.setProperty('--i', cardCount % 5);
    swiper.append(card.element);
    cardCount++;

    const cards = swiper.querySelectorAll('.card:not(.dismissing');
    cards.forEach((card, index) => {
        card.style.setProperty('--i', index);
    });
}

// first 5 cards
for (let i = 0; i < 5; i++) {
    appendNewCard();
}