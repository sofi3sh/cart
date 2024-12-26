<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<h1> {{ __('product.product_name') }}</h1>
<div class="products-container">
    @foreach ($products as $product)
        <div class="product-card">
            <h2>{{ $product->name }}</h2>
            <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}">
            <p>{{ $product->description }}</p>
            <p>Price: ${{ $product->price }}</p>

            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? 1 }}">
                <button type="submit">{{__('product.add_to_cart')}}</button>
            </form>
        </div>
    @endforeach
</div>
@if(session('success'))
    <div class="alert alert-success" >
        <p class="success">{{ session('success') }}</p>
        <a class="link" href="{{ route('cart.index') }}">
            {{__('product.go_to_cart')}}
        </a>
    </div>
@endif

<div>
    <div class="container">
        <h1>Опис функціоналу кошика</h1>

        <section>
            <h2>4. Додати резюме</h2>
            <ul>
                <li>Код зроблений простий та легкий, що забезпечує швидку роботу сторінки кошика.</li>
                <li>Зміна кількості товарів чи видалення відбувається через AJAX.</li>
                <li>Потрібно додати повідомлення про наявність товару, оновлення ціни та обробку помилок, якщо товар не можна додати.</li>
                <li>Також потрібно реалізувати можливість додавання всіх промокодів акційних кодів будь-яких знижок, інформації про доставку та оплату та більше інформаційних блоків для користувача</li>
                <li> - Можна реалізувати роздільну корзину це актуально для дропшиперів та маркетплейсів коли у нас є декілька постачальників відповідно доставки цих товарів будуть відправлятися з різних складів і ціна на них може по доставці відрізнятися тому для користувача буде зручно бачити роздільну корзину окремі замовлення окремі знижки на замовлення і вибрати що йому підходить</li>
            </ul>
        </section>
        <section>
            <h2>Опис функціоналу</h2>
            <p> - Реалізація функціоналу, де до кожного товару в кошику користувач може додати додатковий товар </p>


            <p>   Для цього функціоналу  потрібно додати можливість зв’язати основний товар із додатковими. </p>

        <section>
            <h2>База даних</h2>
            <p>Додайте таблицю для зберігання зв’язків між основними та додатковими товарами:</p>
            <ul>
                <li><strong>product_id</strong> — ID основного товару.</li>
                <li><strong>addon_product_id</strong> — ID додаткового товару.</li>
            </ul>
            <p>Модель кошика має враховувати можливість зберігання додаткових товарів.</p>
        </section>

        <section>
            <h2>На рівні адміністратора</h2>
            <p>У адмін-панелі додається можливість задавати "доповнення" для кожного товару (наприклад, через чекбокси).</p>
            <p>Використовується зв’язок "один до багатьох" між основним і додатковими товарами.</p>
        </section>

        <section>
            <h2>Відображення в кошику</h2>
            <p>Після додавання товару до кошика користувач бачить блок із доступними доповненнями:</p>
            <ul>
                <li>Назва товару.</li>
                <li>Зображення.</li>
                <li>Ціна.</li>
                <li>Кнопка "Додати".</li>
            </ul>
        </section>

        <section>
            <h2>Логіка додавання</h2>
            <p>Додаткові товари додаються до кошика як окремий запис, прив’язаний до основного товару. Основний і додатковий товари мають різні ролі.</p>
        </section>

        <section>
            <h2>Оновлення ціни</h2>
            <p>Загальна вартість кошика враховує:</p>
            <ul>
                <li>Ціну основного товару.</li>
                <li>Ціну всіх вибраних додаткових товарів.</li>
            </ul>
        </section>

        <section>
            <h2>Серверна логіка</h2>
            <p>При додаванні додаткового товару надсилається AJAX-запит на сервер. Сервер перевіряє, чи товар доступний, і додає його до кошика.</p>
        </section>

        <section>
            <h2>Оформлення замовлення</h2>
            <p>Основні та додаткові товари відображаються разом у базі даних як пов’язаний набір.</p>
        </section>

        <section>
            <h2>UX/Дизайн</h2>
            <p>Користувач повинен розуміти, що додаткові товари не обов’язкові. Використовуйте кнопки або чекбокси для вибору.</p>
        </section>

        <section>
            <h2>Приклад сценарію</h2>
            <p><strong>Товар у кошику:</strong> Основний товар: "Піца Маргарита". Додаткові товари: "Сирний соус", "Напій Кола".</p>
            <p><strong>Кошик:</strong> Загальна вартість: $12.</p>
        </section>

        <section>
            <h2>Додаткові можливості</h2>
            <ul>
                <li>Автоматичні рекомендації на основі основного товару.</li>
                <li>Промоакції: знижки на додаткові товари.</li>
            </ul>
        </section>

        <p><strong>Реалізація цього функціоналу покращить UX і дозволить збільшити середній чек покупки.</strong></p>
    </div>
</div>


<script src="{{ asset('js/product.js') }}"></script>
</body>
</html>