@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">Cart
                        <div class="custom-control custom-switch" style="float: right;">
                            <span class="delivery-label" onclick="toggleDeliveryOption('collection')" id="collectionOption">Collection</span>
                            <span class="delivery-label" onclick="toggleDeliveryOption('delivery')" id="deliveryOption">Delivery</span>
                        </div>

                        <a style="float:right;" href="{{ url('/') }}"><button class="btn btn-danger btn-sm" style="margin-left: 5px">Order More</button></a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Size</th>
                                <th scope="col">Pizza</th>
                                <th scope="col">Price(£)</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody id="order-table-body">
                            @php
                                $deliveryOption = 'delivery';
                                $total = 0; // Initialize the total variable
                                $smallPizzaCount = 0;
                                $mediumPizzaCount = 0;
                                $largePizzaCount = 0;
                            @endphp
                            @foreach($orders as $order)
                                @php
                                    $total += $order->pizza_price; // Add the order price to the total
                                    if ($order->pizza_size === 'Small') {
                                        $smallPizzaCount++;
                                    } elseif ($order->pizza_size === 'Medium') {
                                        $mediumPizzaCount++;
                                    } elseif ($order->pizza_size === 'Large') {
                                        $largePizzaCount++;
                                    }

                                @endphp
                                <tr>
                                    <td>{{$order->pizza_size}}</td>
                                    <td>{{$order->pizza->name}}</td>
                                    <td>£{{$order->pizza_price}}</td>
                                    <td>
                                        <form action="{{route('order.destroy',$order->id)}}" method="post">@csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <div class="row justify-content-center d-flex align-items-stretch">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body" style="height: 150px;">
                                <h5>Collection Only Deals:</h5>
                                <ul>
                                    <li>
                                        2 Small Pizzas:
                                        <span id="small-deal" class="deal-price">£12.00</span>
                                    </li>
                                    <li>
                                        2 Medium Pizzas:
                                        <span id="medium-deal" class="deal-price">£18.00</span>
                                    </li>
                                    <li>
                                        2 Large Pizzas:
                                        <span id="large-deal" class="deal-price">£25.00</span>
                                    </li>
                                    <li>
                                        4 Medium Pizzas:
                                        <span id="medium-deal-4" class="deal-price">£30.00</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body" style="height: 150px;">
                                <h5>Pizzas:</h5>
                                <ul>
                                    <li>
                                        Small Pizzas:
                                        <span id="small-pizza-count">{{ $smallPizzaCount }}</span>
                                    </li>
                                    <li>
                                        Medium Pizzas:
                                        <span id="medium-pizza-count">{{ $mediumPizzaCount }}</span>
                                    </li>
                                    <li>
                                        Large Pizzas:
                                        <span id="large-pizza-count">{{ $largePizzaCount }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body" style="height: 150px;">
                                <h5 id="total">Total: £{{$total}}</span></h5>
                                <h5 id="savings">Savings: £0.00</h5> <!-- Add the savings element -->
                                <form action="{{ route('checkout') }}" method="post">
                                    @csrf
                                    <input type="tel" name="phone" id="phoneInput" placeholder="Mobile" required>
                                    <input type="hidden" name="delivery_choice" id="deliveryChoiceInput" value="{{$deliveryOption}}">
                                    <input type="hidden" name="total" id="totalCostInput" value="{{$total}}">
                                    <button type="submit" class="btn btn-success" style="float: right;">Check Out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var deliveryOption = '{{ $deliveryOption }}';
        var smallPizzaCount = parseInt(document.getElementById('small-pizza-count').innerText);
        var mediumPizzaCount = parseInt(document.getElementById('medium-pizza-count').innerText);
        var largePizzaCount = parseInt(document.getElementById('large-pizza-count').innerText);
        var runningTotal = {{ $total }}; // Store the running total

        function toggleDeliveryOption(option) {
            var collectionOption = document.getElementById('collectionOption');
            var deliveryOption = document.getElementById('deliveryOption');

            if (option === 'collection') {
                collectionOption.classList.add('highlight');
                deliveryOption.classList.remove('highlight');
                window.deliveryOption = 'collection';
            } else {
                collectionOption.classList.remove('highlight');
                deliveryOption.classList.add('highlight');
                window.deliveryOption = 'delivery';
            }
            updatePrices();
            updateHiddenInputFields();
        }

        // Function to calculate and update the prices based on the deals and delivery option
        function updatePrices() {
            var savings = 0; // Initialize savings

            if (deliveryOption === 'collection') {
                var smallDealPrice = 0;
                if (smallPizzaCount >= 2) {
                    // Calculate the total price for the small pizzas in the deal
                    smallDealPrice = 12 * Math.floor(smallPizzaCount / 2);
                }
                // Calculate the deal price for medium pizzas
                var mediumDealPrice = 0;
                if (mediumPizzaCount >= 4) {
                    mediumDealPrice = 30 * Math.floor(mediumPizzaCount / 4);
                }
                else if (mediumPizzaCount >= 2) {
                    // Calculate the total price for the medium pizzas in the deal
                    mediumDealPrice = 18 * Math.floor(mediumPizzaCount / 2);
                }
                // Calculate the deal price for large pizzas
                var largeDealPrice = 0;
                if (largePizzaCount >= 2) {
                    // Calculate the total price for the large pizzas in the deal
                    largeDealPrice = 25 * Math.floor(largePizzaCount / 2);
                }
                // Calculate the total deal price
                var totalDealPrice = smallDealPrice + mediumDealPrice + largeDealPrice;
                var total = runningTotal - totalDealPrice;
                savings = totalDealPrice;

                var totalElement = document.getElementById('total');
                totalElement.innerText = 'Total: £' + total.toFixed(2);
                document.getElementById('totalCostInput').value = total.toFixed(2); // Update the hidden input field
            } else {
                var totalElement = document.getElementById('total');
                totalElement.innerText = 'Total: £' + runningTotal.toFixed(2);
                document.getElementById('totalCostInput').value = runningTotal.toFixed(2); // Update the hidden input field
            }
            var savingsElement = document.getElementById('savings');
            savingsElement.innerText = 'Savings: £' + savings.toFixed(2);
            updateHiddenInputFields();
        }

        // Function to update the hidden input fields with delivery choice and total cost
        function updateHiddenInputFields() {
            document.getElementById('deliveryChoiceInput').value = deliveryOption;
            document.getElementById('totalCostInput').value = total.toFixed(2);
        }

        // Call the updatePrices function on page load
        window.onload = function () {
            toggleDeliveryOption('delivery'); // Select the "Delivery" option by default
            updatePrices();
            updateHiddenInputFields();
        };
    </script>
    <style>
        a.list-group-item {
            font-size: 18px;
        }

        a.list-group-item:hover {
            background-color: teal;
            color: #fff;
        }

        .card-header {
            background-color: teal;
            color: #fff;
            font-size: 20px;
        }

        img {
            float: left;
            width:  100px;
            height: 100px;
            background-size: cover;
        }

        .delivery-label {
            margin-left: 10px;
            vertical-align: middle;
            cursor: pointer;
        }

        .highlight {
            font-weight: bold;
            color: red;
        }

        .delivery-toggle-label {
            margin-bottom: 0.5rem;
        }

        .delivery-toggle {
            display: flex;
            align-items: center;
        }
    </style>
@endsection
