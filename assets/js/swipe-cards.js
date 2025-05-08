const swiper = document.querySelector('#swiper');
const like = document.querySelector('#like');
const dislike = document.querySelector('#dislike');

const urls = [
    'https://picsum.photos/id/1/1000/1000',
    'https://picsum.photos/id/2/1000/1000',
    'https://picsum.photos/id/3/1000/1000',
    'https://picsum.photos/id/4/1000/1000',
    'https://picsum.photos/id/5/1000/1000',
];

const questions = [
    'Do you like natural landscape?',
    'Would you try the local cuisine?',
    'Do you like shopping?',
    'Are you ready for an adventure?',
    'Are you interested in Chinese traditional instruments?',
];

let cardCount = 0;

function appendNewCard() {
    const cardElement = document.createElement('div');
    cardElement.classList.add('card');
    const img = document.createElement('img');
    img.src = urls[cardCount % 5];
    img.alt = '';
    img.draggable = false;
    cardElement.append(img);
    const questionDiv = document.createElement('div');
    questionDiv.classList.add('question');
    questionDiv.textContent = questions[cardCount % 5];
    cardElement.append(questionDiv);
    cardElement.style.setProperty('--i', 0);

    const card = new Card({
        imageUrl: urls[cardCount % 5],
        question: questions[cardCount % 5],
        onDismiss: () => {
            appendNewCard();
            updateCardIndices();
        },
        onLike: () => {
            like.style.animationPlayState = 'running';
            like.classList.toggle('trigger');
        },
        onDislike: () => {
            dislike.style.animationPlayState = 'running';
            dislike.classList.toggle('trigger');
        }
    });

    swiper.append(card.element);
    cardCount++;

    updateCardIndices();
}

function updateCardIndices() {
    const cards = swiper.querySelectorAll('.card:not(.dismissing)');
    cards.forEach((card, index) => {
        card.style.setProperty('--i', index);
        card.style.zIndex = 10 - index;
        card.style.pointerEvents = index === 0 ? 'auto' : 'none';
    });
}

// Initialize existing cards
const existingCards = swiper.querySelectorAll('.card');
existingCards.forEach((cardElement) => {
    const img = cardElement.querySelector('img');
    const questionDiv = cardElement.querySelector('.question');
    const card = new Card({
        imageUrl: img.src,
        question: questionDiv ? questionDiv.textContent : questions[0], // Fallback to first question if missing
        onDismiss: () => {
            appendNewCard();
            updateCardIndices();
        },
        onLike: () => {
            like.style.animationPlayState = 'running';
            like.classList.toggle('trigger');
        },
        onDislike: () => {
            dislike.style.animationPlayState = 'running';
            dislike.classList.toggle('trigger');
        }
    });
    cardElement.parentNode.replaceChild(card.element, cardElement);
});

// Ensure initial stacking
updateCardIndices();