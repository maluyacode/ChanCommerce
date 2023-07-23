let prices = document.querySelectorAll('tbody .price');

for (let i = 0; i < prices.length; i++) {
    let textContent = prices[i].textContent;
    console.log(textContent);
}
