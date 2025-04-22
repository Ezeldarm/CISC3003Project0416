//DOM
const swiper = document.querySelector('#swiper');
const like = document.querySelector('#like');
const dislike = document.querySelector('#dislike');

//constants
const cardsData = [
    {
        question: "你想体验中国传统文化吗？",
        imageUrl: "https://picsum.photos/id/1/1000/1000" // 示例图片
    },
    {
        question: "你想尝试吃中餐吗？",
        imageUrl: "https://picsum.photos/id/2/1000/1000"
    },
    {
        question: "你想吃欧洲菜吗？",
        imageUrl: "https://picsum.photos/id/3/1000/1000"
    },
    {
        question: "你喜欢大城市还是小城镇？",
        imageUrl: "https://picsum.photos/id/4/1000/1000"
    },
    {
        question: "你想参观历史古迹吗？",
        imageUrl: "https://picsum.photos/id/5/1000/1000"
    },
    {
        question: "你对自然风光感兴趣吗？",
        imageUrl: "https://picsum.photos/id/6/1000/1000"
    },
    {
        question: "你喜欢购物吗？",
        imageUrl: "https://picsum.photos/id/7/1000/1000"
    },
    {
        question: "你想体验夜生活吗？",
        imageUrl: "https://picsum.photos/id/8/1000/1000"
    },
    {
        question: "你喜欢辣的食物吗？",
        imageUrl: "https://picsum.photos/id/9/1000/1000"
    },
    {
        question: "你想尝试街头小吃吗？",
        imageUrl: "https://picsum.photos/id/10/1000/1000"
    },
    // 继续添加更多问题...
    {
        question: "你喜欢喝茶吗？",
        imageUrl: "https://picsum.photos/id/11/1000/1000"
    },
    {
        question: "你想参观现代建筑吗？",
        imageUrl: "https://picsum.photos/id/12/1000/1000"
    },
    {
        question: "你喜欢看表演吗？",
        imageUrl: "https://picsum.photos/id/13/1000/1000"
    },
    {
        question: "你想体验温泉吗？",
        imageUrl: "https://picsum.photos/id/14/1000/1000"
    },
    {
        question: "你喜欢徒步旅行吗？",
        imageUrl: "https://picsum.photos/id/15/1000/1000"
    },
    {
        question: "你想参观博物馆吗？",
        imageUrl: "https://picsum.photos/id/16/1000/1000"
    },
    {
        question: "你喜欢摄影吗？",
        imageUrl: "https://picsum.photos/id/17/1000/1000"
    },
    {
        question: "你想体验当地节日吗？",
        imageUrl: "https://picsum.photos/id/18/1000/1000"
    },
    {
        question: "你喜欢水上活动吗？",
        imageUrl: "https://picsum.photos/id/19/1000/1000"
    },
    {
        question: "你想尝试中国茶道吗？",
        imageUrl: "https://picsum.photos/id/20/1000/1000"
    }
];

//variables
let cardCount = 0;

//functions
function appendNewCard() {
    if (cardCount >= cardsData.length) {
        console.log("all cards are shown");
        return;
    }
    const currentCard = cardsData[cardCount];
    const card = new Card({
        imageUrl: currentCard.imageUrl,
        questionText: currentCard.question,
        onDismiss: () => {
            setTimeout(appendNewCard, 100); // 延迟添加新卡片，确保移除动画完成
        },
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
    swiper.appendChild(card.element);
    cardCount++;
    updateCardStyles();
}

function updateCardStyles() {
    const cards = Array.from(swiper.querySelectorAll('.card:not(.dismissing)'));
    cards.forEach((card, index) => {
        card.style.setProperty('--i', index);
        card.style.pointerEvents = index === 0 ? 'auto' : 'none'; // 仅顶部卡片可交互
        card.style.zIndex = 10 - index; // 确保顶部卡片在最上层
    });
}

// 初始化加载前20张卡片
for (let i = 0; i < Math.min(20, cardsData.length); i++) {
    appendNewCard();
}