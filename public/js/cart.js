document.addEventListener('DOMContentLoaded', () => {
    const quantityInputs = document.querySelectorAll('.quantity-input');
    const deleteButtons = document.querySelectorAll('.delete-button');
    const backToShoppingButton = document.getElementById('back-to-shopping');

    if (backToShoppingButton) {
        backToShoppingButton.addEventListener('click', () => {
            window.location.href = '/';
        });
    }

    // Обробка зміни кількості
    quantityInputs.forEach(input => {
        input.addEventListener('change', (e) => {
            const cartId = e.target.dataset.cartId;
            const newQuantity = e.target.value;

            // Валідація кількості
            if (newQuantity < 1) {
                e.target.value = 1;
                return;
            }

            // Надсилання ajax для оновлення
            fetch(`/cart/${cartId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ quantity: newQuantity })
            })
            .then(response => {
                if (!response.ok) throw new Error('Failed to update cart');
                return response.json();
            })
            .then(data => {
                console.log('Cart updated:', data);
                // Оновлення ціни товару після зміни кількості
                const priceElement = e.target.closest('.cart-item').querySelector('p');
                const newPrice = data.newPrice;
                priceElement.textContent = `Price: $${newPrice}`;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });

    // Обробка видалення товару
    deleteButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const cartId = e.target.dataset.cartId;

            // Надсилання ajax для видалення
            fetch(`/cart/${cartId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Failed to delete item');
                return response.json();
            })
            .then(data => {
                document.querySelector(`.cart-item[data-cart-id="${cartId}"]`).remove();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
