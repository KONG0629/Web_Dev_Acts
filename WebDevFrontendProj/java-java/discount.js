<!--3rd js-->
<script>
    let openShopping = document.querySelector('.shopping');
    let closeShopping = document.querySelector('.closeShopping');
    let list = document.querySelector('.list');
    let listCard = document.querySelector('.listCard');
    let body = document.querySelector('body');
    let total = document.querySelector('.total');
    let quantity = document.querySelector('.quantity');
    
    openShopping.addEventListener('click', () => {
        body.classList.add('active');
    });
    closeShopping.addEventListener('click', () => {
        body.classList.remove('active');
    });
    
    function formatPrice(priceInCents) {
        return (priceInCents / 100).toFixed(2);
    }
    
    let products = [
    //face
    { id: 1, name: 'Byte Beauty Long Lasting Cheek Blush', image: 'f1.png', price: 150000 },
    { id: 2, name: 'Byte Beauty Love Cushion Velvet Blush', image: 'f11.webp', price: 93300 },
    { id: 3, name: 'Byte Beauty Waterproof Liquid Concealer', image: 'f22.png', price: 96900 },
    { id: 4, name: 'Byte Beauty 3 Colors Waterproof Shaping Contour Stick', image: 'f31.png', price: 12300 },
    { id: 5, name: 'Byte Beauty Glow Dewy Liquid Contour', image: 'f40.png', price: 80000 },
    { id: 6, name: 'Byte Beauty Oil Control Long Lasting Liquid Foundation', image: 'f51.png', price: 74000 },
    { id: 7, name: 'Byte Beauty Long Lasting Waterproof Highlighter', image: 'f61.jpg', price: 64900 },
    { id: 8, name: 'Byte Beauty Silky Blend Liquid Highlighter', image: 'f70.png', price: 55000 },
    { id: 9, name: 'Byte Beauty Mattifying Oil Control Loose Powder', image: 'f81.jpeg', price: 72000 },
    { id: 10, name: 'Byte Beauty Face Primer Oil Control Smooth Skin', image: 'f91.webp', price: 69000 },
    //eyes
    { id: 11, name: 'Byte Beauty Waterproof Mascara with Eyeliner', image: 'e61.png', price: 78000 },
    { id: 12, name: 'Byte Beauty Waterproof Eyeliner Gel Pencil', image: 'e80.png', price: 50000 },
    { id: 13, name: 'Byte Beauty 8 Colors High Pigment Eyeshadow Palette', image: 'e1.jpg', price: 69900 },
    { id: 14, name: 'Byte Beauty Bomb Posse Eyeshadow Palette', image: 'e2.jpg', price: 67000 },
    { id: 15, name: 'Byte Beauty High Pigment Eyeshadow Palette', image: 'e3.jpg', price: 72900 },
    { id: 16, name: 'Byte Beauty Matte Milk Eyeshadow Palette', image: 'e4.jpg', price: 80900 },
    { id: 17, name: 'Byte Beauty Waterproof Long Lasting Mascara and Eyeliner with Free Eyelash Curler', image: 'e10.png', price: 93900 },
    { id: 18, name: 'Byte Beauty Waterproof Long Lasting Mascara with Free Eyelash Curler', image: 'e91.png', price: 92900 },
    { id: 19, name: 'Byte Beauty Neutral Eyeshadow Palette', image: 'e5.jpg', price: 125000 },
    { id: 20, name: 'Byte Beauty Volumizing Waterproof Mascara with Eyeliner', image: 'e71.png', price: 51900 },
    //lips
    { id: 21, name: 'Byte Beauty Multi Use Lip and Cheek Tint' , image: 'l41.jpg', price: 42900 },
    { id: 22, name: 'Byte Beauty Natural Matte Waterproof Lipstick' , image: 'l31.png', price: 42900 },
    { id: 23, name: 'Byte Beauty Moist Color Changing Lipbalm' , image: 'l21.jpg', price: 39900 },
    { id: 24, name: 'Byte Beauty Tinted Moisturizing Lip Oil' , image: 'l11.png', price: 69900 },
    { id: 25, name: 'Byte Beauty Lip Liners Nude Velvet Mousse' , image: 'l0.png', price: 96900 },
    { id: 26, name: 'Byte Beauty Contour Stick Silky Texture' , image: 'lips1.jpeg', price: 79900 },
    { id: 27, name: 'Byte Beauty Misty Kiss Long Lasting Lipstick' , image: 'lips1_top.jpg', price: 69900 },
    { id: 28, name: 'Byte Beauty Moist Color Changing Lip Balm' , image: 'lips3.jpeg', price: 62900 },
    { id: 29, name: 'Byte Beauty Nude Velvet Mousse Lip Liner' , image: 'lips4.jpeg', price: 78900 },
    { id: 30, name: 'Byte Beauty Serum Tinted Lip Balm' , image: 'lips5.jpeg', price: 89900 },
    //skincare
    { id: 31, name: 'Byte Beauty Lightweight and Non Sticky Sunscreen with SPF 50' , image: 's1.png', price: 125000 },
    { id: 32, name: 'Byte Beauty Whitening Repair Facial Cleanser' , image: 's2.png', price: 89900 },
    { id: 33, name: 'Byte Beauty Whitening Repair Facial Moisturizer' , image: 's3.png', price: 59900 },
    { id: 34, name: 'Byte Beauty Whitening Repair Ultra Light Glow Serum' , image: 's4.png', price: 99900 },
    { id: 35, name: 'Byte Beauty Whitening Repair Ultra Light Glow Toner' , image: 's5.png', price: 100000 },
    { id: 36, name: 'Byte Beauty Anti Acne Facial Cleanser' , image: 's6.png', price: 99999 },
    { id: 37, name: 'Byte Beauty Hydrating Toner' , image: 's7.png', price: 70000 },
    { id: 38, name: 'Byte Beauty Nourishing Facial Moisturizer' , image: 's8.png', price: 60000 },
    { id: 39, name: 'Byte Beauty Pore&Acne Vitamin C Skincare' , image: 'skincare6.jpeg', price: 56780 },
    { id: 40, name: 'Byte Beauty 3pcs Set with Toner, Moisturizer, and Facial Cleanser' , image: 'skincare0.jpeg', price: 125000 }
];
    
    let listCards = [];
    
    function initApp() {
        products.forEach((value, key) => {
            let newDiv = document.createElement('div');
            newDiv.classList.add('item');
            newDiv.innerHTML = `
                <img src="image/${value.image}" alt="${value.name}">
                <div class="title">${value.name}</div>
                <div class="price">${formatPrice(value.price)}</div>
                <button onclick="addToCard(${key})">Add To Cart</button>`;
            list.appendChild(newDiv);
        });
    }
    initApp();
    
    function addToCard(key) {
        if (listCards[key] == null) {
            listCards[key] = { ...products[key], quantity: 1 };
        } else {
            listCards[key].quantity += 1;
        }
        reloadCard();
    }
    
    function reloadCard() {
        listCard.innerHTML = '';
        let count = 0;
        let totalPrice = 0;
    
        listCards.forEach((value, key) => {
            if (value != null) {
                totalPrice += value.price * value.quantity;
                count += value.quantity;
                let newDiv = document.createElement('li');
                newDiv.innerHTML = `
                    <div><img src="image/${value.image}" alt="${value.name}"></div>
                    <div>${value.name}</div>
                    <div>${formatPrice(value.price * value.quantity)}</div>
                    <div>
                        <button onclick="changeQuantity(${key}, ${value.quantity - 1})">-</button>
                        <div class="count">${value.quantity}</div>
                        <button onclick="changeQuantity(${key}, ${value.quantity + 1})">+</button>
                    </div>`;
                listCard.appendChild(newDiv);
            }
        });
        total.innerText = `${formatPrice(totalPrice)}`;
        quantity.innerText = count;
    }
    
    function changeQuantity(key, quantity) {
        if (quantity === 0) {
            delete listCards[key];
        } else {
            listCards[key].quantity = quantity;
        }
        reloadCard();
    }
    
    function downloadReceipt() {
        let receiptContent = "Receipt\n";
        receiptContent += "Date: " + new Date().toLocaleString() + "\n\n";
        receiptContent += "Items:\n";
    
        let totalPrice = 0;
        listCards.forEach((value) => {
            if (value != null) {
                receiptContent += `${value.name} - ${formatPrice(value.price * value.quantity)} x ${value.quantity}\n`;
                totalPrice += value.price * value.quantity;
            }
        });
    
        receiptContent += `\nTotal Price: ${formatPrice(totalPrice)}\n`;
    
        const blob = new Blob([receiptContent], { type: 'text/plain' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'receipt.txt';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(link.href);
    }
    </script>
    
    
<!--3rd js-->



<script>
    var promoCode;
var promoPrice;
var promoPercentage;
var fadeTime = 300;
var exchangeRate = 70; // conversion rate from GBP to PHP

document.querySelector('.promo-code-cta').addEventListener('click', function () {
  promoCode = document.getElementById('promo-code').value.toUpperCase();

  var validPromoCodes = {
    'VOUCHER20': 20,
    'YURR': 5,
    'EMG10': 10,
    'JGK20': 20,
    'AP5': 5,
    'ICG20': 20
  };

  if (validPromoCodes[promoCode]) {
    promoPercentage = validPromoCodes[promoCode];
    alert("Promo code applied: " + promoPercentage + "% off");
    document.querySelector('.summary-promo').style.display = 'block';
    document.querySelector('.promo-value').textContent = promoPercentage + "%";
  } else {
    alert("Invalid Promo Code");
    promoPercentage = 0;
    document.querySelector('.summary-promo').style.display = 'none';
  }

  recalculateCart(true);
});

function recalculateCart(onlyTotal) {
  var subtotal = 7000; // subtotal in PHP for demonstration
  var total = subtotal;

  if (promoPercentage) {
    promoPrice = (subtotal * promoPercentage) / 100;
    total -= promoPrice;
  }

  if (onlyTotal) {
    console.log('Total after discount: ₱' + total.toFixed(2));
  }
}

function showVoucherPopup() {
  document.getElementById('voucher-popup').classList.add('show-popup');
}

function closeVoucherPopup() {
  document.getElementById('voucher-popup').classList.remove('show-popup');
}

setInterval(showVoucherPopup, 10000);

  </script>