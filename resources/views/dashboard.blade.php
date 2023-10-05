<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://kit.fontawesome.com/f38a62f9ed.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
</head>

<body>
    <header id="header">
        <div class="logo">
            <img src="https://static.vecteezy.com/system/resources/previews/010/160/674/original/coffee-icon-sign-symbol-design-free-png.png"
                id="header-img" alt="A coffee" />
            <div id="header-text">Dashboard</div>
        </div>
        <div class="user-greetings">
            <div> Hello {{ $user->username }}</div>
        </div>
        <nav id="nav-bar">
            <a href="#coffee-ingredients" class="nav-link">Orders</a>
            <a href="#coffee-ingredients" class="nav-link">Cart</a>
            <a href="#" class="nav-link"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        </nav>
    </header>

    <main>
        <h1 class="h1-header">Handmade, Fresh from the Farm</h1>
        <div class="pricing-list" id="pricing-list">

        </div>
    </main>


    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>


    <div class="container-fluid">
        <div class="row mb-3" id="productsContainer">
        </div>
    </div>

    <div id="modalContainer"></div>




</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.js"></script>

<script>
    let products = [{
            id: 1,
            name: "Espresso",
            description: "Originating in Italy, espresso is a beloved caffeine-rich drink with a strong flavor. Its signature texture results from it undergoing 9 to 10 bars of atmospheric pressure as it passes through ground robusta coffee beans.",
            price: 130.00
        },
        {
            id: 2,
            name: "Frappuccino",
            description: "As a Starbucks branded drink, Frappuccinos are a blended iced coffee. The widely recognized drink combines ice, flavored syrups, and other ingredients to form a sweet coffee drink. Many baristas top it off with whipped cream and syrup or spices.",
            price: 150.00
        },
        {
            id: 3,
            name: "Special Capuccino",
            description: "  You can make iced coffee in one of two ways—either brewing the coffee hot or cold. In either case, the final product involves a chilled coffee that's packed with ice. You can also make iced coffee by pouring hot coffee over ice.",
            price: 180.00
        }
    ]

    let loadProduct = (product) => {
        return `<div class="coffee-list">
                    <div class="coffee-name">
                        <h2><span class="hot-cold">Hot/Cold</span>${product.name}</h2>
                    </div>
                    <div class="coffee-price">
                        <p>₱${product.price.toFixed(2)}</p>
                    </div>
                    <div class="coffee-description">
                        <p>${product.description}</p>
                    </div>
                    <div class="coffee-select">
                        <button class="btnView" type="button" onclick="loadModal(${product.id})">Select</button>
                    </div>
                </div>`
    }

    let loadProducts = (products) => {
        let productsContainer = document.querySelector("#pricing-list");
        products.forEach(product => {
            productsContainer.innerHTML += loadProduct(product);
        });
    }


    loadProducts(products);
    let quantity = 1;
    let total = 0;
    let selectedProduct;
    let price = 0;
    productId = 1;
    selectedProduct = products.find(product => product.id == productId);
    let loadModal = (productId) => {
        selectedProduct = products.find(product => product.id == productId);
        total = selectedProduct.price.toFixed(2);
        let modalContainer = document.querySelector("#modalContainer");
        price = selectedProduct.price;
        modalContainer.innerHTML = `<div class="modal fade" tabindex="-1" id="modalComponent">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Order Coffee</h3>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container text-center">
                                                <p class="food-name fw-bold m-0">${selectedProduct.name}</p>
                                                <p class="food-price-modal m-0" id="price"><span class="coffee-total-price">₱ </span>${total}</p>
                                                </div>
                                                <div class="input-group d-flex justify-content-center my-4">
                                                    <button class="btn btn-primary" onclick="subQuantity()"><i class="fa-solid fa-minus"></i></button>
                                                    <input type="text" maxlength="2" value="${quantity}" id="quantity" class="qty form-control text-center custom-width">
                                                    <button class="btn btn-primary" onclick="addQuantity()"><i class="fa-solid fa-plus"></i></button>
                                                </div>
                                                <div class="container">
                                                  <div class="d-flex justify-content-center flex-row">
                                                    <div class="form-check form-check-inline">
                                                      <input type="radio" id="hot" name="coffee-type" value="Hot" class="form-check-input" checked>
                                                      <label for="hot" class="form-check-label">Hot</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                      <input type="radio" id="cold" name="coffee-type" value="Cold" class="form-check-input">
                                                      <label for="cold" class="form-check-label">Cold</label>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="button" class="btn btn-primary" onclick="addToCart()" id="addToCartButton">Pay with Paypal</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>`;
        let modal = document.querySelector("#modalComponent");
        let bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();

        modal.addEventListener('hidden.bs.modal', function() {
            quantity = '1'; // Reset the value of the quantity input field to 1
        });

        let quantityElement = document.querySelector("#quantity");
        quantityElement.addEventListener('keydown', (event) => {
            var value = event.target.value;
            var key = event.key;
            if (key === '-' || (key === '0' && value.length === 0)) {
                event.preventDefault();
            }
            updateTotal();
            updateModalView();
        })

        quantityElement.addEventListener('input', (event) => {
            quantity = quantityElement.value;
            updateTotal();
            updateModalView();
        })
    }

    let addQuantity = () => {
        let oldQuantity = quantity;
        oldQuantity++;
        if (oldQuantity >= 1 && oldQuantity <= 99) {
            quantity = oldQuantity;
        }
        updateTotal();
        updateModalView();
    }

    let subQuantity = () => {
        let oldQuantity = quantity;
        oldQuantity--;
        if (oldQuantity >= 1 && oldQuantity <= 99) {
            quantity = oldQuantity;
        }
        updateTotal();
        updateModalView();
    }

    let updateTotal = () => {
        total = quantity * price;
    }

    let updateModalView = () => {
        let quantityElement = document.querySelector('#quantity');
        let priceElement = document.querySelector("#price");
        quantityElement.value = quantity;
        priceElement.innerHTML = `<span>₱ </span>${total.toFixed(2)}`;
        if (total == 0) {
            document.querySelector("#addToCartButton").disabled = true;
        } else {
            document.querySelector("#addToCartButton").disabled = false;
        }
    }

    let updateTotalByVariant = (variantPrice, name) => {
        price = variantPrice;
        variantName = name;
        updateTotal();
        updateModalView();
    }

    let addToCart = async () => {
        let userId = {{ Auth::id() }};
        const csrfToken = '{{ csrf_token() }}';
        let coffeeType = document.querySelector('input[name="coffee-type"]:checked').value;
        let itemName = selectedProduct.name + ' - ' + coffeeType;
        let numericValue = total;
        $.ajax({
            url: 'payment',
            type: "post",
            data: {
                userId,
                numericValue,
                itemName,
                quantity
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
            },
            success: function(res) {
                if (res.message = "true") {
                    // Redirect to the payment approval link
                    window.location.href = res.link;
                } else {
                    // Handle other cases here
                    alertify.error("Something went wrong");
                }
            },
            error: function(data) {}
        });
    }
</script>

</html>
